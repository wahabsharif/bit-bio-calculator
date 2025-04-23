@extends('layouts.dashboard')

@section('content')
    <div class="grid grid-cols-2 gap-4">
        <div class="container mx-auto px-4 py-8">
            <div class="flex flex-col md:flex-row items-start md:items-center justify-between mb-4 space-y-4 md:space-y-0">
                <h1 class="text-2xl font-semibold text-gray-800 uppercase">Recently Added Products</h1>
            </div>
            <div class="bg-white shadow rounded-lg p-4">
                @if ($products->isEmpty())
                    <div class="text-center text-gray-500">No products found.</div>
                @else
                    <div class="flex font-semibold text-sm text-gray-700 mb-2 border-b-2 border-gray-200 pb-2">
                        <div class="w-full">Name</div>
                        <div class="w-1/3">SKU</div>
                        <div class="w-1/3">Seeding Density</div>
                    </div>
                    <div>
                        @foreach ($products->take(5) as $product)
                            <div class="flex py-2 border-b border-gray-400 text-sm">
                                <div class="w-full">{{ $product->product_name }}</div>
                                <div class="w-1/3">{{ $product->sku }}</div>
                                <div class="w-1/3">
                                    {{ $product->seeding_density ? number_format($product->seeding_density) : 'N/A' }}</div>
                            </div>
                        @endforeach
                    </div>
                    @if ($products->count() > 5)
                        <div class="flex justify-end mt-4">
                            <a href="{{ url('/dashboard/products') }}"
                                class="bg-blue-500 text-white px-4 py-1 rounded-lg hover:bg-blue-600">Load More</a>
                        </div>
                    @endif
                @endif
            </div>
        </div>
        <div></div>
    </div>
@endsection
