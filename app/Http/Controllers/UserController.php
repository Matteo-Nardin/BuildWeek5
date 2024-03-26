<?php

namespace App\Http\Controllers;

use App\Models\User;
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
        $user = Auth::user();
        if($user->user_role == 'admin') {
        $userList = User::paginate(8);
        return view('users' , ['userList' => $userList]);
        } else {
            return redirect()->back();
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $user = Auth::user();

        if($user->user_role == 'admin') {
            return view('create_user');
        } else {
            return redirect()->back();
        }
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $userData = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'user_role' => $request->user_role
        ];

        User::create($userData);    
        
        return redirect()->action([UserController::class, 'index']);
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {

        $user = User::findOrFail($request->user_id);

        if($user->user_role == 'admin') {
            $user->user_role = 'user';
            $user->save();

        } elseif($user->user_role == 'user') {
            $user->user_role = 'admin';
            $user->save();
        }

        return redirect()->back()->with('success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        if (Auth::user()->user_role === 'admin') {
            $user->delete();
            return redirect()->back()->with('success');
        } else {
            return redirect()->back()->with('error', 'You do not have permission to delete this reservation.');
        }
    }
}
