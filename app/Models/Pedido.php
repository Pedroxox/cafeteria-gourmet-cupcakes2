<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $fillable = [
        'nome_cliente',
        'email_cliente',
        'telefone',
        'endereco_entrega',
        'data_entrega',
        'hora_entrega',
        'valor_total',
        'status'
    ];
}
