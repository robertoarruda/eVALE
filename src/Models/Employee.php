<?php

namespace Nero\ValeExpress\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    /**
     * @var array Campos atribuiveis
     */
    protected $fillable = [
        'company_id',
        'cpf',
        'registration_number',
        'name',
        'password',
    ];

    /**
     * @var array Campos visiveis na lista
     */
    protected $visible = [
        'id',
        'company_id',
        'cpf',
        'registration_number',
        'name',
        'password',
    ];

    /**
     * @var array Tipos dos campos
     */
    protected $casts = [
        'id' => 'integer',
        'company_id' => 'string',
        'cpf' => 'string',
        'registration_number' => 'string',
        'name' => 'string',
        'password' => 'string',
    ];

    /**
     * Cria relacionamento com a model Company
     *
     * @return mixed
     */
    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }
}
