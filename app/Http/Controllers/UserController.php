<?php

namespace App\Http\Controllers;

use App\Mail\AgapeEmail;
use App\User;
use Illuminate\Mail\Mailer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Intervention\Image\Facades\Image as Image;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        $counter = User::all()->count();
        return view('adminuser.index', [
            'users' => $users,
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
        //
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
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            //'email' => 'required|unique:users,email',
            'password' => 'required|string|min:5|unique:users',
            'phone' => 'required|string|min:5',
            'role' => 'required|string',
            'profile_picture' => 'nullable|max:250',

        ]
        
    );
    if(request()->has('profile_picture')){
        $imgName = time() . '-' .$request['profile_picture']->getClientOriginalName();
        $image = Image::make($request['profile_picture'])->resize(100, 100);

        $image->save('profile_pictures/'.$imgName);
    }
        $check=User::where('email',$request->email)->orderby('id','desc')->first();
        if($check){
            return back()->with('error', 'User Exist!');
        }else{
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request['password']),
            'phone'=>$request->phone,
            'role'=>$request->role,
            'profile_picture' => isset($imgName) ? 'profile_pictures/'.$imgName: NULL,
        ]);
        $data = [
            'name'=> $user->name,
            'phone'=> $user->phone,
            'password'=>$request->password,
            'subject'=> 'Welcome, '. $user->name .' to Agapeglobal',
            'type'=> 'welcome',
            'role'=> $user->role,
            'email'=> $user->email,
        ];
        Mail::to($user->email)->send(new AgapeEmail($data));
        return redirect(route('adminuser'))->with('message', 'User Added Successfully');
    
    
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
       
        $user= User::find($id);
       
        $data = $this->validate($request, [
            'profile_picture' => 'nullable|max:250|mimes:jpg,jpeg,png',
            // 'email' => 'unique:users,email,' . $user->id,
           // 'email' => 'required|unique:users,email',
        //    'email' => 'unique:users,email,' . $user->id,
            'phone' => 'required',
            'name' => 'required|max:70|min:3',
            'role' => 'required'

        ]);
      
        if(request()->has('profile_picture')){
            //delete old one
            if(isset($user->profile_picture)){
                unlink(public_path($user->profile_picture));
            }
            //save new image
            $imgName = time() . '-' .$request['profile_picture']->getClientOriginalName();
            $image = Image::make($request['profile_picture'])->resize(100, 100);
            $image->save('profile_pictures/'.$imgName);
            $user->profile_picture = 'profile_pictures/'.$imgName;
           // $user->save();
        }

        $user->name=$data['name'];
        // $user->email = isset($request->email) ? $request->email: NULL;
        $user->phone=$data['phone'];
        $user->role=$data['role'];
        // $user->role=$data['role'];
        $user->save();
        return back()->with('message', 'Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return back()->with('message', 'Admin Deleted');
    }
}
