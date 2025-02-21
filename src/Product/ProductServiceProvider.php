<?php

namespace EventBasket\Product;

use EventBasket\Product\Domain\Repository\ProductRepository;
use EventBasket\Product\Infrastructure\Repository\PostgresProductRepository;
use Illuminate\Database\DatabaseManager;
use Illuminate\Support\ServiceProvider;

class ProductServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(ProductRepository::class, function () {
            $repository = new PostgresProductRepository($this->app->get(DatabaseManager::class));

//            $product = new Product('qwe123');
//            $product->receiveStock(5);
//            $product->receiveStock(11);
//            $product->ship(5);
//
//            $repository->save($product);

            return $repository;
        });
    }
}
