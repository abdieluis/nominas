<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CategoriaIncidencia extends Model
{
    use SoftDeletes;

    protected $table = 'category_incidences';

    protected $fillable = [
        'name',
        'code'
    ];
}
