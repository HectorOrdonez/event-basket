<?php

namespace EventBasket\Product\Infrastructure\Projector;

use EventBasket\EventSource\Projection\Entity\Projector;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ProductListProjector extends Projector
{
    protected function createProjection(): void
    {
        dump(__CLASS__ . ' is creating the projection');

        Schema::create('projection_product_list', function (Blueprint $table) {
            $table->string('product_name');
        });
    }
}
