<?php

namespace App\Http\Controllers;
use App\Loan;
use App\Branch;
use App\Client;
use App\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Providers\AppServiceProvider;
use Intervention\Image\Facades\Image as Image;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $branchID  = $request->query('id');
        $clients = Client::with('loan','payment')->where('branch_id', $branchID)->Orderby('created_at','desc')->get();
        $counter = Client::where('branch_id', $branchID)->count();
        return view('clients.index', [
            'clients' => $clients,
            'counter' => $counter,
            'branchID' => $branchID,
        ]); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('clients.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'client_no' => 'required|string|max:20|min:0',
            'name' => 'required|string|max:100',
            'phone' => 'required|string|min:5',
            'dob' => 'required|string|max:100',
            'gender' => 'required|string|max:20',
            'marital_status' => 'required|string|max:20',
            'occupation' => 'required|string|max:100',
            'residential_address' => 'required|string|max:500',
            'office_address' => 'required|string|max:500',
            'means_of_id' => 'required|string|max:50',
            'qualification' => 'required|string|max:100',
            'g_name' => 'required|string|max:100',
            'g_phone' => 'required|string|max:20',
            'g_address' => 'required|string|max:500',
            'g_relationship' => 'required|string|max:50',
            'profile_picture' => 'nullable|max:250',
        ]);
        if(request()->has('profile_picture')){
            $imgName = time() . '-' .$request['profile_picture']->getClientOriginalName();
            $image = Image::make($request['profile_picture'])->resize(100, 100);
            $image->save('profile_pictures/'.$imgName);
        }
        $check=Client::where('name',$request->name)->orderby('id','desc')->first();
        if($check){
            return back()->with('error', 'Client name exist, Seems it is desame user !');
        }else{
        $clientno = 50000000 + $request->client_no;
        $branchID = $request->branch_id;
        $viewType = $request->viewType;
        $clients = Client::create([
            'client_no' => $clientno,
            'name' => $request->name,
            'phone'=>$request->phone,
            'dob'=>$request->dob,
            'gender'=>$request->gender,
            'marital_status'=>$request->marital_status,
            'occupation'=>$request->occupation,
            'residential_address'=>$request->residential_address,
            'office_address'=>$request->office_address,
            'means_of_id'=>$request->means_of_id,
            'qualification'=>$request->qualification,
            'g_name'=>$request->g_name,
            'g_phone'=>$request->g_phone,
            'g_address'=>$request->g_address,
            'g_relationship'=>$request->g_relationship,
            'profile_picture' => isset($imgName) ? 'profile_pictures/'.$imgName: NULL,
            'admin_incharge' => Auth()->user()->name,
            'branch_id' => $branchID,

        ]);
        return redirect(route('addclient', ['viewType' => $viewType,'id' => $branchID]))->with('message', 'Client Added Successfully');
    }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $client = Client::with('loan')->where('id', $id)->first();
        $branchID = Branch::where('id', $client->branch_id)->value('id');

        app()->register(AppServiceProvider::class, ['branchID' => $branchID]);
        return view('clients.show', ['client' => $client, 'branchID' => $branchID ]);
    }

    public function print($id)
    {
        
        $client = Client::with('loan')->where('id', $id)->first();
        $branchID = Branch::where('id', $client->branch_id)->value('id');
       
        if(!is_null($branchID)){
            $viewType = 'BusinessOffice'; 
        }
        app()->register(AppServiceProvider::class, ['branchID' => $branchID, 'viewType' => $viewType]);
        return view('clients.print',['client' => $client, 'branchID' => $branchID, 'viewType' =>$viewType ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        $branchID = request()->query('branchID');
        $viewType = request()->query('viewType');
        $client = Client::where('id', $id)->first();
        return view('clients.edit', [
            'client' => $client,
            'branchID' => $branchID,
            'viewType' => $viewType
        ]); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        $branchID = $request->branch_id;
        $viewType = $request->viewType;
        $data =$this->validate($request, [
            'name' => 'required|string|max:100',
            'phone' => 'required|string|min:5',
            'dob' => 'required|string|max:100',
            'gender' => 'required|string|max:20',
            'marital_status' => 'required|string|max:20',
            'occupation' => 'required|string|max:100',
            'residential_address' => 'required|string|max:500',
            'office_address' => 'required|string|max:500',
            'means_of_id' => 'required|string|max:50',
            'qualification' => 'required|string|max:100',
            'g_name' => 'required|string|max:100',
            'g_phone' => 'required|string|max:20',
            'g_address' => 'required|string|max:500',
            'g_relationship' => 'required|string|max:50',
            'profile_picture' => 'nullable|max:250',
        ]);
        
        $client= Client::find($id);
        if(request()->has('profile_picture')){
            //delete old one
            if(isset($client->profile_picture)){
                unlink(public_path($client->profile_picture));
            }
            //save new image
            $imgName = time() . '-' .$request['profile_picture']->getClientOriginalName();
            $image = Image::make($request['profile_picture'])->resize(100, 100);
            $image->save('profile_pictures/'.$imgName);
            $data['profile_picture'] = 'profile_pictures/'.$imgName;
        }
         $client->update($data);
         return back()->with([
            'message' => 'Client Details Updated',
            'viewType' => $viewType,
            'branchID' => $branchID
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $client = Client::find($id);
        $client->delete();
        return back()->with('message', 'Client Deleted');
    }
}