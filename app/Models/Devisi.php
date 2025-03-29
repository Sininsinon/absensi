<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Devisi extends Model
{
    use HasFactory;

    protected $table = 'divisions';

    protected $fillable = [
        'id',
        'name_divisions',
    ];
}
