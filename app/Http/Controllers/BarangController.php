<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $barang = Barang::all();
        return view('barang.index',[
            'barang' => $barang,
            'authuser' => Auth::user(),
        ]);
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
        // Validasi inputan dari form
        $request->validate([
            'kode_barang' => 'required',
            'nama_barang' => 'required',
            'quantity' => 'required',
        ]);

        // Membuat objek supplier baru
        $barang = new Barang();
        $barang->kode_barang = $request->input('kode_barang');
        $barang->nama_barang = $request->input('nama_barang');
        $barang->quantity = $request->input('quantity');
        $barang->save();

        // Redirect ke halaman index dengan notifikasi
        return redirect()->route('barang.index')->with('success', 'Data barang berhasil ditambahkan');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    $barang = Barang::findOrFail($id);
    return view('barang.edit', compact('barang'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
    $barang = Barang::findOrFail($id);
    
    // Validasi input form
    $request->validate([
        'kode_barang' => 'required',
        'nama_barang' => 'required',
        'quantity' => 'required|numeric',
    ]);
    
    // Update data supplier
    $barang->update([
        'kode_barang' => $request->kode_barang,
        'nama_barang' => $request->nama_barang,
        'quantity' => $request->quantity,
    ]);
    
    // Redirect ke halaman index dengan pesan sukses
    return redirect()->route('barang.index')->with('success', 'Data barang berhasil diubah.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    $barang = Barang::findOrFail($id);
    
    // Hapus data supplier
    $barang->delete();
    
    // Redirect ke halaman index dengan pesan sukses
    return redirect()->route('barang.index')->with('success', 'Data barang berhasil dihapus.');
    }
}
