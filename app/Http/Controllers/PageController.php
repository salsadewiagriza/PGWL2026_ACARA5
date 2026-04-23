<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PageController extends Controller
{
    public function peta()
    {
        $points = DB::table('points')->get();

        return view('map', [
            'title' => 'Peta',
            'points' => $points
        ]);
    }

    public function tabel()
    {
        $points = DB::table('points')->get();

        return view('tabel', [
            'title' => 'Tabel Data',
            'points' => $points
        ]);
    }
}