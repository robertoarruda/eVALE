<?php

namespace Nero\ValeExpress\Models;

use Illuminate\Database\Eloquent\Model;

class FuelStation extends Model
{
    /**
     * @var array Campos atribuiveis
     */
    protected $fillable = [
        'name',
        'cnjp',
        'address',
        'phone',
    ];

    /**
     * @var array Campos visiveis na lista
     */
    protected $visible = [
        'id',
        'name',
        'cnjp',
        'address',
        'phone',
    ];

    /**
     * @var array Tipos dos campos
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'cnjp' => 'string',
        'address' => 'string',
        'phone' => 'string',
    ];
}
