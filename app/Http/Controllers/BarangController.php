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
        // Menampilkan daftar barang dengan pagination
        $barangs = Barang::paginate(10);
        return view('index', compact('barangs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Menampilkan form untuk menambah barang baru
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama_barang' => 'required',
            'kode_barang' => 'required|unique:barangs,kode_barang',
            'kategori' => 'required',
            'jumlah' => 'required|integer',
            'kondisi' => 'required',
            'lokasi_simpan' => 'required',
            'tanggal_masuk' => 'required|date',
        ]);

        // Membuat barang baru
        Barang::create($request->all());

        // Redirect dengan pesan sukses
        return redirect()->route('index')->with('success', 'Barang berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Barang $barang)
    {
        // Menampilkan detail barang
        return view('show', compact('barang'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Barang $barang)
    {
        // Menampilkan form untuk mengedit barang
        return view('edit', compact('barang'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Barang $barang)
    {
        // Validasi input
        $request->validate([
            'nama_barang' => 'required',
            'kode_barang' => 'required|unique:barangs,kode_barang,' . $barang->id,
            'kategori' => 'required',
            'jumlah' => 'required|integer',
            'kondisi' => 'required',
            'lokasi_simpan' => 'required',
            'tanggal_masuk' => 'required|date',
        ]);

        // Update data barang
        $barang->update($request->all());

        // Redirect dengan pesan sukses
        return redirect()->route('index')->with('success', 'Barang berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage (soft delete).
     */
    public function destroy($id)
    {
        // Menemukan barang berdasarkan ID
        $barang = Barang::findOrFail($id);

        // Soft delete barang
        $barang->delete();

        // Redirect dengan pesan sukses
        return redirect()->route('index')->with('success', 'Barang berhasil dihapus.');
    }

    /**
     * Menampilkan barang yang sudah dihapus (soft deleted).
     */
    public function trashed()
    {
        // Mengambil barang yang sudah dihapus secara soft delete
        $barangs = Barang::onlyTrashed()->paginate(10);

        // Menampilkan data barang yang dihapus
        return view('trashed', compact('barangs'));
    }

    /**
     * Mengembalikan barang yang dihapus (restore).
     */
    public function restore($id)
    {
        // Menemukan barang yang dihapus (soft deleted) berdasarkan ID
        $barang = Barang::onlyTrashed()->findOrFail($id);

        // Mengembalikan barang yang dihapus
        $barang->restore();

        // Redirect dengan pesan sukses
        return redirect()->route('trashed')->with('success', 'Barang berhasil direstore!');
    }
}
