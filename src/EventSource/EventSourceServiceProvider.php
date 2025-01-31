<?php

namespace EventBasket\EventSource;

use EventBasket\EventSource\Projection\Projectionist;
use EventBasket\EventSource\Projection\ProjectionistInterface;
use EventBasket\Product\Infrastructure\Projector\ProductListProjector;
use Illuminate\Support\ServiceProvider;

class EventSourceServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(ProjectionistInterface::class, function () {
            return new Projectionist(collect([
                new ProductListProjector(),
            ]));
        });
    }
}
