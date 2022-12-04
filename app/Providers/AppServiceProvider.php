<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\StaffRepositoryInterface;
use App\Repositories\StaffRepository;
use App\Repositories\PrintingMethodRepositoryInterface;
use App\Repositories\PrintingMethodRepository;
use App\Repositories\DesignRepositoryInterface;
use App\Repositories\DesignRepository;

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
