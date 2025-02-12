<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'tbempresa';

    protected $primaryKey = 'id_empresa';
    public $incrementing = false;
    protected $keyType = 'int';
    


    protected $fillable = [
      'id_empresa',
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