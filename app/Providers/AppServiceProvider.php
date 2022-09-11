<?php

namespace App\Providers;

use App\Models\BloodDonor;
use Illuminate\Support\ServiceProvider;
use View;
use Session;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
//        View::composer('frontEnd.master', function($view){
//            $donorId = Session::get('id');
//            $donorById = BloodDonor::where('id', $donorId)->first();
//
//            $view->with('donorById', $donorById);
//        });
    }
}
