<?php

namespace Nero\Evale\Models;

use Illuminate\Database\Eloquent\Model;

class FuelType extends Model
{
    /**
     * @var array Campos atribuiveis
     */
    protected $fillable = [
        'name',
    ];

    /**
     * @var array Campos visiveis na lista
     */
    protected $visible = [
        'id',
        'name',
    ];

    /**
     * @var array Tipos dos campos
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
    ];

    /**
     * Cria relacionamento com a model FillUp
     *
     * @return mixed
     */
    public function fillUps()
    {
        return $this->hasMany(FillUp::class, 'fuel_type_id');
    }
}
