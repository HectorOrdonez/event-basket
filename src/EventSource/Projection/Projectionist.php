<?php

namespace EventBasket\EventSource\Projection;

use Illuminate\Support\Collection;

/** @inheritDoc */
class Projectionist implements ProjectionistInterface
{
    private int $sleep = 100000;

    public function __construct(private readonly Collection $projectors)
    {

    }

    public function boot(): void
    {
        dump('Projectionist booting');
    }

    public function play(): void
    {
        dump('Projectionist playing');
        do {
            $this->projectors->each(fn($projector) => dump('Projector ' . get_class($projector) . ' playing'));
            usleep($this->sleep);
        } while (true);
    }
}
