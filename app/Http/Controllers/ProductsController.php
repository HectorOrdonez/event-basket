<?php

namespace App\Http\Controllers;

use EventBasket\Product\Domain\Product;
use EventBasket\Product\Domain\Repository\ProductRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Ramsey\Uuid\Uuid;

class ProductsController extends Controller
{
    public function index(): View
    {
        return view('products.index');
    }

    public function store(ProductRepository $repository, Request $request): RedirectResponse
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

    public function show(ProductRepository $repository, string $productId): View
    {
        $product = $repository->get(Uuid::fromString($productId));

        return view('products.show', [
            'id' => $product->productId,
            'name' => $product->name,
            'stock' => $product->availableStock,
            'events' => $product->events(),
        ]);
    }

    public function create(): View
    {
        return view('products.create');
    }

    public function add(Request $request, ProductRepository $repository): RedirectResponse
    {
        $product = $repository->get(Uuid::fromString($request->route('id')));
        $amount = $request->get('amount');

        $product->receiveStock($amount);
        $repository->save($product);

        return redirect()->route('products.show', ['id' => $product->productId]);
    }

    public function ship(Request $request, ProductRepository $repository): RedirectResponse
    {
        $product = $repository->get(Uuid::fromString($request->route('id')));
        $amount = $request->get('amount');

        $product->ship($amount);
        $repository->save($product);

        return redirect()->route('products.show', ['id' => $product->productId]);
    }

    public function sell(Request $request, ProductRepository $repository): RedirectResponse
    {
        $product = $repository->get(Uuid::fromString($request->route('id')));
        $amount = $request->get('amount');

        $product->sell($amount);
        $repository->save($product);

        return redirect()->route('products.show', ['id' => $product->productId]);
    }

    public function adjust(Request $request, ProductRepository $repository): RedirectResponse
    {
        $product = $repository->get(Uuid::fromString($request->route('id')));
        $amount = $request->get('amount');

        $product->adjust($amount);
        $repository->save($product);

        return redirect()->route('products.show', ['id' => $product->productId]);
    }
}
