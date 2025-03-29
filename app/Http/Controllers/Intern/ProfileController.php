<?php

namespace App\Http\Controllers\Intern;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Kategori;
use App\Models\Devisi;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index()
    {
        $user = User::all();
        $kategori = Kategori::all();
        $devisi = Devisi::all();
        return view('menu.profile.index', compact('user', 'kategori', 'devisi'));   
    }
    public function infoProfile()
    {
        $user = User::all();
        $kategori = Kategori::all();
        $devisi = Devisi::all();
        return view('menu.profile.info' , compact('user', 'kategori', 'devisi'));   
    }
    public function Changepw()
    {

        return view('menu.profile.pw');   
    }

    public function updatePw(Request $request)
    {
        $request->validate([
            'new_password' => 'required|min:6',
            'confirm_password' => 'required|same:new_password',
        ]);

        try {
        $user = Auth::user();
        $user->password = Hash::make($request->new_password);
        $user->save();

        return redirect()->back()->with('success', 'Kata sandi berhasil diperbarui!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memperbarui kata sandi. Silakan coba lagi!');
        }
    }

    public function editProfile()
    {
        $user = auth()->user();
        $devisi = Devisi::all();
        // dd($user);
        return view('menu.profile.edit', compact('user','devisi'));
    }

    public function updateprofile(Request $request)
    {
        $user = auth()->user(); // Ambil user yang login
    

        $request->validate([
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048' // Maksimal 2MB
        ]);

        // Jika ada gambar baru diupload
    if ($request->hasFile('profile_picture')) {
        // Hapus foto lama jika bukan default
        if ($user->profile_picture && $user->profile_picture !== 'default.png') {
            Storage::delete('photos/' . $user->profile_picture);
        }

        // Simpan foto baru
        $file = $request->file('profile_picture');
        $filename = time() . '.' . $file->getClientOriginalExtension(); // Buat nama unik
        $file->storeAs('photos', $filename); // Simpan ke storage

        // Update database
        $user->profile_picture = $filename;
    }

        // Update nama dan divisi
        $user->update([
            'name' => $request->name,
            'phone' => $request->phone,
            'profile_picture' => $user->profile_picture, // Simpan foto baru jika ada
        ]);
    
        return redirect()->route('edit-profile')->with('success', 'Profil berhasil diperbarui!');
    }
    





    // profile admin

    public function edit($id)
    {
        
        $user = User::find($id);
        $data = array('title' => 'profil');
        return view('admin.user.profile', compact('user'),$data);
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $user_route = Auth::user();
        try {
            $user = User::findOrFail($id);

            if ($request->hasFile('foto')) {
                $user->update([
                    'name' => $request->name,
                    'email' => $request->email,
                ]);
            } elseif ($request->filled('password')) {
                $user->password = Hash::make($request->password);
                $user->save();
            } else {
                $user->update([
                    'name' => $request->name,
                    'email' => $request->email
                ]);
            }

            return redirect('/admin/profile' . '/' .  $id)->with('sukses', 'Data Berhasil di Edit');
        } catch (\Exception $e) {
            return redirect('/admin/profile' . '/' .  $id)->with('gagal', 'Data Tidak Berhasil di Edit. Pesan Kesalahan: ' . $e->getMessage());
        }
    }
}
