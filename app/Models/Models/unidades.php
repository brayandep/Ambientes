<?php

namespace App\Models\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class unidades extends Model
{
    use HasFactory;
    protected $table = 'unidades';
    protected $fillable = ['nombre', 'capacidad',];
}


