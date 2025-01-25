<x-layout>
    <div class="container flex mx-auto my-8 py-4 px-4 bg-blue-100 rounded-md">
        <div class="w-full">
            <div class="text-2xl">Create a new product</div>

            <hr class="h-0.5 w-full my-8 bg-black rounded-sm">
            <form method="post" action="{{ route('products.store') }}">
                @csrf
                <p class="pb-8">
                    <label class="pr-4" for="name">Name</label>
                    <input class="p-1 italic" type="text" name="name" id="name" value="name"/>
                </p>

                <button type="submit" class="bg-blue-500 rounded-md px-2 py-1">Create</button>
            </form>
        </div>
    </div>
    </div>
</x-layout>
