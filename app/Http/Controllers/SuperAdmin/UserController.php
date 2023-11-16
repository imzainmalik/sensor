<?php

namespace App\Http\Controllers\SuperAdmin;

use Mail;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //
    public function index(Request $request)
    {
        //
        if ($request->ajax()) {

            $data = User::where('role', '!=', 0)->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('role', function($row){ 
                            $role = $row->role == 1 ? 'Property Owner' : 'Flat Owner';
                            return $role;
                    })
                    ->addColumn('action', function($row){
                            $btn = '<a href="'.route('user.edit',[$row->id]).'" class="edit btn btn-primary btn-sm">Edit</a>';
                            return $btn;
                    })
                    ->rawColumns(['action', 'role'])
                    ->make(true);
        }

        return view('superadmin.users.index', get_defined_vars() );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = null;
        return view('superadmin.users.create', get_defined_vars());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'role' => 'required',
        ]);
            if($request->id){
               $user = User::find($request->id);
               $user->name = $validated['name'];
               $user->role = $validated['role'];
               $user->save();
               $notification = "User Update Successfully";
            }else{
               $user = User::create([
                    'name' => $validated['name'],
                    'email' => $validated['email'],
                    'password' => Hash::make('password'),
                    'role' => $validated['role'],
                ]);
                Mail::to('junaid.shoaib@legendesk.com')->send(new \App\Mail\UserMail($user));
                $notification = "User Create Successfully";
            }
        return redirect()->route('user.index')->with('message', $notification);

    }

    public function edit($id)
    {
        $user = User::find($id);

       return view('superadmin.users.create', get_defined_vars());
    }

    /**
     * Update the specified resource in storage.
     */


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
    public function cofigure_password($id)
    {
        $user = User::where('id',$id)->first();
        if(!$user){
            abort(403);
        } 
        return view('superadmin.users.cofigure_password', get_defined_vars());
    }
    public function cofigure_password_post(Request $request)
    {

        $request->validate([
            'password' => 'required|confirmed|min:6',
            'password_confirmation' => 'required'
        ]);

        $user = User::find($request->id);
        if($user){
          $user->password = Hash::make($request->password);
          $user->save();
          return redirect()->route('check_account_type')->with('message', 'Password Update Successfully');
        } else{
            return redirect()->back()->with('error','Something went wrong');
        }
        
    }

}
