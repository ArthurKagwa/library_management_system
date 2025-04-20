<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CheckinController extends Controller
{
    public function checkinPage(){
        return view('librarian.checkin');
    }
}
