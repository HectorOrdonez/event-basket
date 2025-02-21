<x-layout>
    <div class="container flex mx-auto my-8 py-4 px-4 bg-blue-100 rounded-md">
        <div class="w-full">
            <div class="text-2xl">Product id: {{ $id }}</div>

            <hr class="h-0.5 w-full my-8 bg-black rounded-sm">

            <div class="flex">
                <div class="pb-4 pr-2 font-semibold">Name:</div>
                <div>{{ $name }}</div>
            </div>

            <div class="flex">
                <div class="pb-4 pr-2 font-semibold">Stock:</div>
                <div>{{ $stock}}</div>
            </div>

            <div>
                <div class="pb-4 pr-2 font-semibold">Things that happened to it:</div>
                <ol class="pl-5 list-decimal">
                    @foreach($events as $event)
                        <li> {{ get_class($event) }}</li>
                    @endforeach
                </ol>
            </div>
        </div>
    </div>

    <div class="container flex mx-auto my-8 py-4 px-4 bg-blue-100 rounded-md">
        <div class="w-full">
            <div class="text-2xl">Actions</div>

            <hr class="h-0.5 w-full my-8 bg-black rounded-sm">
            <form method="post" action="{{ route('products.add', $id) }}" class="w-1/5 flex pb-4">
                @csrf
                <input
                    type="number"
                    id="add-stock"
                    name="amount"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-1/3 p-2.5 mr-2"
                    placeholder="0"
                    required
                />
                <button class="bg-green-300 hover:bg-green-500 py-2 px-4 rounded w-full">Add Stock</button>
            </form>

            <form method="post" action="{{ route('products.ship', $id) }}" class="w-1/5 flex pb-4">
                @csrf
                <input
                    type="number"
                    id="ship"
                    name="amount"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-1/3 p-2.5 mr-2"
                    placeholder="0"
                    required
                />
                <button class="bg-green-300 hover:bg-green-500 py-2 px-4 rounded w-full">Ship</button>
            </form>

            <form method="post" action="{{ route('products.sell', $id) }}" class="w-1/5 flex pb-4">
                @csrf
                <input
                    type="number"
                    id="sell"
                    name="amount"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-1/3 p-2.5 mr-2"
                    placeholder="0"
                    required
                />
                <button class="bg-green-300 hover:bg-green-500 py-2 px-4 rounded w-full">Sell</button>
            </form>

            <form method="post" action="{{ route('products.adjust', $id) }}" class="w-1/5 flex pb-4">
                @csrf
                <input
                    type="number"
                    id="adjust"
                    name="amount"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-1/3 p-2.5 mr-2"
                    placeholder="0"
                    required
                />
                <button class="bg-green-300 hover:bg-green-500 py-2 px-4 rounded w-full">Adjust</button>
            </form>
        </div>
        {{--            <button class="bg-green-300 hover:bg-green-500 py-2 px-4 rounded">Ship</button>--}}
        {{--            <button class="bg-green-300 hover:bg-green-500 py-2 px-4 rounded">Sell</button>--}}
        {{--            <button class="bg-green-300 hover:bg-green-500 py-2 px-4 rounded">Adjust inventory</button>--}}
    </div>
    </div>

</x-layout>
