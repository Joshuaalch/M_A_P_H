<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoUsuario extends Model
{
    use HasFactory;

    protected $table = 'tbtipousuario';

    protected $primaryKey = 'id_tipo';

    protected $fillable = [
        'nombre',
    ];
}