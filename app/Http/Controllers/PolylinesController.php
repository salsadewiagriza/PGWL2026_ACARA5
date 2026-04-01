<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Polyline;
use Illuminate\Http\Request;

class PolylinesController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'geometry_polyline' => 'required',
            'name' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        // Ambil data dari form
        $data = [
            'name' => $request->name,
            'description' => $request->description,
            'geom' => $request->geometry_polyline,
        ];

        // Simpan ke database
        if (Polyline::create($data)) {
            return redirect()->route('peta')
                ->with('success', 'Data polyline berhasil disimpan.');
        }

        // Jika gagal
        return redirect()->route('peta')
            ->with('error', 'Gagal menyimpan data polyline.');
    }
}