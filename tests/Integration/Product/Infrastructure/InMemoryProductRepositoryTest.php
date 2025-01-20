<?php

namespace Tests\Integration\Product\Infrastructure;

use EventBasket\Product\Infrastructure\Repository\InMemoryProductRepository;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class InMemoryProductRepositoryTest extends TestCase
{
    #[Test]
    public function itGetsProductFromDb()
    {
        $productRepository = new InMemoryProductRepository();
    }
}
