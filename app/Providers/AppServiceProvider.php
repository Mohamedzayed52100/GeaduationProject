<?php

namespace App\Providers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;


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

        Paginator::useBootstrap();


        ////this is shared variable and data and objects For patient
        // $bool ="true";
        // $name ="mohamed";
        // $age ="25";

        // $test ="test";
        // $test2 ="test2";

        // $patient_who_login =DB::table('patient')->where('id', session('patient_id_login'));


        // //share through all views
        // view()->composer('*', function($view) use ($bool,$name,$age,$test,$test2){
        //     $view->with(['bool'=> $bool ,
        //                 'name'=> $name ,
        //                 'age'=> $age ,

        //                 'test'=> $test ,
        //                 'test2'=> $test2 ,

        // ]);
        // });
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////




    }
}
