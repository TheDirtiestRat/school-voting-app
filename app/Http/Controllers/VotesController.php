<?php

namespace App\Http\Controllers;

use App\Models\Voters;
use App\Models\Votes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VotesController extends Controller
{
    var $total_voters = 0;
    var $total_votes = 0;
    var $score_votes = array();
    var $remaining_votes = 0;

    // var $percent_votes_total = ($total_votes / $total_voters) * 100;
    // var $percent_remaining_votes = ($remaining_votes / $total_voters) * 100;

    public function votes_percentage($isRemaining = false)
    {
        $percentage = 0;

        if ($isRemaining == false) {
            $percentage = ($this->total_votes / $this->total_voters) * 100;
        } else {
            $percentage = ($this->remaining_votes / $this->total_voters) * 100;
        }

        return $percentage;
    }

    public function get_total_voters()
    {
        $this->total_voters = Voters::all("*")->count();;

        return $this->total_voters;
    }
    // get the total_votes
    public function get_total_votes()
    {
        $this->total_votes = Votes::all('*')->groupBy('voter_usn')->count();

        return $this->total_votes;
    }

    public function get_score_votes()
    {
        $this->score_votes = DB::select('SELECT COUNT(`voter_usn`) as scores, `candidate_name` FROM `votes` GROUP BY `candidate_name`');

        return $this->score_votes;
    }

    public function get_votes_by_candidate()
    {
        $this->score_votes = DB::select('SELECT count(`candidate_name`) as votes, `candidate_name`, `position` FROM `votes` GROUP BY `candidate_name`, `position` ORDER BY votes DESC;');

        return $this->score_votes;
    }

    public function get_voted_voters() {
        $voters = DB::select('SELECT `voter_usn` FROM `votes` GROUP BY `voter_usn`;');

        return $voters;
    }

    public function get_votes_percentage()
    {
        $percentages = array();

        foreach ($this->score_votes as $key => $value) {
            $percent = [
                'percent' => round(($value->scores / $this->total_voters) * 100, 2),
                'candidate' => $value->candidate_name,
            ];
            array_push($percentages, $percent);
        }

        // dd($percentages);
        
        return $percentages;
    }

    public function get_remaining_votes()
    {
        $this->remaining_votes = $this->total_voters - $this->total_votes;

        return $this->remaining_votes;
    }
}
