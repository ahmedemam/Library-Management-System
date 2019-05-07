<?php

namespace App\Http\Controllers;

use App\Book;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return all users
        $users = User::orderBy('id')->paginate(6);
        return view('admin.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // return admin.create-user
        return view('admin.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // create new_user
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string',
            'image' => 'required|string',
            'phone' => 'required|string|max:15|unique:users',
            'address' => 'required|string|max:255',
            'national_id' => 'required',
            'status' => 'required'
        ]);
        \Auth::user()->users()->create($request->all());
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
        return view('admin.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        return view('admin.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $id)
    {
        $user = User::find($id);
        $request->validate([
            'name' => ['required', "unique:users,user_name,$user->id"],
            'email' => ['required', "unique:users,email,$user->id"],
            'national_id' => ['required', "unique:users,national_id,$user->id"],
            'phone' => ['required', 'min:5', "unique:users,phone,$user->id"]
        ]);
        $user->update($request->all());
        return redirect()->route('admin.index')
            ->with('success', 'User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect()->route('admin.index')
            ->with('success', 'User deleted successfully');
    }

    public function userProfile()
    {
        return view('admin.profile', ['user' => Auth::user()]);
    }

    public function updateProfile(Request $request)
    {
//        $id = Auth::user()->id;
//        $user = User::find($id);
//        $user->image = Request::input('image');
//        $user->name = Request::input('name');
//        $user->email = Request::input('email');
//        $user->address = Request::input('address');
//        $user->phone = Request::input('phone');
//        $user->national_id = Request::input('national_id');
//        $user->save();
//        return redirect()->route('admin.profile', ['user' => $user])->with('success', 'updated');
        return view('admin.profile');
    }
}
