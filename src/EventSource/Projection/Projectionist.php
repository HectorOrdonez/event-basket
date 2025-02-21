<?php

namespace EventBasket\EventSource\Projection;

use EventBasket\EventSource\Projection\Entity\Projector;

/** @inheritDoc */
class Projectionist implements ProjectionistInterface
{
    private int $sleep = 100000;

    public function __construct(private readonly ProjectorRepositoryInterface $repository)
    {

    }

    public function boot(): void
    {
        dump('Projectionist is initialising projectors...');

        $newProjectors = $this->repository->findNew();
        $newProjectors->each(function (Projector $projector) {
            $projector->initialise();
            $this->repository->update($projector);
        });

        // We need to fetch projectors that require booting
        // Such projectors are:
        // - booting: these projectors have just been initialised
        // - broken: these projectors broke and require booting
        // - /.s ndingProjector = $this->repository->findPending();
        // /$eventStore

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
