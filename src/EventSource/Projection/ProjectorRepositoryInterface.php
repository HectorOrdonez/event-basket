<?php

namespace EventBasket\EventSource\Projection;

use EventBasket\EventSource\Projection\Entity\ProjectorCollection;

interface ProjectorRepositoryInterface
{
    public function findActive(): ProjectorCollection;

    public function findPending(): ProjectorCollection;
}
