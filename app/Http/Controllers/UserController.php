<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

/**
 * @property  User
 */
class UserController extends Controller
{
    // add middleware authentication
    public function __construct()
    {
        $this->middleware('Auth');
    }

    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // display all users to the admin
        $users = User::all();
        return view('admin.index') - with('users', $users);
    }

    /**
     * Show the form for creating a new resource.
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required|unique:users|max:11',
            'address' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required|max:50',
            'status' => 'active|required',
            'national_id' => 'required'
        ]);
        $user = new User();
        $user->create($request->all());
        $user->save();
        return redirect()->route('admin.index')
            ->with('success', 'User created successfully.');
    }

    /**
     * Display the specified resource.
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return view('index.show')->with('user', $user);
    }

    /**
     * Show the form for editing the specified resource.
     * @param User $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('admin.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $request->validate([
            'name' => 'required',
            'phone' => 'required|unique:users|max:11',
            'address' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required|max:50',
            'status' => 'active|required',
            'national_id' => 'required'
        ]);
        $user->update($request->all());
        $user->save();
        return redirect()->route('admin.index')
            ->with('success', 'User updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    }
}
