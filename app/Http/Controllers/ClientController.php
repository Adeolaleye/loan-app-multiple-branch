<?php

namespace App\Http\Controllers;
use App\Loan;
use App\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Intervention\Image\Facades\Image as Image;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = Client::with('loan')->Orderby('created_at','desc')->get();
        $counter = Client::all()->count();
        return view('clients.index', [
            'clients' => $clients,
            'counter' => $counter,
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
            'client_no' => 'required|string|max:20',
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
       // dd($clientno);
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
        ]);
        return redirect(route('addclient'))->with('message', 'Client Added Successfully');
    }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show( $id)
    {
        $client = Client::with('loan')->where('id', $id)->first();
        //dd($client);
        return view('clients.show',compact('client'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $client = Client::where('id', $id)->first();
        return view('clients.edit',compact('client'));
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
        $request->validate([
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
        {
            $client= Client::find($id);
            $client->name=$request->name;
            $client->phone=$request->phone;
            $client->dob=$request->dob;
            $client->gender=$request->gender;
            $client->marital_status=$request->marital_status;
            $client->occupation=$request->occupation;
            $client->residential_address=$request->residential_address;
            $client->office_address=$request->office_address;
            $client->means_of_id=$request->means_of_id;
            $client->qualification=$request->qualification;
            $client->g_name=$request->g_name;
            $client->g_phone=$request->g_phone;
            $client->g_address=$request->g_address;
            $client->g_relationship=$request->g_relationship;
            $client->profile_picture=isset($imgName) ? 'profile_pictures/'.$imgName: NULL;
            $client->save();
            return back()->with('message', 'Client Details Updated');
        }
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
