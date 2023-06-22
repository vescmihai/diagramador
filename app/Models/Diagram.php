<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diagram extends Model
{
    use HasFactory;

    protected $table = 'diagrams';

    protected $fillable = [
        'diagram_name',
        'diagram_json',
        'diagram_type',
        'diagram_json_copy',
        'diagram_img',
        'user_id',
    ];
}
