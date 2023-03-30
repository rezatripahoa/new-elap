<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //
    public function index()
    {
        // AuthLib::logout();

        $data = [];
        $data['title'] = 'Login';

        return view('auth.login', ['data' => $data]);
    }

    public function login_submit(Request $request)
    {
        $user = User::where('username', strtolower($request->username))->first();
        if ($user != NULL) {
            if (Hash::check($request->password, $user->password)) {
                $credentials = array('username' => $request->username, 'password' => $request->password);
                if (Auth::attempt($credentials)) {
                    $request->session()->regenerate();
                    $year = date('Y') . ' - ' . date('Y') + 1;
                    if ($user->role == 1) {
                        return redirect('admin/dashboard');
                    } else if ($user->role == 2) {
                        return redirect('report/dashboard');
                    } else if ($user->role == 3) {
                        return redirect('department/dashboard?year=' . $year);
                    } else if ($user->role == 4) {
                        return redirect('head/dashboard?year=' . $year);
                    } else if ($user->role == 5) {
                        return redirect('kabid/dashboard?year=' . $year);
                    } else {
                        return redirect('/')->with('status', 'Login Gagal, Silahkan Cek Email atau Password');
                    }
                }
            } else {
                return redirect('login')->with('status', 'Login Gagal, Silahkan Cek Email atau Password');
            }
        } else {
            return redirect('login')->with('status', 'Username tidak dikenali');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/')->with('status', 'Logout Berhasil');
    }

    public function changePassword()
    {
        return view('auth.change_password');
    }

    public function changePasswordSubmit(Request $request)
    {
        $user = Auth::user();
        if (Hash::check($request->password, $user->password)) {
            $data = User::whereId($user->id)->first();
            $data->password = Hash::make($request->new_password);
            $data->save();

            $year = date('Y') . ' - ' . date('Y') + 1;

            if ($user->role == 2) {
                return redirect('report/dashboard')->with('status', 'Password Berhasil diubah');
            } else if ($user->role == 3) {
                return redirect('department/dashboard?year=' . $year)->with('status', 'Password Berhasil diubah');
            } else if ($user->role == 4) {
                return redirect('head/dashboard?year=' . $year)->with('status', 'Password Berhasil diubah');
            } else {
                return redirect('/')->with('status', 'Login Gagal, Silahkan Cek Email atau Password');
            }
        }
        return redirect('change_password', 'Password Lama Salah');
    }
}
