<x-layout>
    <div class="container flex mx-auto my-8 py-4 px-4 bg-blue-100 rounded-md">
        <div class="w-full">
            <div class="text-2xl">Product id: {{ $id }}</div>

            <hr class="h-0.5 w-full my-8 bg-black rounded-sm">

            <div class="flex">
                <div class="pb-4 pr-2 font-semibold">Name:</div>
                <div>{{ $name }}</div>
            </div>
        </div>
    </div>
    </div>
</x-layout>
