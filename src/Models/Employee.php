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
        'registration_number',
        'name',
        'balance',
    ];

    /**
     * @var array Campos visiveis na lista
     */
    protected $visible = [
        'id',
        'company_id',
        'registration_number',
        'name',
        'balance',
    ];

    /**
     * @var array Tipos dos campos
     */
    protected $casts = [
        'id' => 'integer',
        'company_id' => 'string',
        'registration_number' => 'string',
        'name' => 'string',
        'balance' => 'double',
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
