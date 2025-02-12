<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MensualidadUsuario extends Model
{
    use HasFactory;

    protected $table = 'mensualidad_usuario'; // Nombre de la tabla

    protected $primaryKey = 'id_mensualidad'; // Clave primaria

    public $timestamps = false; // Usa created_at y updated_at

    protected $fillable = [
        'id_cedula',
        'fecha_inicio',
        'fecha_fin',
        'estado'
    ];

    // Relación con la tabla tbusuario
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'id_cedula', 'id_cedula');
    }
}
