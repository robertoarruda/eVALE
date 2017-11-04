<?php

namespace App\Providers;

use Faker\Factory as FakerFactory;
use Faker\Generator as FakerGenerator;
use Illuminate\Support\ServiceProvider;
use Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend(
            'subscription_limit',
            'Nero\Evale\Validator\EmployeeValidator@validateSubscriptionLimit'
        );

        Validator::extend(
            'employee_login',
            'Nero\Evale\Validator\FillUpValidator@validateEmployeeLogin'
        );

        Validator::extend(
            'consumption_limit',
            'Nero\Evale\Validator\FillUpValidator@validateConsumptionLimit'
        );
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(FakerGenerator::class, function () {
            return FakerFactory::create('pt_BR');
        });
    }
}
