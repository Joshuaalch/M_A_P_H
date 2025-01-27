<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    use HasFactory;

    protected $table = 'tbempresa';

    protected $primaryKey = 'id_empresa';

    protected $fillable = [
        'nombre',
        'cedula',
        'tipo_cedula',
        'telefono',
        'correo',
        'estado',
    ];

    public function pacientes()
    {
        return $this->hasMany(Paciente::class, 'id_empresa', 'id_empresa');
    }

    public function usuarios()
    {
        return $this->hasMany(Usuario::class, 'id_empresa', 'id_empresa');
    }
}