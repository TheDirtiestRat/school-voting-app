<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use App\Http\Controllers\VotesController;
use App\Http\Controllers\PositionController;
use App\Models\Candidate;
use App\Models\Voters;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class ResultsController extends Controller
{

    public function dashboard()
    {
        $votes = (new VotesController);
        $total_by_program = DB::select('SELECT COUNT(`USN`) as total, `program` FROM `voters` GROUP by `program`;');

        return view('extra_pages.dashboard', [
            'total_by_program' => $total_by_program,
            'votes_by_candidate' => $votes->get_votes_by_candidate(),
            'total_voters' => $votes->get_total_voters(),
            'total_votes' => $votes->get_total_votes(),
            'remaining_votes' => $votes->get_remaining_votes(),
            'percent_votes_total' => round($votes->votes_percentage(false), 2),
            'percent_remaining_votes' => round($votes->votes_percentage(true), 2),
        ]);
    }

    public function voting_results(Request $request)
    {
        $votes = (new VotesController);

        $positons = (new PositionController);
        $Positions_list = $positons->get_all_positions();

        // $Candidates = Candidate::all('*');

        $Candidates = Candidate::query()->when($request, function (Builder $builder) use ($request) {
            $builder
                ->Where('school_level', 'like', "%{$request->school_level}%");
        })->get();

        // get the url parameters
        // $url = $_SERVER['REQUEST_URI'];
        // $url_components = parse_url($url);
        // parse_str($url_components['query'], $parameters);
        // dd($parameters['school_level']);

        return view('voter.results', [
            'school_level' => $request->school_level,
            'total_voters' => $votes->get_total_voters(),
            'total_votes' => $votes->get_total_votes(),
            'remaining_votes' => $votes->get_remaining_votes(),
            'percent_votes_total' => round($votes->votes_percentage(false), 2),
            'percent_remaining_votes' => round($votes->votes_percentage(true), 2),

            'Positions_list' => $Positions_list,
            'Candidates' => $Candidates,
            'votes_scores' => $votes->get_score_votes(),
            'votes_percentage' => $votes->get_votes_percentage(),
        ]);
    }

    public function results_pdf(Request $request)
    {
        $votes = (new VotesController);

        $positons = (new PositionController);
        $Positions_list = $positons->get_all_positions();

        // $Candidates = Candidate::all('*');

        $Candidates = Candidate::query()->when($request, function (Builder $builder) use ($request) {
            $builder
                ->Where('school_level', 'like', "%{$request->school_level}%");
        })->get();

        $total_voters = $votes->get_total_voters();
        $total_votes = $votes->get_total_votes();
        $remaining_votes = $votes->get_remaining_votes();
        $percent_votes_total = round($votes->votes_percentage(false), 2);
        $percent_remaining_votes = round($votes->votes_percentage(true), 2);

        $votes_scores = $votes->get_score_votes();
        $votes_percentage = $votes->get_votes_percentage();

        $school_level = $request->school_level;

        $pdf = Pdf::loadView('pdf.result-pdf', compact(
            'school_level',
            'total_voters',
            'total_votes',
            'remaining_votes',
            'percent_votes_total',
            'percent_remaining_votes',

            'Positions_list',
            'Candidates',
            'votes_scores',
            'votes_percentage',
        ));
        return $pdf->stream();
    }

    public function voters_pdf(Request $request)
    {
        $votes = (new VotesController);

        // $Voters = Voters::all('*');
        // if ($request) {
        //     $Voters = Voters::query()->when($request, function (Builder $builder) use ($request) {
        //         $builder
        //             ->where('isVoted', 'like', "%{$request->isVoted}%")
        //             ->orWhere('program', 'like', "%{$request->program}%")
        //             ->orWhere('year', 'like', "%{$request->year}%")
        //             ->orWhere('school_level', 'like', "%{$request->school_level}%");
        //     });
        // } else {
        //     $Voters = Voters::all('*');
        // }

        $Voters = Voters::query()->when($request, function (Builder $builder) use ($request) {
            $builder
                ->where('isVoted', 'like', "%{$request->isVoted}%")
                ->Where('program', 'like', "%{$request->program}%")
                ->Where('year', 'like', "%{$request->year}%")
                ->Where('school_level', 'like', "%{$request->school_level}%");
        })->get();

        // $sql_where = '';

        // if ($request->isVoted) {
        //     $sql_where += '`isVoted` = '. $request->isVoted .'';
        // } elseif ($request->program) {
        //     $sql_where += '`program` = '. $request->program .'';
        // } elseif ($request->year) {
        //     $sql_where += '`year` = '. $request->year .'';
        // } elseif ($request->school_level) {
        //     $sql_where += '`school_level` = '. $request->school_level .'';
        // }

        // dd($sql_where);

        $Voters = DB::table('voters')
            ->where('isVoted', 'like', "%{$request->isVoted}%")
            ->where('program', 'like', "%{$request->program}%")
            ->where('year', 'like', "%{$request->year}%")
            ->where('school_level', 'like', "%{$request->school_level}%")->get();

        // dd($Voters);

        $total_by_program = DB::select('SELECT COUNT(`USN`) as total, `program` FROM `voters` GROUP by `program`;');
        $total_by_year = DB::select('SELECT COUNT(`USN`) as total, `year` FROM `voters` GROUP by `year`;');

        $total_voters = $votes->get_total_voters();
        $total_votes = $votes->get_total_votes();
        $remaining_votes = $votes->get_remaining_votes();
        $percent_votes_total = round($votes->votes_percentage(false), 2);
        $percent_remaining_votes = round($votes->votes_percentage(true), 2);

        $votes_scores = $votes->get_score_votes();
        $votes_percentage = $votes->get_votes_percentage();

        $pdf = Pdf::loadView('pdf.voters-pdf', compact(
            'Voters',
            'total_by_program',
            'total_voters',
            'total_votes',
            'remaining_votes',
            'percent_votes_total',
            'percent_remaining_votes',
        ));
        return $pdf->stream();
    }
}
