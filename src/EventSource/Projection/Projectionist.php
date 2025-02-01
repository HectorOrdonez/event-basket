<?php

namespace EventBasket\EventSource\Projection;

/** @inheritDoc */
class Projectionist implements ProjectionistInterface
{
    private int $sleep = 100000;

    public function __construct(private readonly ProjectorRepositoryInterface $repository)
    {

    }

    public function boot(): void
    {
        dump('Projectionist booting');
        $projectors = $this->repository->findPending();
        $projectors->each(fn($projector) => dump('Projector ' . get_class($projector) . ' booting'));
        usleep($this->sleep);
    }

    public function play(): void
    {
        dump('Projectionist playing');
        do {
            $projectors = $this->repository->findActive();
            $projectors->each(fn($projector) => dump('Projector ' . get_class($projector) . ' playing'));
            usleep($this->sleep);
        } while (true);
    }
}
