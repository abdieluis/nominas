<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Prestacion extends Model
{
    use SoftDeletes;

    protected $table = 'benefits';

    protected $fillable = [
        'name',
        'description',
        'conditioned',
        'each',
        'type',
        'conditioned_efficiency',
        'conditioned_seniority',
        'efficiency_rules', 
        'day_cutoff'
    ];
}
