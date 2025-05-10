<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function gallery()
    {
        // You can fetch images from a database or storage here
        $images = [
            'images/IMG_2032.JPG',
            'images/background.jpg',
            'images/bandung.jpg',
            'images/cartil.jpg',
            'images/braga.jpg',
            'images/lakeHouse.jpg',
            'images/malela.jpg',
            'images/nimo.jpg',
            'images/udjo.jpg',
            'images/floatingMarket.jpg',
            'images/wahoo.jpg',
            'images/jurnalRisa.jpg',
        ];

        return view('gallery.gallery', compact('images'));
    }
}
