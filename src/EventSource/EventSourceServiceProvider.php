<?php

namespace EventBasket\EventSource;

use EventBasket\EventSource\Projection\Projectionist;
use EventBasket\EventSource\Projection\ProjectionistInterface;
use EventBasket\EventSource\Projection\ProjectorRepositoryInterface;
use EventBasket\EventSource\Projection\Repository\PostgresProjectorRepository;
use Illuminate\Database\Connection;
use Illuminate\Support\ServiceProvider;

class EventSourceServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(ProjectionistInterface::class, function () {
            return new Projectionist($this->app->get(ProjectorRepositoryInterface::class));
        });

        $this->app->singleton(ProjectorRepositoryInterface::class, function () {
            return new PostgresProjectorRepository($this->app->get(Connection::class));
        });
    }
}
