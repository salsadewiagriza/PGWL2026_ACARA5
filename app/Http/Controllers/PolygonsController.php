<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\PolygonsModel;
use Illuminate\Http\Request;

class PolygonsController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'geometry_polygon' => 'required',
            'name' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        // Ambil data dari form
        $data = [
            'name' => $request->name,
            'description' => $request->description,
            'geom' => $request->geometry_polygon,
        ];

        // Simpan ke database
        if (PolygonsModel::create($data)) {
            return redirect()->route('peta')
                ->with('success', 'Data polygon berhasil disimpan.');
        }

        // Jika gagal
        return redirect()->route('peta')
            ->with('error', 'Gagal menyimpan data polygon.');
    }
}
