<?php

namespace App\Http\Controllers;
use App\Models\Assistance;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AssistanceController
{
    public function index()
    {
        $selectColumns = [
            'e.id as employee_id',
            'e.full_name as employee_name',
            'i.external_code as incidence_code',
            'i.incapacity_code as incapacity_code',
            'i.category_incidence_id as category_incidence_id',
            'assistances.date as observation_date',
            'ei.document_number as document',
            'ei.id as employee_incidence',
        ];

        // Usa el modelo de Asistencia para construir la consulta con Eloquent
        $asistencias = Assistance::select($selectColumns)
            ->join('employees as e', 'e.id', '=', 'assistances.employee_id')
            ->leftJoin('incidences as i', 'i.id', '=', 'assistances.incidence_id')
            ->leftJoin('employee_incidences as ei', 'ei.id', '=', 'assistances.employee_incidence_id')
            ->leftJoin('category_incidences as ci', 'ci.id', '=', 'i.category_incidence_id')
            ->whereIn('assistances.incidence_id', [9, 10, 11, 50, 4, 5, 6, 7, 8])
            ->where('e.status', '<>', 'termination')
            ->whereNull('assistances.deleted_at')
            ->limit(500)
            ->get();

        return Inertia::render('Assistence/Index', [
            'asistencias' => $asistencias
        ]);
    }
}
