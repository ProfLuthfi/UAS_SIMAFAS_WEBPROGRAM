<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // if(!Auth::check()){  
        //     return redirect("login")->withSuccess('Opps! You do not have access');
        // }
  
        $users = User::All();

        return view('users/index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::All();
        return view('users/create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request);
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'role' => 'required|in:admin,dev,owner,user,staff',
        ]);
           
        $data = $request->all();
        try {
            $check = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'role_id' =>$data['role']
            ]);

            return redirect()->route('users.index')->withSuccess('Great! You have added user '.$check->name);
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->route('users.index')->withFailed('oops '.$th);

        }
        // dd($data);
        
         
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $roles = Role::All();
        $user = User::find($id);
        return view('users/edit', compact('roles', 'user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'role' => 'required|in:admin,dev,owner,user',
        ]);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role_id = $request->role;
        if(!empty($request->password)) $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('users.index')->withSuccess('Great! You have updated user '.$user->name);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = User::find($id);
        // $user = User::where('email', $id);
        if($user->delete()){
            return redirect()->route('users.index')->withSuccess('Great! You have deleted user '.$user->name);
        }else{
            return redirect()->route('users.index')->withFailed('oops data user cannot be deleted');
        }
    }
}
