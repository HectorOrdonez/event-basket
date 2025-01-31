<?php

use EventBasket\EventSource\EventSourceServiceProvider;
use EventBasket\Product\ProductServiceProvider;

return [
    App\Providers\AppServiceProvider::class,
    EventSourceServiceProvider::class,
    ProductServiceProvider::class,
];
