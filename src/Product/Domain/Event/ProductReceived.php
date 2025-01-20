<?php

namespace EventBasket\Product\Domain\Event;

use Carbon\Carbon;
use EventBasket\EventSourcing\Event;

readonly class ProductReceived implements Event
{
    public function __construct(
        public string $productId,
        public int    $quantity,
        public Carbon $date,
    )
    {

    }
}