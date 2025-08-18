<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Assistance extends Model
{

    use HasFactory, SoftDeletes;

    protected $table = 'assistances';

    protected $fillable = [
        'employee_id',
        'incidence_id',
        'employee_incidence_id',
        'date',
    ];

    protected $casts = [
        'date' => 'datetime',
    ];

}