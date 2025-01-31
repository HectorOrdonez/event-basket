<?php

namespace EventBasket\Product\Infrastructure\Repository;

use EventBasket\EventSource\Event\EventInterface;
use EventBasket\Product\Domain\Product;
use EventBasket\Product\Domain\Repository\ProductRepository;

class InMemoryProductRepository implements ProductRepository
{
    /** @var EventInterface[]  */
    private array $events;

    /** @param EventInterface[] $events */
    public function __construct(array $events = [])
    {
        $this->events = $events;
    }

    public function get(string $productId): Product
    {
        // @todo what happens when product does not exist
        $events = $this->events[$productId] ?? [];

        $product = new Product($productId);

        foreach($events as $event) {
            $product->applyEvent($event);
        }

        return $product;
    }

    public function save(Product $product): void
    {
        $this->events[$product->productId] = $product->events();
    }
}
