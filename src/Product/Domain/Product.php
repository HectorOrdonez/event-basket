<?php

namespace EventBasket\Product\Domain;

class Product
{
    public string $name;
    public int $availableStock = 0;

    public function __construct(string $name)
    {
        $this->name = $name;
    }
}
