<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>NUUN</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->
        <script src="https://cdn.tailwindcss.com"></script>

        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
    </head>
    <body class="antialiased">
        <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">

            <div class="w-full flex flex-col px-6 py-4 lg:px-12 xl:px-16">

                <div class="flex flex-col md:flex-row justify-between items-center mb-6">
                    <h2 class="text-2xl font-mono font-bold text-gray-700 hover:text-red-400">Products</h2>
                    <form action="{{ route('products.store') }}" method="post">
                        @csrf
                        <button class="bg-gray-200 hover:bg-red-400 p-3 text-sm text-gray-700 dark:text-gray-500 underline" type="submit">Add New Product</button>
                    </form>
                </div>

                @if (session()->has('success'))
                    <div class="flex items-center justify-between w-full bg-green-100 py-3 px-4 my-3" role="alert">
                        <span class="text-green-800">{{ session('success') }}</span>
                        <button type="button" class="text-green-600 hover:text-green-800" onclick="this.parentElement.style.display='none'">&times;</button>
                    </div>
                @endif

                <div class="bg-white shadow-md p-3 mb-6 overflow-x-auto sm:overflow-x-visible">
                    <table class="min-w-max w-full table-auto">
                        <thead>
                            <tr class="bg-gray-200 text-gray-600 uppercase text-xs leading-normal">
                                <th class="py-3 text-center">Name</th>
                                <th class="py-3 text-center">Description</th>
                                <th class="py-3 text-center">Quantity</th>
                                <th class="py-3 text-center">Price</th>
                                <th></th>
                            </tr>
                        </thead>
                
                        <tbody class="text-gray-600 text-sm font-light">
                            @foreach ($products as $product)
                                <tr class="border-b border-gray-200 hover:bg-gray-100">
                                    <td class="py-1 text-center">{{ $product->name }}</td>
                                    <td class="py-1 text-center">{{ $product->description }}</td>
                                    <td class="py-1 text-center">{{ $product->qty }}</td>
                                    <td class="py-1 text-center">IDR {{ number_format($product->price, 0, ',', '.') }}</td>
                                    <td>
                                        <form action="{{ route('products.destroy', $product->id) }}" method="post" onsubmit="return confirm('Are you sure you want to delete this product?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 underline hover:text-red-800">
                                                Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="flex justify-center sm:items-center sm:justify-between">
                    <div class="text-center text-sm text-gray-500 sm:text-left">
                        <div class="flex items-center">
                            <svg fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor" class="-mt-px w-5 h-5 text-gray-400">
                                <path d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>

                            <a href="https://laravel.bigcartel.com" class="ml-1 underline">
                                Shop
                            </a>

                            <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="ml-4 -mt-px w-5 h-5 text-gray-400">
                                <path d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                            </svg>

                            <a href="https://github.com/sponsors/taylorotwell" class="ml-1 underline">
                                Sponsor
                            </a>
                        </div>
                    </div>

                    <div class="ml-4 text-center text-sm text-gray-500 sm:text-right sm:ml-0">
                        Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
