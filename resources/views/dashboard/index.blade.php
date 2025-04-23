@extends('layouts.dashboard')

@section('content')
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
        <!-- Products List -->
        <div class="container mx-auto">
            <!-- Title and Actions -->
            <div
                class="flex flex-col md:flex-row items-start md:items-center justify-between mb-2  md:mb-4 space-y-4 md:space-y-0">
                <h1 class="text-md font-bold md:text-2xl text-gray-800 capitalize ">Recently Products Added</h1>
            </div>

            <!-- Table Wrapper with Horizontal Scroll on Mobile -->
            <div class="bg-white shadow rounded-lg p-4 overflow-x-auto">
                @if ($products->isEmpty())
                    <div class="text-center text-gray-500">No products found.</div>
                @else
                    <!-- Header Row: hidden on small screens -->
                    <div class="hidden md:flex font-semibold text-sm text-gray-700 mb-2 border-b-2 border-gray-200 pb-2">
                        <div class="md:w-1/3">Name</div>
                        <div class="md:w-1/3">SKU</div>
                        <div class="md:w-1/3">Seeding Density</div>
                    </div>

                    <!-- Data Rows -->
                    <div class="space-y-2 md:space-y-0 divide-y divide-gray-200">
                        @foreach ($products->take(5) as $product)
                            <div class="flex flex-col md:flex-row py-2 space-y-2 md:space-y-0 md:items-center">
                                <div class="md:w-1/3"><label class="font-bold text-sm mr-1 block md:hidden">Name:</label>
                                    <p class="text-xs font-medium">{{ $product->product_name }}</p>
                                </div>
                                <div class="md:w-1/3"><label class="font-bold text-sm mr-1 block md:hidden">SKU:</label>
                                    <p class="text-xs font-medium">{{ $product->sku }}</p>
                                </div>
                                <div class="md:w-1/3">
                                    <label class="font-bold text-sm mr-1 block md:hidden">Density:</label>
                                    <p class="text-xs font-medium">
                                        {{ $product->seeding_density ? number_format($product->seeding_density) : 'N/A' }}
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Load More Button -->
                    @if ($products->count() > 5)
                        <div class="flex justify-end mt-4">
                            <a href="{{ url('/dashboard/products') }}"
                                class="bg-blue-500 text-white text-sm md:text-md px-4 py-2 rounded-lg hover:bg-blue-600">
                                Load More
                            </a>
                        </div>
                    @endif
                @endif
            </div>
        </div>

        <!-- Secondary Column: placeholder or additional content -->
        <div class="container mx-auto px-4 py-8">
            {{-- Add any additional widgets or content here --}}
        </div>
    </div>
@endsection
