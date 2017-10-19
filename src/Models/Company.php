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
        'cnpj',
        'address',
        'phone',
        'subscription_limit',
    ];

    /**
     * @var array Campos visiveis na lista
     */
    protected $visible = [
        'id',
        'name',
        'cnpj',
        'address',
        'phone',
        'subscription_limit',
    ];

    /**
     * @var array Tipos dos campos
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'cnpj' => 'string',
        'address' => 'string',
        'phone' => 'string',
        'subscription_limit' => 'double',
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
