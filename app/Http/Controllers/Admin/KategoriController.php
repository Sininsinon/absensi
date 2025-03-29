<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kategori = Kategori::all();
        $data = array('title' => 'Kategori Status');
        return view('admin.kategori.index', compact('kategori'),$data);
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
                'name_categories' => 'required',
            ]);
    
            $kategori = new Kategori;
            $kategori->name_categories = $request->name_categories;
            $kategori->save();
    
    
            return redirect('/admin/kategori')->with('sukses', 'Data Berhasil di Simpan');
        }catch(\Exception $e){
            return redirect('/admin/kategori')->with('gagal', 'Data tidak Berhasil di Simpan. Pesan Kesalahan: '.$e->getMessage());
        }
    }

    
    public function edit($id)
    {
        $kategori = Kategori::find($id);
        $data = array('title' => 'kategori');

        return view('admin.kategori.edit', compact('kategori'),$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try{
            $request->validate([
                'name' => 'required',
            ]);
    
            $kategori = Kategori::find($id);
            $kategori->name = $request->name;
            $kategori->update();
    
            return redirect('/admin/kategori')->with('sukses', 'Data Berhasil di Edit');
        }catch(\Exception $e){
            return redirect('/admin/kategori')->with('gagal', 'Data Tidak Berhasil di Edit. Pesan Kesalahan: '.$e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $kategori = Kategori::find($id);
        $kategori->delete();

        return redirect('/admin/kategori')->with('sukses', 'Data Berhasil di Hapus');
    }
}
