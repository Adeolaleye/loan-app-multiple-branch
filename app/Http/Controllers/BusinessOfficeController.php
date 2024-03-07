<?php

namespace App\Http\Controllers;

use App\Branch;
use Illuminate\Http\Request;

interface ViewTypes {
	const BusinessOffice = "BusinessOffice";
	const HeadQuarter = "HeadQuarter";
}
class BusinessOfficeController extends Controller
{
    public function index($id)
    {
        $branch = Branch::find($id);
        $branchName = $branch ? $branch->name : null;
        $branchID = $branch->id;
        $viewType = ViewTypes::BusinessOffice; 
        return view('business-office-dashboard',[
            'viewType' => $viewType,
            'branchName' => $branchName,
            'branchID' => $branchID
        ]);
    }
}
