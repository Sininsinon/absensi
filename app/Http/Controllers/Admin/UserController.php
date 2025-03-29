<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Kategori;
use App\Models\Devisi;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $user = User::all();
        $kategori = Kategori::all();
        $devisi = Devisi::all();
        $data = array('title' => 'manajement user');
        return view('admin.user.index', compact('user', 'kategori', 'devisi'),$data);
    }

    public function store(Request $request)
    {
        try{
            $request->validate([    
                'name' => 'required',
                'email' => 'required',
                'password' => 'nullable',
                'phone' => 'required',
                'category_id' => 'required',
                'institution' => 'required',
                'division_id' => 'required',
                'profile_picture' => 'nullable',
                'role' => 'required',
            ]);
    
            $user = new User;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password ?? 'P05');
            $user->phone = $request->phone;
            $user->category_id = $request->category_id;
            $user->institution = $request->institution;
            $user->division_id = $request->division_id;
            $user->role = $request->role;

            if ($request->hasFile('profile_picture')) {
                $path = $request->file('profile_picture')->store('profile_pictures', 'public');
                $user->profile_picture = $path;
            }
            $user->save();
    
    
            return redirect('/admin/user')->with('sukses', 'Data Berhasil di Simpan');
        }catch(\Exception $e){
            return redirect('/admin/user')->with('gagal', 'Data Tidak Berhasil di Simpan. Pesan Kesalahan: '.$e->getMessage());
        }
    }

    public function show()
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($name)
    {
        $user = User::find($name);
        
        
        $data = array('title' => 'manajement user');
        return view('admin.user.edit', compact('user','kategori'),$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try{
            $user = User::findOrFail($id);
            

            if($request->password == null)
            {
                $user->name = $request->name;
                $user->email = $request->email;
                $user->phone = $request->phone;
                $user->category_id = $request->category_id;
                $user->institution = $request->institution;
                $user->division_id = $request->division_id;
      
                $user->update();
            }else
            {
                $user->name = $request->name;
                $user->email = $request->email;
                $user->password = bcrypt($request->password);
                $user->phone = $request->phone;
                $user->category_id = $request->category_id;
                $user->institution = $request->institution;
                $user->division_id = $request->division_id;
                $user->update();
            }
    
            return redirect('/admin/user')->with('sukses', 'Data Berhasil di Edit');
        }catch(\Exception $e){
            return redirect('/admin/user')->with('gagal', 'Data Tidak Berhasil di Edit. Pesan Kesalahan: '.$e->getMessage());
        }
    }

    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        // dd($user);

        return redirect('/admin/user')->with('sukses', 'Data Berhasil Di Hapus');
    }

    public function profile()
    {
        $data = array('title' => 'profil');
        return view('admin.user.profile',$data);
    }

    public function updateProfile(Request $request, $id)
    {
        $user_route = Auth::user();
        try {
            $user = User::findOrFail($id);
    
            $user->name = $request->name;
            $user->email = $request->email;
    
            // Memeriksa apakah password dimasukkan
            if ($request->filled('password')) {
                $user->password = bcrypt($request->password);
            }
    
            $user->save();
    
            return redirect('/admin/profile')->with('sukses', 'Data Berhasil di Edit');
        } catch (\Exception $e) {
            return redirect('/admin/profile')->with('gagal', 'Data Tidak Berhasil di Edit. Pesan Kesalahan: ' . $e->getMessage());
        }
    }
    
}
