<?php

namespace EventBasket\EventSource\Projection\Entity;

use EventBasket\EventSource\Projection\ProjectorMode;
use EventBasket\EventSource\Projection\ProjectorState;

class Projector
{
    public function __construct(
        private int            $id,
        private string         $name,
        private ProjectorState $state,
        private ProjectorMode  $mode,
    )
    {

    }
}
