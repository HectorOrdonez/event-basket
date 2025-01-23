<?php

namespace App\Http\Controllers;

use EventBasket\Product\Domain\Product;
use EventBasket\Product\Domain\Repository\ProductRepository;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;

class ProductsController extends Controller
{
    public function index()
    {
        return view('products.index');
    }

    public function store(ProductRepository $repository, Request $request)
    {
        $name = $request->get('name');

        if ($repository->exists($name)) {
            dd('EXISTS YO' . $name);
        }

        $product = new Product();
        $product->create($name);
        // @todo When/where do you dispatch events, in the aggregates or when you process the aggregate
        // @todo in the repository?
        // @todo It could be that an aggregate receives an action, but when persisting something goes wrong
        $repository->save($product);

        return redirect()->route('products.show', ['id' => $product->productId]);
    }

    public function show(ProductRepository $repository, string $productId)
    {
        $product = $repository->get(Uuid::fromString($productId));

        return view('products.show', [
            'id' => $product->productId,
            'name' => $product->name,
        ]);
    }
}
