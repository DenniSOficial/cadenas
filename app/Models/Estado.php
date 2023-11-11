<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{
    use HasFactory;

    protected $table = 'Estado';
    protected $primaryKey = 'IdEstado';

    protected $fillable = ['DescripcionEstado'];
}
