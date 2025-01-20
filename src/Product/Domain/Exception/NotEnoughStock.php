<?php

namespace EventBasket\Product\Domain\Exception;

use EventBasket\Product\Domain\Product;
use Exception;

class NotEnoughStock extends Exception
{
    const ERROR_SHIPPING = 'Could not ship %d units of Product %s: available stock is %d.';

    public static function toShip(Product $product, $quantity): self
    {
        return new self(sprintf(self::ERROR_SHIPPING, $quantity, $product->productId, $product->availableStock));
    }
}
