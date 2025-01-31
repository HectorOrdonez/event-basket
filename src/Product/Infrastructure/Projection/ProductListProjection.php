<?php

namespace EventBasket\Product\Infrastructure\Projection;

use EventBasket\EventSource\Event\EventInterface;

class ProductListProjection
{
    public function applyEvent(EventInterface $event): void
    {
        dump('processing event ... ' . get_class($event));
    }
}
