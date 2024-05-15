<?php

namespace App\Http\Controllers;

use App\Models\Facility;
use Illuminate\Http\Request;

class FacilitiesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Mengambil semua fasilitas dari database
        $facilities = Facility::all();

        // Mengembalikan view index dan mengirimkan data fasilitas
        return view('facilities.index', compact('facilities'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Menampilkan form untuk membuat fasilitas baru
        return view('facilities.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi data yang diterima dari form
        $validatedData = $request->validate([
            'nama_fasilitas' => 'required|string',
            'alamat' => 'required|string',
            'pj_fasilitas' => 'required|string',
            'harga_kelola' => 'required|numeric',
            'harga_sewa' => 'required|numeric',
        ]);

        // Membuat fasilitas baru berdasarkan data yang divalidasi
        $facility = Facility::create($validatedData);

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('facilities.index')->with('success', 'Facility created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Mengambil fasilitas berdasarkan ID yang diberikan
        $facility = Facility::findOrFail($id);

        // Menampilkan detail fasilitas
        return view('facilities.show', compact('facility'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Mengambil fasilitas berdasarkan ID yang diberikan
        $facility = Facility::findOrFail($id);

        // Menampilkan form untuk mengedit fasilitas
        return view('facilities.edit', compact('facility'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validasi data yang diterima dari form
        $validatedData = $request->validate([
            'nama_fasilitas' => 'required|string',
            'alamat' => 'required|string',
            'pj_fasilitas' => 'required|string',
            'harga_kelola' => 'required|numeric',
            'harga_sewa' => 'required|numeric',
        ]);

        // Mengambil fasilitas berdasarkan ID yang diberikan
        $facility = Facility::findOrFail($id);

        // Memperbarui data fasilitas berdasarkan data yang divalidasi
        $facility->update($validatedData);

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('facilities.index')->with('success', 'Facility updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Menghapus fasilitas berdasarkan ID yang diberikan
        $facility = Facility::findOrFail($id);
        $facility->delete();

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('facilities.index')->with('success', 'Facility deleted successfully');
    }
}
