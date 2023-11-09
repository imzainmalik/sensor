<?php

namespace App\Providers;

use App\Models\Property;
use App\Models\Appartment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {   

            // if(auth()->user()->id == 1){
            // // }else{
            // //     $properties = Property::where('user_id' ,auth()->user()->id)->get(); 

            // }
        $properties = property::get();    
        View::share(['properties' =>$properties]); 
        //
    }
}
