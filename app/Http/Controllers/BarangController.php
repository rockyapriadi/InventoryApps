<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class BarangController extends Controller
{
    public function show(string $id):View {

        return view('barang.profile',[
        'barangs' => Barang::findOrFail($id)
        ]);
    }

    public function index(): View
    {
       $barang = Barang::latest()->paginate(10);
       return view('barang.index',compact('barang'));
    }

    public function create(): View
    {
        return view('barang.create');
    }

    public function store(Request $request): RedirectResponse
    {
       
        //validate form
        $request->validate([
            'nama_barang'      => 'required|min:5',
            'unit'      => 'required',
            'ukuran'      => 'required|min:5',
            'warna'      => 'required',
            'jenis'      => 'required',
            'harga'         => 'required',
            'stok'         => 'required'

        ]);

        Barang::create([
            'nama_barang'          => $request->nama_barang,
            'unit'             => $request->unit,
            'ukuran'             => $request->ukuran,
            'warna'             => $request->warna,
            'jenis'             => $request->jenis,
            'harga'             => $request->harga,
            'stok'             => $request->stok,
        ]);
        //redirect to index
        return redirect()->route('barang.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    public function edit(string $id): View
    {
        $barang = Barang::findOrFail($id);

        return view('barang.edit', compact('barang'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        //validate form
        $request->validate([
            'nama_barang'      => 'required|min:5',
            'unit'      => 'required',
            'ukuran'      => 'required|min:5',
            'warna'      => 'required',
            'jenis'      => 'required',
            'harga'         => 'required',
            'stok'         => 'required'
        ]);

        $barang = Barang::findOrFail($id);
        $barang->update([
                'nama_barang'         => $request->nama_barang,
                'unit'             => $request->unit,
                'ukuran'             => $request->ukuran,
                'warna'             => $request->warna,
                'jenis'             => $request->jenis,
                'harga'             => $request->harga,
                'stok'             => $request->stok,
            ]);

        return redirect()->route('barang.index')->with(['success' => 'Data Berhasil Diubah!']);
    }

    public function destroy($id): RedirectResponse
    {
        $barang = Barang::findOrFail($id);
        $barang->delete();
        return redirect()->route('barang.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }


}
