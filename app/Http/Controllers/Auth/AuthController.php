<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;


class AuthController extends Controller
{
    public function index() {
        $data = array('title' => 'Halaman Login');
        return view('auth.index',$data);
    }
    public function login_proses(Request $request) {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        // Cek apakah input adalah email atau nomor telepon
        $fieldType = filter_var($request->username, FILTER_VALIDATE_EMAIL) ? 'email' : 'phone';

        // Ambil user berdasarkan email atau nomor telepon
        $user = User::where($fieldType, $request->username)->first();

        if ($user) {
            if (Auth::attempt([$fieldType => $request->username, 'password' => $request->password])) {
                if ($user->role === 'admin') {
                    return redirect('/admin/dashboard'); // Admin ke dashboard
                } else {
                    return redirect('/home'); // Intern ke home
                }
            }
        }

        // Jika login gagal
        session()->put('style', 'danger');
        session()->put('pesan', 'Email, Nomer atau Password tidak sesuai');
        return redirect('/login');
    }

    public function logout() {
        Auth :: logout();

        Session()->put('style', 'success');
        Session()->put('pesan', 'Anda berhasil logout');
        return redirect('/login');
        
    }

}