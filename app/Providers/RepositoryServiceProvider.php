<?php

namespace App\Providers;

use App\Repositories\LinkRepositoryInterface;
use App\Repositories\LinksCacheRepository;
use App\Repositories\LinksSQLRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * All of the container singletons that should be registered.
     *
     * @var array
     */
    public $singletons = [
//        LinkRepositoryInterface::class => LinksSQLRepository::class,
        LinkRepositoryInterface::class => LinksCacheRepository::class,
    ];

    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
