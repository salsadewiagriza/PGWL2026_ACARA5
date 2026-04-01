<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Polyline extends Model
{
    protected $table = 'polylines';

    protected $fillable = [
        'name',
        'description',
        'geometry'
    ];
}