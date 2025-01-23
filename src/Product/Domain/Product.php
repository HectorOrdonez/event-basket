<?php

namespace EventBasket\Product\Domain;

use Carbon\Carbon;
use EventBasket\EventSourcing\Event;
use EventBasket\Product\Domain\Event\ProductReceived;
use EventBasket\Product\Domain\Event\ProductShipped;
use EventBasket\Product\Domain\Exception\ProductNotFound;

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
        $this->applyEvent(new ProductReceived($this->productId, $quantity, Carbon::now()));
    }

    /** @throws ProductNotFound */
    public function ship(int $quantity): void
    {
        if ($this->availableStock < $quantity) {
            throw ProductNotFound::toShip($this, $quantity);
        }

        $this->applyEvent(new ProductShipped($this->productId, $quantity, Carbon::now()));
    }

    public function applyEvent(Event $event): void
    {
        match (true) {
            $event instanceof ProductReceived => $this->applyProductReceived($event),
            $event instanceof ProductShipped => $this->applyProductShipped($event),
            // @todo implement default that breaks things for unknown events
        };

        $this->events[] = $event;
    }

    private function applyProductReceived(ProductReceived $event): void
    {
        $this->availableStock += $event->quantity;
    }

    private function applyProductShipped(ProductShipped $event): void
    {
        $this->availableStock -= $event->quantity;
    }

    public function events(): array
    {
        return $this->events;
    }
}
