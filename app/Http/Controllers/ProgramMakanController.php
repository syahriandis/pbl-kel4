<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProgramMakanController extends Controller
{
    public function index()
    {
        // Contoh data program makan
        $programs = [
            ['tanggal' => 'Senin, 8 April 2025', 'menu' => 'Resep Ayam'],
            ['tanggal' => 'Selasa, 9 April 2025', 'menu' => 'Resep Ubi Goreng'],
            ['tanggal' => 'Rabu, 10 April 2025', 'menu' => 'Resep Telur'],
        ];

        return view('resepmakan', compact('programs'));
    }
}
