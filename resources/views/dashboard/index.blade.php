{{-- resources/views/dashboard/index.blade.php --}}
@extends('layouts.dashboard')

@section('content')
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
        <!-- Products List -->
        <div class="container mx-auto">
            <!-- Title and Actions -->
            <div
                class="flex flex-col md:flex-row items-start md:items-center justify-between mb-2 md:mb-4 space-y-4 md:space-y-0">
                <h1 class="text-md font-bold md:text-2xl text-gray-800 capitalize">Recently Products Added</h1>
            </div>

            <!-- Table Wrapper with Horizontal Scroll on Mobile -->
            <div class="bg-white shadow rounded-lg p-4 h-[60vh] overflow-x-auto relative">
                @if ($products->isEmpty())
                    <div class="text-center text-gray-500">No products found.</div>
                @else
                    <!-- Header Row: hidden on small screens -->
                    <div class="hidden md:flex font-semibold text-sm text-gray-700 mb-2 border-b-2 border-gray-200 pb-2">
                        <div class="md:w-1/2">Name</div>
                        <div class="md:w-1/4">SKU</div>
                        <div class="md:w-1/4">Seeding Density</div>
                    </div>

                    <!-- Scrollable Data Rows -->
                    <div class="overflow-y-auto max-h-[calc(60vh-4rem)] space-y-2 md:space-y-0 divide-y divide-gray-200">
                        @foreach ($products->take(5) as $product)
                            <div class="flex flex-col md:flex-row py-2 space-y-2 md:space-y-0 md:items-center">
                                <div class="md:w-1/2"><label class="font-bold text-sm mr-1 block md:hidden">Name:</label>
                                    <p class="text-xs font-medium">{{ $product->product_name }}</p>
                                </div>
                                <div class="md:w-1/4"><label class="font-bold text-sm mr-1 block md:hidden">SKU:</label>
                                    <p class="text-xs font-medium">{{ $product->sku }}</p>
                                </div>
                                <div class="md:w-1/4">
                                    <label class="font-bold text-sm mr-1 block md:hidden">Density:</label>
                                    <p class="text-xs font-medium">
                                        {{ $product->seeding_density ? number_format($product->seeding_density) : 'N/A' }}
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Load More Button aligned bottom-right -->
                    @if ($products->count() > 5)
                        <div class="absolute bottom-4 right-4">
                            <a href="{{ url('/dashboard/products') }}"
                                class="bg-blue-500 text-white text-sm md:text-md px-4 py-2 rounded-lg hover:bg-blue-600">
                                Load More
                            </a>
                        </div>
                    @endif
                @endif
            </div>
        </div>

        <!-- Culture Vessels List -->
        <div class="container mx-auto">
            <!-- Title and Actions -->
            <div
                class="flex flex-col md:flex-row items-start md:items-center justify-between mb-2 md:mb-4 space-y-4 md:space-y-0">
                <h1 class="text-md font-bold md:text-2xl text-gray-800 capitalize">Recently Culture Vessels Added</h1>
            </div>

            <!-- Table Wrapper with Horizontal Scroll on Mobile -->
            <div class="bg-white shadow rounded-lg p-4 h-[60vh] overflow-x-auto relative">
                @if ($vessels->isEmpty())
                    <div class="text-center text-gray-500">No culture vessels found.</div>
                @else
                    <!-- Header Row: hidden on small screens -->
                    <div class="hidden md:flex font-semibold text-sm text-gray-700 mb-2 border-b-2 border-gray-200 pb-2">
                        <div class="md:w-1/2">Plate Format</div>
                        <div class="md:w-1/4">Surface Area (cm²)</div>
                        <div class="md:w-1/4">Media Volume (ml)</div>
                    </div>

                    <!-- Scrollable Data Rows -->
                    <div class="overflow-y-auto max-h-[calc(60vh-4rem)] space-y-2 md:space-y-0 divide-y divide-gray-200">
                        @foreach ($vessels->take(5) as $vessel)
                            <div class="flex flex-col md:flex-row py-2 space-y-2 md:space-y-0 md:items-center">
                                <div class="md:w-1/2"><label class="font-bold text-sm mr-1 block md:hidden">Plate
                                        Format:</label>
                                    <p class="text-xs font-medium">{{ $vessel->plate_format }}</p>
                                </div>
                                <div class="md:w-1/4"><label class="font-bold text-sm mr-1 block md:hidden">Surface
                                        Area:</label>
                                    <p class="text-xs font-medium">{{ $vessel->surface_area_cm2 }}</p>
                                </div>
                                <div class="md:w-1/4">
                                    <label class="font-bold text-sm mr-1 block md:hidden">Media Volume:</label>
                                    <p class="text-xs font-medium">{{ $vessel->media_volume_per_well_ml }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Load More Button aligned bottom-right -->
                    @if ($vessels->count() > 5)
                        <div class="absolute bottom-4 right-4">
                            <a href="{{ url('/dashboard/culture-vessels') }}"
                                class="bg-blue-500 text-white text-sm md:text-md px-4 py-2 rounded-lg hover:bg-blue-600">
                                Load More
                            </a>
                        </div>
                    @endif
                @endif
            </div>
        </div>
    </div>
@endsection
