<?php

use App\Models\Barang;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/barang', function () {
    $barangs = Barang::all();
    return view('barang.index', compact('barangs'));
});
