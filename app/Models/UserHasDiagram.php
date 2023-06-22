<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserHasDiagram extends Model
{
    use HasFactory;

    protected $table = 'user_has_diagrams';

    protected $fillable = [
        'role',
        'user_id',
        'diagram_id',
    ];

}
