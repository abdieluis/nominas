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
        //dd($request->all());

        if (is_array($request->efficiency_rules)) {
            $request->merge([
                'efficiency_rules' => json_encode($request->efficiency_rules),
            ]);
        }
        $validate = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
            'type' => 'required|string|in:days,months',
            'each' => 'required|integer|min:1',
            'efficiency_rules' => 'nullable',
            'conditioned' => 'boolean',
            'conditioned_seniority' => 'boolean',
            'conditioned_efficiency' => 'boolean',
            'day_cutoff' => 'required|integer|min:1|max:31',
        ]);

        //dd($validate);// Debugging line, remove in production
        Prestacion::create($validate);
        return redirect()->route('/catalogos/prestaciones')->with('success', 'Prestación creada correctamente.');
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
        if (is_array($request->efficiency_rules)) {
            $request->merge([
                'efficiency_rules' => json_encode($request->efficiency_rules),
            ]);
        }
        $validate = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
            'type' => 'required|string|in:days,months',
            'each' => 'required|integer|min:1',
            'efficiency_rules' => 'nullable',
            'conditioned' => 'boolean',
            'conditioned_seniority' => 'boolean',
            'conditioned_efficiency' => 'boolean',
            'day_cutoff' => 'required|integer|min:1|max:31',
        ]);
        $prestacion->update($validate);
        return redirect()->route('/catalogos/prestaciones')->with('success', 'Prestación actualizada correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Prestacion $prestacion)
    {
        $prestacion->delete();
        return redirect()->route('/catalogos/prestaciones')->with('success', 'Prestación eliminada correctamente.');
    }
}
