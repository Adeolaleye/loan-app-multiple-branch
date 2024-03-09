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
            $viewType = request()->input('viewType');
            $branchID = $view->getData()['branchID'] ?? null;
            if ($viewType === ViewTypes::BusinessOffice) {
                if (!is_null($branchID)) {
                    $id = $branchID;
                }else{
                $id = request()->route()->parameter('id') ?? request()->input('id');
                }
                $branch = Branch::find($id);
                $branchName = $branch ? $branch->name : null;
                $branchID = $branch ? $branch->id : null;
            }else{
                $branchName ='Headquaters';
                $branchID = null;
            }
            // Pass the $branchName, $branches, $viewType, and $branchID to the view
            $view->with([
                'branchName' => $branchName,
                'branches' => $branches,
                'viewType' => $viewType,
                'branchID' => $branchID,
            ]);
        
        });
    }
}
