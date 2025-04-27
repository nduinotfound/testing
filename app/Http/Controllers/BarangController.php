<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $barangs = Barang::paginate(10);
        return view('index', compact('barangs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required',
            'kode_barang' => 'required|unique:barangs,kode_barang',
            'kategori' => 'required',
            'jumlah' => 'required|integer',
            'kondisi' => 'required',
            'lokasi_simpan' => 'required',
            'tanggal_masuk' => 'required|date',
        ]);

        Barang::create($request->all());

        return redirect()->route('barang.index')->with('success', 'Barang berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Barang $barang)
    {
        return view('show', compact('barang'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Barang $barang)
    {
        return view('edit', compact('barang'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Barang $barang)
    {
        $request->validate([
            'nama_barang' => 'required',
            'kode_barang' => 'required|unique:barangs,kode_barang,' . $barang->id,
            'kategori' => 'required',
            'jumlah' => 'required|integer',
            'kondisi' => 'required',
            'lokasi_simpan' => 'required',
            'tanggal_masuk' => 'required|date',
        ]);

        $barang->update($request->all());

        return redirect()->route('barang.index')->with('success', 'Barang berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage (soft delete).
     */
    public function destroy($id)
    {
        $barang = Barang::findOrFail($id);
        $barang->delete();

        return redirect()->route('barang.index')->with('success', 'Barang berhasil dihapus.');
    }

    /**
     * Menampilkan barang yang sudah dihapus (soft deleted).
     */
    public function trashed()
    {
        $barangs = Barang::onlyTrashed()->paginate(10);
        return view('trashed', compact('barangs'));
    }

    /**
     * Mengembalikan barang yang dihapus (restore).
     */
    public function restore($id)
    {
        $barang = Barang::onlyTrashed()->findOrFail($id);
        $barang->restore();

        return redirect()->route('barang.trashed')->with('success', 'Barang berhasil direstore!');
    }
}
