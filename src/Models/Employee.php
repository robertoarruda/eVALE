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
        'name',
        'cpf',
        'registration_number',
        'consumption_limit',
        'password',
    ];

    /**
     * @var array Campos visiveis na lista
     */
    protected $visible = [
        'id',
        'company_id',
        'name',
        'cpf',
        'registration_number',
        'consumption_limit',
    ];

    /**
     * @var array Tipos dos campos
     */
    protected $casts = [
        'id' => 'integer',
        'company_id' => 'string',
        'name' => 'string',
        'cpf' => 'string',
        'registration_number' => 'string',
        'consumption_limit' => 'string',
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

    /**
     * Manipula campo antes de atribuir
     * @param string $password
     * @return string
     */
    public function setPasswordAttribute($password)
    {
        return $this->attributes['password'] = bcrypt($password);
    }
}
