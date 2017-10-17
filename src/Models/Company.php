<?php

namespace Nero\ValeExpress\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
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

    /**
     * Cria relacionamento com a model Employee
     *
     * @return mixed
     */
    public function employees()
    {
        return $this->hasMany(Employee::class, 'company_id');
    }
}
