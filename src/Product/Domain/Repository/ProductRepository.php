<?php

namespace EventBasket\Product\Domain\Repository;

use EventBasket\Product\Domain\Product;
use Ramsey\Uuid\UuidInterface;

interface ProductRepository
{
    public function get(UuidInterface $productId): Product;

    /** Returns whether a product with given id already exists */
    public function exists(string $name): bool;

    public function save(Product $product): void;
}
