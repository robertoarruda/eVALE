<?php

namespace Nero\Evale\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Company extends Authenticatable
{
    use Notifiable;

    /**
     * @var array Campos atribuiveis
     */
    protected $fillable = [
        'name',
        'cnpj',
        'address',
        'phone',
        'subscription_limit',
        'login',
        'password',
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
        'login',
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
        'login' => 'string',
        'password' => 'string',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
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

    /**
     * Cria relacionamento com a model FillUp
     *
     * @return mixed
     */
    public function fillUps()
    {
        return $this->hasMany(FillUp::class, 'company_id');
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
