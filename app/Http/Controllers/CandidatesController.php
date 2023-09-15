<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\PositionController;
use Illuminate\Database\Eloquent\Builder;

class CandidatesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // $Candidates = Candidate::all('*');
        $Candidates = Candidate::query()->when($request, function (Builder $builder) use ($request) {
            $builder
                ->where('school_level', 'like', "%{$request->school_level}%");
        })->get();
        
        $school_level = $request->school_level;
        $positons = (new PositionController);
        $Positions_list = $positons->get_all_positions();

        $total_by_position = DB::select('select count(id) as total, position from candidates group by position');

        // dd($total_by_position);

        return view(
            'candidate.list',
            compact(
                'Candidates',
                'Positions_list',
                'school_level',
            )
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('candidate.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // validate form input
        $request->validate([
            // 'photo' => 'required|mimes:png,jpg,jpeg|max:5048',
            'name' => 'required',
            'program' => 'required',
            'position' => 'required',
            // 'photo' => 'mimes:png,jpg,jpeg|max:5048',
        ]);

        // dd($request);

        // store the image
        $newPhotoName = '';
        if ($request->photo != null) {
            $newPhotoName = time() . "-" . $request->name . "." . $request->photo->guessExtension();
            $request->file('photo')->storeAs('images', $newPhotoName, 'public');
            // $request->file('photo')->store('storage/images', $newPhotoName);
        }else {
            $newPhotoName = 'aclc logo.png';
        }

        // add the created input in the database
        Candidate::create([
            'photo' => $newPhotoName,
            'name' => $request->input('name'),
            'program' => $request->input('program'),
            'position' => $request->input('position'),
        ]);

        // redirects to the results page
        return redirect()->route('Candidates.create')->with('success', 'New Candidates (' . $request->name . ') added.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Candidate $candidate)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Candidate $candidate, $candidate_id)
    {
        $selected_candidate = Candidate::findOrFail($candidate_id);

        // dd($candidate_id);

        return view('candidate.edit', [
            'candidate' => $selected_candidate
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Candidate $candidate, $id)
    {
        // validate form input
        $request->validate([
            // 'photo' => 'required|mimes:png,jpg,jpeg|max:5048',
            'name' => 'required',
            'program' => 'required',
            'position' => 'required',
            'photo' => 'mimes:png,jpg,jpeg',
        ]);

        $selected_candidate = Candidate::findOrFail($id);

        // dd($candidate);

        // store the image
        $newPhotoName = '';
        if ($request->photo != null) {
            $newPhotoName = time() . "-" . $request->name . "." . $request->photo->guessExtension();
            $request->file('photo')->storeAs('images', $newPhotoName, 'public');
        }else {
            $newPhotoName = $selected_candidate->photo;
        }

        // add the created input in the database
        $selected_candidate->update([
            'photo' => $newPhotoName,
            'name' => $request->input('name'),
            'program' => $request->input('program'),
            'position' => $request->input('position'),
        ]);

        // redirects to the results page
        return redirect()->route('Candidates.index')->with('success', '(' . $request->name . ') info is updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Candidate $candidate, $id)
    {
        $selected_candidate = Candidate::findOrFail($id);

        // remove it from the database
        $selected_candidate->delete();

        $destination = "storage/images/". $selected_candidate->photo;
        if (File::exists($destination) && $selected_candidate->photo != 'aclc logo.png') {
            File::delete($destination);
        }

        return redirect()->route('Candidates.index')->with('success', '' . $selected_candidate->name . ' is deleted in the records');
    }
}
