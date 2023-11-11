<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Control extends Model
{
    //use HasFactory;
    protected $table = 'Control';
    protected $primaryKey = 'IdUsuario';

    protected $fillable = ['Id',
                            'Descripcion',
                            'Usuario'];

    public $timestamps = false;
        
}
