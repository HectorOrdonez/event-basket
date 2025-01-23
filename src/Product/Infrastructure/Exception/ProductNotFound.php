<?php

namespace EventBasket\Product\Infrastructure\Exception;

use Exception;

class ProductNotFound extends Exception
{
    const ERROR = 'Product with id %s not found.';

    public static function for(string $productId): self
    {
        return new self(sprintf(self::ERROR, $productId));
    }
}
