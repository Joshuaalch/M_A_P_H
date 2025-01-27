<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    use HasFactory;

    protected $table = 'tbpaciente';

    protected $primaryKey = 'id_cedula';

    protected $fillable = [
        'tipo_cedula',
        'id_empresa',
        'nombre',
        'apellidos',
        'conocido_como',
        'telefono',
        'telefono_emergencia',
        'correo',
        'residencia',
        'observaciones',
        'estado',
    ];

    public function empresa()
    {
        return $this->belongsTo(Empresa::class, 'id_empresa', 'id_empresa');
    }

    public function antecedentes()
    {
        return $this->hasMany(Antecedente::class, 'id_cedula', 'id_cedula');
    }

    public function consultas()
    {
        return $this->hasMany(Consulta::class, 'id_cedula', 'id_cedula');
    }
}