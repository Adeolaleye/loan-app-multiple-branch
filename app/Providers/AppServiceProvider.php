<?php

namespace App\Providers;

use App\Branch;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

interface ViewTypes {
	const BusinessOffice = "BusinessOffice";
	const HeadQuarter = "HeadQuarter";
}
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
        View::composer('*', function ($view) {
            $branches = Branch::all();
            //$viewType = ViewTypes::BusinessOffice;
            $view->with('branches', $branches);
        });
    }
}
