<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consulta extends Model
{
    use HasFactory;

    protected $table = 'tbconsulta';

    protected $primaryKey = 'id_consulta';

    protected $fillable = [
        'id_cedula',
        'id_empresa',
        'tipoconsulta',
        'valoracion',
        'presion_arterial',
        'frecuencia_cardiaca',
        'saturacion_oxigeno',
        'glicemia',
        'frecuencia_respiratoria',
        'plan_tratamiento',
        'fecha_consulta',
        'monto_consulta',
        'estado',
    ];

    public function paciente()
    {
        return $this->belongsTo(Paciente::class, 'id_cedula', 'id_cedula');
    }

    public function empresa()
    {
        return $this->belongsTo(Empresa::class, 'id_empresa', 'id_empresa');
    }
}