<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    use HasFactory;
    
    public $timestamps = false;
    
    protected $table = 'tbusuario';
    
    protected $primaryKey = 'id_cedula';

    public $incrementing = false; // Evita que Laravel trate la PK como autoincremental
    protected $keyType = 'string'; // Indica que la PK es un string, no un número

    protected $fillable = [
        'id_cedula',
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
    public function mensualidades()
    {
        return $this->hasMany(MensualidadUsuario::class, 'id_cedula', 'id_cedula');
    }
    
    public function empresa()
    {
        return $this->belongsTo(Empresa::class, 'id_empresa', 'id_empresa');
        
    }
}
