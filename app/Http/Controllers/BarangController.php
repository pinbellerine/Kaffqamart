<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Kategori; // Tambahkan impor untuk model Kategori
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;



class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $barang = Barang::all();

        return view('barang.index', ['barang' => $barang]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $barang = Barang::all();
        $kategori = Kategori::all();

        return view('barang.tambah', ['barang' => $barang, 'kategori' => $kategori]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'harga' => 'required',
            'stock' => 'required',
            'deskripsi' => 'required',
            'filename' => 'required',
            'kategori' => 'required',
        ]);

        $imageName = time().'.'.$request->filename->extension();

        $request->filename->move(public_path('uploads'), $imageName);

        $barang = new Barang;

        $barang->nama_brg = $request->input('nama');
        $barang->harga_brg = $request->input('harga');
        $barang->stock_brg = $request->input('stock');
        $barang->deskripsi_brg = $request->input('deskripsi');
        $barang->kategori_id = $request->input('kategori');
        $barang->gambar_brg = $imageName;

        $barang->save();

        Alert::success('Success', 'Data Berhasil'); // Menggunakan \ untuk mengakses Alert
        return redirect('/barang');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $barang = Barang::find($id);
        return view('barang.detail', compact('barang'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $kategori = Kategori::all();

        $barang = DB::table('barangs')->find($id);
        return view('barang.edit', compact('barang'), ['kategori' => $kategori]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
{
    // Validasi input
    $request->validate([
        'nama' => 'required',
        'harga' => 'required',
        'stock' => 'required',
        'deskripsi' => 'required',
        'kategori' => 'required',
        'filename' => 'nullable|image', // Buat filename opsional dan hanya terima file gambar
    ]);

    // Temukan barang berdasarkan ID
    $barang = Barang::find($id);

    // Jika barang tidak ditemukan, kembalikan respons kesalahan
    if (!$barang) {
        return redirect('/barang')->with('error', 'Data tidak ditemukan');
    }

    // Jika ada file gambar yang diunggah
    if ($request->hasFile('filename')) {
        $imageName = time().'.'.$request->filename->extension();
        $request->filename->move(public_path('uploads'), $imageName);
        $barang->gambar_brg = $imageName; // Update nama gambar hanya jika gambar diunggah
    }

    // Update data barang
    $barang->nama_brg = $request->input('nama');
    $barang->harga_brg = $request->input('harga');
    $barang->stock_brg = $request->input('stock');
    $barang->deskripsi_brg = $request->input('deskripsi');
    $barang->kategori_id = $request->input('kategori');

    // Simpan perubahan ke database
    $barang->save();

    // Tampilkan pesan sukses
    Alert::success('Success', 'Data Berhasil di Update');
    return redirect('/barang');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
{
    // Cari barang berdasarkan ID
    $barang = Barang::find($id);

    // Jika barang tidak ditemukan, kembalikan pesan kesalahan
    if (!$barang) {
        Alert::error('Error', 'Data tidak ditemukan');
        return redirect('/barang');
    }

    // Hapus barang
    $barang->delete();

    // Tampilkan pesan sukses
    Alert::success('Success', 'Data Berhasil di Hapus');
    return redirect('/barang');
}

}
