<?php

namespace EventBasket\EventSource\Projection;

use Illuminate\Support\Facades\Schema;

/**
 * A projector knows what events need to be listened and how they relate to the projection
 * it is in charge of.
 */
interface ProjectorInterface
{
    /**
     * Initialises the projection table, a step required before booting a projection
     *
     * @return void
     */
    public function initialise(): void;
}
