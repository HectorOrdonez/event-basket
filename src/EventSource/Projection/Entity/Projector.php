<?php

namespace EventBasket\EventSource\Projection\Entity;

use EventBasket\EventSource\Projection\ProjectorInterface;
use EventBasket\EventSource\Projection\ProjectorMode;
use EventBasket\EventSource\Projection\ProjectorState;

abstract class Projector implements ProjectorInterface
{
    public function __construct(
        public int            $id,
        public ProjectorState $state,
        public ProjectorMode  $mode,
    )
    {

    }

    public function initialise(): void
    {
        $this->createProjection();
        $this->state = ProjectorState::Booting;
    }
    abstract protected function createProjection(): void;
}
