<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registro extends Model
{
    use HasFactory;

    protected $table = 'tbregistros';

    protected $primaryKey = 'id_registro';

    protected $fillable = [
        'id_empresa',
        'id_cedula',
        'fecha',
        'img1',
        'img2',
        'img3',
        'pdf',
        'detalle',
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