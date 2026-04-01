<?php

namespace App\Http\Controllers;

use App\Models\PolygonsModel;
use Illuminate\Http\Request;

class PolygonsController extends Controller
{
    protected $polygons;

    public function __construct()
    {
        $this->polygons = new PolygonsModel();
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $polygons = $this->polygons->all();
        return view('polygons.index', compact('polygons')); // pastikan ada view resources/views/polygons/index.blade.php
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'geometry_polygon' => 'required',
            'name' => 'required|string|max:255',
            'description' => 'required|string',
        ], [
            'geometry_polygon.required' => 'Field geometry polygon harus diisi.',
            'name.required' => 'Field name harus diisi.',
            'name.string' => 'Field name harus berupa string.',
            'name.max' => 'Field name tidak boleh lebih dari 255 karakter.',
            'description.string' => 'Field description harus berupa string.',
        ]);

        $data = [
            'geom' => $validated['geometry_polygon'],
            'name' => $validated['name'],
            'description' => $validated['description'],
        ];

        try {
            $this->polygons->create($data);
            return redirect()->route('peta')->with('success', 'Data polygon berhasil disimpan.');
        } catch (\Exception $e) {
            return redirect()->route('peta')->with('error', 'Gagal menyimpan data polygon. '.$e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $polygon = $this->polygons->findOrFail($id);
        return view('polygons.edit', compact('polygon')); // pastikan ada view resources/views/polygons/edit.blade.php
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $polygon = $this->polygons->findOrFail($id);

        $validated = $request->validate([
            'geometry_polygon' => 'required',
            'name' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $polygon->update([
            'geom' => $validated['geometry_polygon'],
            'name' => $validated['name'],
            'description' => $validated['description'],
        ]);

        return redirect()->route('peta')->with('success', 'Data polygon berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $polygon = $this->polygons->findOrFail($id);
        $polygon->delete();

        return redirect()->route('peta')->with('success', 'Data polygon berhasil dihapus.');
    }
}