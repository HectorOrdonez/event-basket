<?php

namespace EventBasket\Product\Domain;

use Carbon\Carbon;
use EventBasket\EventSource\Event\EventInterface;
use EventBasket\Product\Domain\Event\ProductCreated;
use EventBasket\Product\Domain\Event\ProductReceived;
use EventBasket\Product\Domain\Event\ProductShipped;
use EventBasket\Product\Domain\Exception\NotEnoughStock;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

class Product
{
    public UuidInterface $productId;
    public string $name;
    public int $availableStock = 0;

    private array $events;

    public function __construct()
    {
    }

    public function create(string $name): void
    {
        $this->applyEvent(new ProductCreated(Uuid::uuid4(), $name, Carbon::now()));
    }

    public function receiveStock(int $quantity): void
    {
        $this->applyEvent(new ProductReceived($this->productId, $quantity, Carbon::now()));
    }

    /** @throws NotEnoughStock */
    public function ship(int $quantity): void
    {
        if ($this->availableStock < $quantity) {
            throw NotEnoughStock::toShip($this, $quantity);
        }

        $this->applyEvent(new ProductShipped($this->productId, $quantity, Carbon::now()));
    }

    public function applyEvent(EventInterface $event): void
    {
        match (true) {
            $event instanceof ProductCreated => $this->applyProductCreated($event),
            $event instanceof ProductReceived => $this->applyProductReceived($event),
            $event instanceof ProductShipped => $this->applyProductShipped($event),
            // @todo implement default that breaks things for unknown events
        };

        $this->events[] = $event;
    }

    private function applyProductCreated(ProductCreated $event): void
    {
        $this->productId = $event->productId;
        $this->name = $event->name;
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
