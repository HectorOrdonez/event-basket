<?php

namespace App\Http\Controllers;

use EventBasket\Product\Domain\Repository\ProductRepository;

class LandingPageController extends Controller
{


    public function index(ProductRepository $repository)
    {
        $product = $repository->get('qwe123');

        return view('landing-page.index', [
            'productId' => $product->productId,
            'quantity' => $product->availableStock,
        ]);
    }

    public function store()
    {
        dd('Storing!');

    }

}
