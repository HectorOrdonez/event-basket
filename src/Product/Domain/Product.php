<?php

namespace EventBasket\Product\Domain;

use Carbon\Carbon;
use EventBasket\EventSource\Event\EventInterface;
use EventBasket\Product\Domain\Event\ProductCreated;
use EventBasket\Product\Domain\Event\ProductReceived;
use EventBasket\Product\Domain\Event\ProductShipped;
use EventBasket\Product\Domain\Event\ProductSold;
use EventBasket\Product\Domain\Event\ProductStockAdjusted;
use EventBasket\Product\Domain\Exception\CannotReceiveNegativeAmounts;
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

    /** @throws CannotReceiveNegativeAmounts */
    public function receiveStock(int $amount): void
    {
        if ($amount < 0) {
            throw CannotReceiveNegativeAmounts::ofStock($this, $amount);
        }

        $this->applyEvent(new ProductReceived($this->productId, $amount, Carbon::now()));
    }

    /** @throws NotEnoughStock|CannotReceiveNegativeAmounts */
    public function ship(int $amount): void
    {
        if ($amount < 0) {
            throw CannotReceiveNegativeAmounts::toShip($this, $amount);
        }
        if ($this->availableStock < $amount) {
            throw NotEnoughStock::toShip($this, $amount);
        }

        $this->applyEvent(new ProductShipped($this->productId, $amount, Carbon::now()));
    }

    public function adjust(int $amount): void
    {
        $this->applyEvent(new ProductStockAdjusted($this->productId, $amount, Carbon::now()));
    }

    public function sell(int $amount): void
    {
        if ($amount < 0) {
            throw CannotReceiveNegativeAmounts::toSell($this, $amount);
        }

        $this->applyEvent(new ProductSold($this->productId, $amount, Carbon::now()));
    }

    public function applyEvent(EventInterface $event): void
    {
        match (true) {
            $event instanceof ProductCreated => $this->applyProductCreated($event),
            $event instanceof ProductReceived => $this->applyProductReceived($event),
            $event instanceof ProductShipped => $this->applyProductShipped($event),
            $event instanceof ProductStockAdjusted => $this->applyProductStockAdjusted($event),
            $event instanceof ProductSold => $this->applyProductSold($event),
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

    private function applyProductStockAdjusted(ProductStockAdjusted $event): void
    {
        $this->availableStock += $event->quantity;
    }

    private function applyProductSold(ProductSold $event): void
    {
        $this->availableStock -= $event->quantity;
    }

    public function events(): array
    {
        return $this->events;
    }
}
