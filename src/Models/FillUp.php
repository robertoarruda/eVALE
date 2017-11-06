<?php

namespace Nero\Evale\Models;

use Illuminate\Database\Eloquent\Model;

class FillUp extends Model
{
    /**
     * @var array Campos atribuiveis
     */
    protected $fillable = [
        'company_id',
        'employee_id',
        'fuel_type_id',
        'value',
    ];

    /**
     * @var array Campos visiveis na lista
     */
    protected $visible = [
        'id',
        'company_id',
        'employee_id',
        'fuel_type_id',
        'value',
    ];

    /**
     * @var array Tipos dos campos
     */
    protected $casts = [
        'id' => 'integer',
        'company_id' => 'integer',
        'employee_id' => 'integer',
        'fuel_type_id' => 'integer',
        'value' => 'double',
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
     * Cria relacionamento com a model Employee
     *
     * @return mixed
     */
    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }

    /**
     * Cria relacionamento com a model FuelType
     *
     * @return mixed
     */
    public function fuelType()
    {
        return $this->belongsTo(FuelType::class, 'fuel_type_id');
    }
}
