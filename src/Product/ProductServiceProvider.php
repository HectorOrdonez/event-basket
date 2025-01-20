<?php

namespace EventBasket\Product;

use EventBasket\Product\Domain\Product;
use EventBasket\Product\Domain\Repository\ProductRepository;
use EventBasket\Product\Infrastructure\Repository\InMemoryProductRepository;
use Illuminate\Support\ServiceProvider;

class ProductServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(ProductRepository::class, function () {
            $repository = new InMemoryProductRepository();

            $product = new Product('qwe123');
            $product->receiveStock(5);
            $product->receiveStock(11);
            $product->ship(5);

            $repository->save($product);

            return $repository;
        });
    }
}
