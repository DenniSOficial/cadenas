<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    protected $table = 'Usuario';
    protected $primaryKey = 'IdUsuario';

    protected $fillable = ['IdEstado',
                            'Usuario',
                            'Password',
                            'NombreCompleto'];

    public $timestamps = false;
    
    public function rol() {
        return $this->belongsTo('App\Models\Rol', 'IdRol');
    }

    public function estado() {
        return $this->belongsTo('App\Models\Estado', 'IdEstado');
    }
}
