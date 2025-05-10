<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DestinasiController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\UlasanController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [UlasanController::class, 'index'])->name('dashboard');

    Route::get('/tickets/create/{destinasiId}', [TicketController::class, 'create'])->name('tickets.create');
    Route::post('/tickets/store/{destinasiId}', [TicketController::class, 'store'])->name('tickets.store');
    Route::get('/my-tickets', [TicketController::class, 'userTickets'])->name('user.tickets');


    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('/ulasan/{id}', [UlasanController::class, 'store'])->name('destinasi.ulasan');

    Route::get('/gallery', [GalleryController::class, 'gallery'])->name('gallery');

    Route::get('/destinasi/{id}', [DestinasiController::class, 'show'])->name('destinasi.show');
    Route::get('/destinasi', [DestinasiController::class, 'destinasi'])->name('destinasi');

    Route::post('/tickets/checkout/{destinasiId}', [TicketController::class, 'checkout'])->name('tickets.checkout');
    Route::post('/tickets/checkoutUser/{destinasiId}', [TicketController::class, 'checkoutUser'])->name('tickets.checkoutUser');

    Route::post('/tickets/success/{destinasiId}', [TicketController::class, 'success'])->name('tickets.success');
    Route::get('/ticket/print/{id}', [TicketController::class, 'print'])->name('ticket.print');

});


Route::get('/formDestinasi', [DestinasiController::class, 'create'])->name('destinasi.create');
    Route::get('/formDestinasi', [DestinasiController::class, 'create'])->name('destinasi.create');
    Route::post('/formDestinasi/store', [DestinasiController::class, 'store'])->name('destinasi.store');
    Route::get('/destinasi/show/{id}', [AdminController::class, 'showEdit'])->name('destinasi.showEdit');
    Route::post('/destinasi/edit/{id}', [AdminController::class, 'update'])->name('destinasi.edit');
    Route::delete('/destinasi/delete/{id}', [AdminController::class, 'destroy'])->name('destinasi.delete');





require __DIR__ . '/auth.php';
require __DIR__ . '/admin-auth.php';
require __DIR__ . '/pengelola-auth.php';
