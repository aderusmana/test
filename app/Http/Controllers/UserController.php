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
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $cari = $request->query('cari');
        if (!empty($cari)) {
            $users = User::where('name', 'like', '%' . $cari . '%')->orWhere('email', 'like', '%' . $cari . '%')->paginate(5);
        } else {
            $users = User::paginate(5);
        }
        return view('users.index', compact('users', 'cari'));
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
            'name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required',
            'avatar' => 'required|image|mimes:jpg,png,jpeg',
        ]);
        $user = new User([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        if ($request->file('avatar')) {
            $file = $request->file('avatar');
            $filename = date('Ymd') . $file->getClientOriginalName();
            $file->move(public_path('image'), $filename);
            $user['avatar'] = $filename;
            $user->save();
        }
        return back()->with('success', 'Add Data Success');
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
        ]);
        $user->update($request->all());
        if ($request->file('avatar')) {
            $file = $request->file('avatar');
            $filename = date('Ymd') . $file->getClientOriginalName();
            $file->move(public_path('image'), $filename);
            $user['avatar'] = $filename;
            $user->save();
        }
        return back()->with('success', 'Update Data Success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if ($user == Auth()->user()) {
            return redirect('user')->with('error', 'Data User Yang Sedang Login Tidak Boleh dihapus');
        } else {
            $user->delete();
            return redirect('user')->with('success', 'User Success deleted');
        }
    }

    public function login()
    {
        return view('auth.login');
    }
    public function login_action(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $request->session()->regenerate();
            return redirect()->intended('/dashboard');
        }

        return back()->withErrors('password', 'Wrong username or password !');
    }


    public function register()
    {
        return view('auth.register');
    }
    public function register_action(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required',
            'password_confirmation' => 'required|same:password',
            'avatar' => 'required|image|mimes:jpg,png,jpeg',
        ]);
        $user = new User([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        if ($request->file('avatar')) {
            $file = $request->file('avatar');
            $filename = date('Ymd') . $file->getClientOriginalName();
            $file->move(public_path('image'), $filename);
            $user['avatar'] = $filename;
            $user->save();
        }
        return redirect()->route('login')->with('success', 'Registration Success, Please Login !');
    }

    public function password_action(Request $request)
    {
        $request->validate([
            'old_password' => 'required|current_password',
            'new_password' => 'required|confirmed',
        ]);
        $user = User::find(Auth::id());
        $user->password = Hash::make($request->new_password);
        $user->save();
        $request->session()->regenerate();
        return back()->with('success', 'Password Change');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
