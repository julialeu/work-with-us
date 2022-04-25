<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use WorkWithUs\Publishing\Domain\Repository\JobVacancyRepositoryInterface;
use WorkWithUs\Publishing\Infrastructure\Repository\JobVacancyRepositoryMySql;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            JobVacancyRepositoryInterface::class, JobVacancyRepositoryMySql::class
        );
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
