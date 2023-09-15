<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use App\Models\Voters;
use App\Models\Votes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\VotesController;
use App\Http\Controllers\PositionController;

use Illuminate\Database\Eloquent\Builder;

class VotersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // if ($request->isVoted) {
        //     $Voters = Voters::query()->when($request->isVoted, function (Builder $builder) use ($request) {
        //         $builder->where('isVoted', 'like', "%{$request->isVoted}%");
        //     })->paginate(10);

        //     // $Voters = DB::select('SELECT * FROM `voters` WHERE `isVoted` = "'. $request->isVoted .'"')->paginate(10);
        // } else {
        //     $Voters = Voters::paginate(25);
        // }

        $Voters = Voters::query()->when($request, function (Builder $builder) use ($request) {
            $builder
                ->where('isVoted', 'like', "%{$request->isVoted}%")
                ->Where('program', 'like', "%{$request->program}%")
                ->Where('year', 'like', "%{$request->year}%")
                ->Where('school_level', 'like', "%{$request->school_level}%");
        })->paginate(15);

        // adds it so that the search data will be present in every paganiation
        $Voters->appends(['isVoted' => $request->isVoted]);
        $Voters->appends(['program' => $request->program]);
        $Voters->appends(['year' => $request->year]);
        $Voters->appends(['school_level' => $request->school_level]);

        // dd($request);

        $votes = (new VotesController);

        $total_by_program = DB::select('SELECT COUNT(`USN`) as total, `program` FROM `voters` GROUP by `program`;');
        $total_by_year = DB::select('SELECT COUNT(`USN`) as total, `year` FROM `voters` GROUP by `year`;');

        // dd($votes);

        $total_voters = $votes->get_total_voters();
        $total_votes = $votes->get_total_votes();
        $remaining_votes = $votes->get_remaining_votes();
        $percent_votes_total = round($votes->votes_percentage(false), 2);
        $percent_remaining_votes = round($votes->votes_percentage(true), 2);

        $votes_scores = $votes->get_score_votes();
        $votes_percentage = $votes->get_votes_percentage();

        return view(
            'voter.list',
            compact(
                'Voters',
                'total_by_program',
                'total_by_year',
                'total_voters',
                'total_votes',
                'remaining_votes',
                'percent_votes_total',
                'percent_remaining_votes',
            )
        );

        // return view('voter.list', [
        //     'Voters' => $Voters,
        //     'total_by_program' => $total_by_program,
        //     'total_voters' => $votes->get_total_voters(),
        //     'total_votes' => $votes->get_total_votes(),
        //     'remaining_votes' => $votes->get_remaining_votes(),
        //     'percent_votes_total' => round($votes->votes_percentage(false), 2),
        //     'percent_remaining_votes' => round($votes->votes_percentage(true), 2),
        // ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('voter.register');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // validate form input
        $new_voter = $request->validate([
            'USN' => 'required',
            'name' => 'required',
            'program' => 'required',
            'year' => 'required',
        ]);

        // dd($request);

        // add the created input in the database
        Voters::create($new_voter);

        // redirects to the results page
        return redirect()->route('Voters.create')->with('success', 'New Voter (' . $request->name . ') added.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    // the voting page for the user to access
    public function vote_candidates()
    {
        // $Candidates = Candidate::all('*');
        $voter = session()->get('voter');

        $Candidates = Candidate::query()->when($voter, function (Builder $builder) use ($voter) {
            $builder
                ->Where('school_level', 'like', "%{$voter->school_level}%");
        })->get();

        $positons = (new PositionController);
        $Positions_list = $positons->get_all_positions();

        $total_by_position = DB::select('select count(id) as total, position from candidates group by position');
        // $is_voted = DB::select('select voter_usn from Votes where ')

        // dd($voter);

        return view(
            'candidate.vote',
            compact(
                'voter',
                'Candidates',
                'Positions_list'
            )
        );
    }

    public function store_votes(Request $request)
    {
        $positons = (new PositionController);
        $Positions_list = $positons->get_all_positions();

        // dd($request->input());

        $voted_candidates = array();

        // foreach candidate voted
        foreach ($Positions_list as $key => $value) {
            if ($request->input($value) && $value != 'Vice President') {
                $data = [
                    'voter_usn' => $request->input('voter_usn'),
                    'candidate_name' => $request->input($value),
                    'school_level' => $request->input('school_level'),
                    'position' => $value,
                ];

                array_push($voted_candidates, $data);
            } else {
                if ($request->input('Vice_President')) {
                    $data = [
                        'voter_usn' => $request->input('voter_usn'),
                        'candidate_name' => $request->input('Vice_President'),
                        'school_level' => $request->input('school_level'),
                        'position' => $value,
                    ];
    
                    array_push($voted_candidates, $data);
                }
            }
        }

        // dd($voted_candidates);

        foreach ($voted_candidates as $key => $value) {
            // dd($value);
            Votes::create($value);
        }

        // $voter = DB::select('SELECT * FROM `voters` WHERE `USN` = ?', [$request->input('voter_usn')]);
        $voter = DB::table('voters')->where('USN', $request->input('voter_usn'))->update(['isVoted' => 'voted']);

        // redirects to the results page
        return redirect('Thankyou')->with("voter_name", Session::get('voters_name'));
    }
}
