
<x-layout>
    <div class="container flex mx-auto my-6 px-4 py-2 bg-blue-100 rounded-md">
        <div>
            <div class="text-2xl">Products</div>
            <form method="post" action="{{ route('products.store') }}">
                @csrf
                <label for="name">Product name</label>
                <input type="text" name="name" id="name" value="name" style="color: black"/>
                <button type="submit" class="bg-blue-500 rounded-md px-2 py-1">Add Product</button>
            </form>
        </div>
    </div>
</x-layout>
