<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contrato extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'id_imovel','tipo_pessoa', 'documento', 'email_contratante', 'nome_completo'
    ];
}
