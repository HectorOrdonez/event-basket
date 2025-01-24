<div class="text-gray-900 text-sm">
    <nav class="bg-gray-900 text-white px-4 py-3 flex items-center justify-between">
        <div class="flex space-x-4 items-center">
            <a href="{{ route("landing") }}">
                <div class="logo-container">
                    <img class="logo" src="{{ asset('img/logo.png') }}" alt="logo">
                </div>
            </a>
            <ul class="flex items-center font-semibold space-x-4">
                <li><a class="hover:text-gray-400" href="{{ route('products') }}">Products</a></li>
            </ul>
        </div>
{{--        <div>right section</div>--}}
    </nav>
</div>
