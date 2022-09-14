<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WelcomeController extends Controller
{
    public function supplierInfo(){
        return view('frontEnd.suppliers.supplier');
    }

    public function purchases(){
        return view('frontEnd.purchases.purchases');
    }

    public function index(){
        return view('frontEnd.home.homeContent');
    }
}
