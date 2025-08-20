<?php

namespace App\Http\Controllers;

use App\Models\Planta;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;

class PlantaController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $plantas = Planta::select(
            'branch_offices.id AS planta_id',
            'branch_offices.code AS codigo',
            'branch_offices.name AS planta',
            'companies.name AS empresa',
            DB::raw("JSON_UNQUOTE(JSON_EXTRACT(branch_offices.meta, '$.tax_id')) AS rfc"),
            'branch_offices.internal_code AS clave_netsuite',
            'branch_offices.external_location_id AS clave_ubicacion_netsuite',
            'branch_office_fiscal_keys.certificate_path AS certificado_fiscal',
            DB::raw('DATE(branch_office_fiscal_keys.expires_at) AS expiracion_clave'),
            'branch_offices.created_at',
            'branch_offices.updated_at',
            'branch_offices.description',
            'branch_offices.active'
        )
            ->join('companies', 'branch_offices.company_id', '=', 'companies.id')
            ->join('branch_office_fiscal_keys', 'branch_offices.id', '=', 'branch_office_fiscal_keys.branch_office_id')
            ->orderBy('branch_offices.id', 'DESC')
            ->get();

        return Inertia::render('Catalogos/Plantas/Index', [
            'plantas' => $plantas,
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
    public function show(Planta $planta)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Planta $planta)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Planta $planta)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Planta $planta)
    {
        //
    }

    public function byUser()
    {
        $userId = Auth::id();

        $offices = User::findOrFail($userId)
            ->branchOffices()
            ->select('branch_offices.id', 'branch_offices.code')
            ->get();

        return response()->json($offices);
    }
}
