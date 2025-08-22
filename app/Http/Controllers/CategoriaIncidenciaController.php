<?php

namespace App\Http\Controllers;

use App\Models\CategoriaIncidencia;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CategoriaIncidenciaController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categorias = CategoriaIncidencia::all();
        return Inertia::render('Catalogos/CategoriaIncidencia/Index', [
            'categorias' => $categorias
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
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|integer',
        ]);

        CategoriaIncidencia::create($request->all());

        return redirect()->route('/catalogos/categorias-incidencias')->with('success', 'Categoría de incidencia creada correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(CategoriaIncidencia $categoriaIncidencia)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CategoriaIncidencia $categoriaIncidencia)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CategoriaIncidencia $categoriaIncidencia)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CategoriaIncidencia $categoriaIncidencia)
    {
        
        $delete = $categoriaIncidencia->delete();
        dd($delete);
        return redirect()->route('/catalogos/categorias-incidencias')->with('success', 'Categoría de incidencia eliminada correctamente.');
    }
}
