<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\polylinesModel;

class PolylinesController extends Controller
{
    protected $polylines;

    public function __construct()
    {
        $this->polylines = new polylinesModel();
    }

    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $data = [
            'geom' => $request->geometry_polyline,
            'name' => $request->name,
            'description' => $request->description,
        ];

        $this->polylines->create($data);

        return redirect()->route('peta')
            ->with('success', 'Polyline berhasil disimpan.');
    }

    public function show(string $id) {}
    public function edit(string $id) {}
    public function update(Request $request, string $id) {}
    public function destroy(string $id) {}
}