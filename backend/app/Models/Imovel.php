<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Imovel extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'email_proprietario', 'rua', 'numero', 'complemento', 'bairro', 'cidade', 'estado',
    ];
}
