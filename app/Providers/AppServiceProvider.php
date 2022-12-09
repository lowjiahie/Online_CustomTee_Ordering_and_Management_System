<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\StaffRepositoryInterface;
use App\Repositories\StaffRepository;
use App\Repositories\PrintingMethodRepositoryInterface;
use App\Repositories\PrintingMethodRepository;
use App\Repositories\DesignRepositoryInterface;
use App\Repositories\DesignRepository;
use App\Repositories\PlainTeeRepositoryInterface;
use App\Repositories\PlainTeeRepository;
use App\Repositories\CompetitionRepositoryInterface;
use App\Repositories\CompetitionRepository;
use App\Repositories\OrderRepositoryInterface;
use App\Repositories\OrderRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(StaffRepositoryInterface::class, StaffRepository::class);
        $this->app->bind(PrintingMethodRepositoryInterface::class, PrintingMethodRepository::class);
        $this->app->bind(DesignRepositoryInterface::class, DesignRepository::class);
        $this->app->bind(PlainTeeRepositoryInterface::class, PlainTeeRepository::class);
        $this->app->bind(CompetitionRepositoryInterface::class, CompetitionRepository::class);
        $this->app->bind(OrderRepositoryInterface::class, OrderRepository::class);
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
