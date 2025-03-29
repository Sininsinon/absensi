<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Devisi;

class DevisiController extends Controller
{
     /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $devisi = Devisi::all();
        $data = array('title' => 'Devisi Magang');
        return view('admin.devisi.index', compact('devisi'),$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try{
            $request->validate([
                'name_divisions' => 'required',
            ]);
    
            $devisi = new Devisi;
            $devisi->name_divisions = $request->name_divisions;
            $devisi->save();
    
    
            return redirect('/admin/devisi')->with('sukses', 'Data Berhasil di Simpan');
        }catch(\Exception $e){
            return redirect('/admin/devisi')->with('gagal', 'Data tidak Berhasil di Simpan. Pesan Kesalahan: '.$e->getMessage());
        }
    }

    
    public function edit($id)
    {
        $devisi = Devisi::find($id);
        $data = array('title' => 'devisi');

        return view('admin.devisi.edit', compact('devisi'),$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try{
            $request->validate([
                'name_divisions' => 'required',
            ]);
    
            $devisi = Devisi::find($id);
            $devisi->name_divisions = $request->name_divisions;
            $devisi->update();
    
            return redirect('/admin/devisi')->with('sukses', 'Data Berhasil di Edit');
        }catch(\Exception $e){
            return redirect('/admin/devisi')->with('gagal', 'Data Tidak Berhasil di Edit. Pesan Kesalahan: '.$e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $devisi = Devisi::find($id);
        $devisi->delete();

        return redirect('/admin/devisi')->with('sukses', 'Data Berhasil di Hapus');
    }

}
