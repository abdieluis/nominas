<?php

namespace App\Http\Controllers;

use App\Models\Prestacion;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PrestacionController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $prestaciones = Prestacion::all();
        return Inertia::render('Catalogos/Prestaciones/Index', [
            'prestaciones' => $prestaciones,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Prestacion $prestacion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Prestacion $prestacion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Prestacion $prestacion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Prestacion $prestacion)
    {
        //
    }
}
