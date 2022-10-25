<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SampleSubmissionController extends Controller
{
    public function sampleSubmission(){
        return view('frontEnd.sampleSubmission.sampleSubmission');
    }
}
