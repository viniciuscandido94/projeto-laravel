<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class log extends Model
{
    protected $fillable = [
      'data_hora', 'tipo', 'mensagem', 'aplicacao', 'usuario'
    ];
}
