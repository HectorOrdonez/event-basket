<?php

namespace Tests\Unit\Product\Domain;

use EventBasket\Product\Domain\Product;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class ProductTest extends TestCase
{
    #[Test]
    public function aNewProductHasGivenName()
    {
        $product = new Product('product name');

        $this->assertEquals('product name', $product->name);
    }

    #[Test]
    public function aNewProductHas0AvailableStock()
    {
        $product = new Product('new product');

        $this->assertEquals(0, $product->availableStock);
    }
}
