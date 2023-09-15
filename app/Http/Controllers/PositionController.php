<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PositionController extends Controller
{
    var $Positions_list = [
        'President',
        'Vice President',
        'Secretary',
        'Treasurer'
    ];

    public function get_all_positions() {
        // for the posibility to add list for a different category
        return $this->Positions_list;
    }
}
