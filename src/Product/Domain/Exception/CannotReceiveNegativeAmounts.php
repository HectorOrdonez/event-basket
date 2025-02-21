<?php

namespace EventBasket\Product\Domain\Exception;

use EventBasket\Product\Domain\Product;
use Exception;

class CannotReceiveNegativeAmounts extends Exception
{
    const ERROR_ADDING_STOCK = 'Cannot receive negative amounts of stock; received %d for product %s.';
    const ERROR_SHIPPING = 'Cannot receive negative amounts to ship; received %d for product %s.';
    const ERROR_SELLING = 'Cannot receive negative amounts to sell; received %d for product %s.';

    public static function ofStock(Product $product, $quantity): self
    {
        return new self(sprintf(self::ERROR_ADDING_STOCK, $quantity, $product->productId));
    }

    public static function toShip(Product $product, int $quantity): self
    {
        return new self(sprintf(self::ERROR_SHIPPING, $quantity, $product->productId));
    }

    public static function toSell(Product $product, int $quantity): self
    {
        return new self(sprintf(self::ERROR_SELLING, $quantity, $product->productId));
    }
}
