<?php

namespace EventBasket\EventSource\Projection;

use EventBasket\EventSource\Projection\Entity\Projector;
use EventBasket\EventSource\Projection\Entity\ProjectorCollection;

interface ProjectorRepositoryInterface
{
    public function findActive(): ProjectorCollection;

    public function findNew(): ProjectorCollection;

    public function update(Projector $projector): void;
}
