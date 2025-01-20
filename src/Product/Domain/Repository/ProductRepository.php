<?php

namespace EventBasket\Product\Domain\Repository;

use EventBasket\Product\Domain\Product;

interface ProductRepository
{
    public function get(string $productId): Product;

    public function save(Product $product): void;
}
