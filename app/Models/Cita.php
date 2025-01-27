<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cita extends Model
{
    use HasFactory;

    protected $table = 'tbcita';

    protected $primaryKey = 'id_cita';

    protected $fillable = [
        'id_empresa',
        'id_cedula_usuario',
        'id_cedula_paciente',
        'fecha',
        'hora_inicio',
        'hora_final',
    ];

    public function paciente()
    {
        return $this->belongsTo(Paciente::class, 'id_cedula_paciente', 'id_cedula');
    }

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'id_cedula_usuario', 'id_cedula');
    }

    public function empresa()
    {
        return $this->belongsTo(Empresa::class, 'id_empresa', 'id_empresa');
    }
}