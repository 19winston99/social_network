<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        //
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }

    public function search(Request $request)
    {
        $query = $request->search;
        $users = User::where('name', 'LIKE', '%' . $query . '%')->get();
        return view('users.list', ['users' => $users]);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $posts = $user->posts()->with('comments.user')->get();
        return view('users.show', ['user' => $user, 'posts' => $posts]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        if (Auth::user()->id == $user->id) {
            return view('users.edit', ['user' => $user]);
        }
        return redirect()->route('home');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        if (Auth::user()->id != $user->id) return view('home');
        $request->validate([
            'name' => 'required',
            'lastname' => 'required',
            'password' => ['required', 'string', 'min:8'],
            'profile' => 'image|mimes:jpeg,png,jpg|max:2048'
        ]);

        if ($request->profile) {
            $name = uniqid() . '.' . $request->profile->extension();
            $request->profile->move(public_path('images/users'), $name);
        } else {
            $name = $user->profile;
        }

        if ($user->profile != $name) {
            File::delete(public_path('images/users/' . $user->profile));
        }

        $password = !$request->password ? $user->password : Hash::make($request->password);

        $user->update([
            'name' => $request->name,
            'lastname' => $request->lastname,
            'password' => $password,
            'profile' => $name
        ]);
        $posts = $user->posts()->with('comments.user')->get();
        return redirect()->route('users.show', ['success' => 'Modifiche effettuate con successo', 'user' => $user, 'posts' => $posts]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $deletingUser = $user->id;
        $user->delete();
        File::delete(public_path('images/users/' . $user->profile));
        if (Auth::user()->id == $deletingUser) {
            Auth::logout();
            return redirect('/login');
        }
        return redirect()->route('admin.index', ['success' => 'Utente eliminato con successo', 'users' => User::all(), 'posts' => Post::all()]);
    }
}
