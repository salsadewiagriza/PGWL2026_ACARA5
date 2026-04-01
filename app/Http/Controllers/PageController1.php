<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class PageController extends Controller
{
    public function map(): View
    {
        $points = DB::table('points')->get();

        return view('map', [
            'title' => 'Peta',
            'points' => $points
        ]);
    }

    public function table(): View
    {
        $points = DB::table('points')->get();

        return view('table', [
            'title' => 'Tabel Data',
            'points' => $points
        ]);
    }
}