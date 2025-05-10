<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Destinasi;
use App\Models\Ulasan;

class DestinasiController extends Controller
{
    // Menampilkan halaman detail destinasi berdasarkan ID
    public function show($id)
{
    $destinasi = Destinasi::with('maps')->findOrFail($id); // Pastikan menggunakan 'maps', bukan 'map'
    $ulasan = Ulasan::where('destinasi_id', $id)->get();
    
    return view('destinasi.show', compact('destinasi', 'ulasan'));
}




    // Menampilkan halaman destinasi dengan filter pencarian dan kategori
    public function destinasi(Request $request)
    {
        // Menentukan judul berdasarkan pencarian atau kategori
        $judul = "Destinasi TrekTrove";
        if ($request->has('search') && !empty($request->search)) {
            $judul = "Destinasi " . htmlspecialchars($request->search);
        } elseif ($request->has('kategori') && !empty($request->kategori)) {
            $judul = "Destinasi " . ucfirst($request->kategori);
        }

        // Ambil data destinasi dari database
        $query = Destinasi::query();

        // Pencarian berdasarkan nama dan deskripsi
        if ($request->has('search') && !empty($request->search)) {
            $query->where('nama', 'like', '%' . $request->search . '%')
                  ->orWhere('deskripsi', 'like', '%' . $request->search . '%');
        }

        // Filter berdasarkan kategori
        if ($request->has('kategori') && !empty($request->kategori)) {
            $query->where('kategori', $request->kategori);
        }

        // Ambil data destinasi dari database
        $filteredDestinasi = $query->get(); // Pastikan variabel ini didefinisikan

        // Kirim data destinasi dan judul ke view
        return view('destinasi.destinasi', compact('filteredDestinasi', 'judul')); // Kirimkan data ke view
    }

    public function create(){
        return view('destinasi.create');
    }

    public function store(Request $request){
        $request->validate([
            'nama'=> 'required|string',
            'deskripsi' =>'required|string',
            'harga' => 'required|string',
            'kategori'=> 'required|string',
            'foto' =>'required|image|max:10240',
        ]);

        $pathGambar = $request->file('foto')->store('public/gambar');
        
        Destinasi::create([
            'nama'=> $request->nama,
            'deskripsi' =>  $request->deskripsi,
            'harga' =>  $request->harga,
            'kategori'=>  $request->kategori,
            'gambar' => $pathGambar,
        ]);

        return redirect()->route('admin.destinasi')->with('success','');
    }


    


    



    }
    

    
    

