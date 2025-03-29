<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class ForgotPasswordController extends Controller
{
    // Menampilkan form lupa password
    public function showForm()
    {
        return view('auth.forgot-password');
    }

    // Mengirim kode ke email
    public function sendResetCode(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        // Buat kode acak 6 digit
        $code = mt_rand(100000, 999999);

        // Simpan kode di session (atau database)
        Session::put('reset_code', $code);
        Session::put('reset_email', $request->email);

        // Kirim kode ke email
        Mail::raw("Kode reset password Anda: $code", function ($message) use ($request) {
            $message->to($request->email)
                ->subject('Kode Reset Password');
        });

        return redirect()->route('password.verify')->with('success', 'Kode verifikasi telah dikirim ke email Anda.');
    }

    // Verifikasi kode OTP
    public function verifyCode(Request $request)
    {
        $request->validate([
            'code' => 'required|numeric',
        ]);

        if ($request->code != Session::get('reset_code')) {
            return back()->with('error', 'Kode salah atau sudah kadaluarsa.');
        }

        return redirect()->route('password.update')->with('success', 'Kode benar, silakan ganti password.');
    }

    // Reset password setelah verifikasi kode
    public function resetPassword(Request $request)
    {
        $request->validate([
            'password' => 'required|min:6|confirmed',
        ]);

        $user = User::where('email', Session::get('reset_email'))->first();
        $user->update([
            'password' => Hash::make($request->password),
        ]);

        // Hapus session
        Session::forget(['reset_code', 'reset_email']);

        return redirect('/login')->with('success', 'Password berhasil diubah.');
    }
}

