<?php

namespace App\Providers;

use App\DAO\PlanteInterface;
use App\DAO\PlanteRepository;
use App\DAO\CommandeInterface;
use App\DAO\CommandeRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(PlanteInterface::class, PlanteRepository::class);
        $this->app->bind(CommandeInterface::class, CommandeRepository::class);

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
