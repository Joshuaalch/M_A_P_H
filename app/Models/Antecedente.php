<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Antecedente extends Model
{
    use HasFactory;

    protected $table = 'tbantecedentes';

    protected $primaryKey = 'id_antecedente';

    protected $fillable = [
        'id_empresa',
        'id_cedula',
        'app',
        'apf',
        'aqx',
        'tx',
        'observaciones',
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