<?php

namespace EventBasket\Product\Domain;

use Carbon\Carbon;
use EventBasket\EventSourcing\Event;
use EventBasket\Product\Domain\Event\ProductReceived;

class Product
{
    public string $productId;
    public int $availableStock = 0;

    private array $events;

    public function __construct(string $productId)
    {
        $this->productId = $productId;
    }

    public function receiveStock(int $quantity): void
    {
        $this->addEvent(new ProductReceived($this->productId, $quantity, Carbon::now()));
    }

    public function addEvent(Event $event): void
    {
        match (true) {
            $event instanceof ProductReceived => $this->applyProductReceived($event),
            // @todo implement default that breaks things for unknown events
        };

        $this->events[] = $event;
    }

    private function applyProductReceived(ProductReceived $event): void
    {
        $this->availableStock += $event->quantity;
    }

    public function events(): array
    {
        return $this->events;
    }
}
