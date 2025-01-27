<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    use HasFactory;

    protected $table = 'tbusuario';

    protected $primaryKey = 'id_cedula';

    protected $fillable = [
        'tipo_cedula',
        'id_empresa',
        'nombre',
        'apellidos',
        'telefono',
        'correo',
        'contrasena',
        'rol',
        'estado',
    ];

    public function empresa()
    {
        return $this->belongsTo(Empresa::class, 'id_empresa', 'id_empresa');
    }
}