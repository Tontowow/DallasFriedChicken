<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\destinasi;
use App\Models\User;
use App\Models\Ticket;

class AdminController extends Controller
{
    public function index()
{
    // Mengambil jumlah destinasi, pengguna, dan tiket
    $countDestinasi = Destinasi::count();
    $countUser = User::count();
    $countTicket = Ticket::count();
    
    // Mengambil 5 tiket terbaru
    $recentTickets = Ticket::latest()->take(5)->with('destinasi')->get(); // Ambil 5 tiket terbaru
    
    // Mengambil 5 destinasi terbaru
    $recentDestinasi = Destinasi::latest()->take(5)->get(); // Ambil 5 destinasi terbaru
    
    // Mengirim data ke view
    return view('admin.dashboard', compact(
        'recentTickets', 
        'recentDestinasi', 
        'countDestinasi', 
        'countUser', 
        'countTicket'
    ));
}

    


    public function destinasi(){
        $data = destinasi::all();
        return view('admin.destinasi', compact('data'));
    }

    public function showEdit ($id){
    $data = destinasi::find($id);
    return view('destinasi.edit',compact('data'));
    }

    public function update(Request $request, $id)
    {
        // Validate the incoming data
        $request->validate([
            'nama' => 'required|string',
            'deskripsi' => 'required|string',
            'harga' => 'required|string',
            'kategori' => 'required|string',
            'foto' => 'nullable|image|max:10240', // Foto is now optional
        ]);
    
        // Find the existing data
        $data = destinasi::findOrFail($id);
    
        // Check if a new photo is uploaded
        if ($request->hasFile('foto')) {
            // Store the new image
            $pathGambar = $request->file('foto')->store('public/gambar');
        } else {
            // If no new image, use the existing one
            $pathGambar = $data->gambar;
        }
    
        // Update the data
        $data->update([
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            'harga' => $request->harga,
            'kategori' => $request->kategori,
            'gambar' => $pathGambar,
            'latitude' => $request->latitude,  // Ensure latitude is also updated if provided
            'longitude' => $request->longitude,  // Ensure longitude is also updated if provided
        ]);
    
        // Redirect to the destinasi index page
        return redirect('/admin/destinasi');
    }
    

    public function destroy($id){
        $data = destinasi::find($id);
        $data->delete();

        return redirect('/admin/destinasi');
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

        return redirect()->route('destinasi')->with('success','');
    }

    public function tickets()
    {
        $tickets = Ticket::all(); // Ambil semua data tiket
        // dd($tickets); // Untuk melihat data tiket yang ada
        return view('admin.ticket', compact('tickets'));
    }
    

}
