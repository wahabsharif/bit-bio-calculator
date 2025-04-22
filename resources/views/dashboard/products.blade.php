{{-- resources/views/dashboard/products.blade.php --}}
@extends('layouts.dashboard')

@section('content')
    <div class="container mx-auto px-4 py-8" x-data="{
        showAddModal: false,
        search: '',
        hasSearchResults() {
            if (this.search.trim() === '') return true;
    
            const searchLower = this.search.toLowerCase();
            return Array.from(document.querySelectorAll('tbody tr')).some(row => {
                if (!row.hasAttribute('x-show')) return false;
    
                const productName = row.querySelector('td:nth-child(1)')?.textContent.toLowerCase();
                const sku = row.querySelector('td:nth-child(2)')?.textContent.toLowerCase();
    
                return productName?.includes(searchLower) || sku?.includes(searchLower);
            });
        }
    }">
        <!-- Sweet Alert Success Message -->
        @if (session('success'))
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const Toast = Swal.mixin({
                        toast: true,
                        position: "top-end",
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.onmouseenter = Swal.stopTimer;
                            toast.onmouseleave = Swal.resumeTimer;
                        }
                    });

                    Toast.fire({
                        icon: "success",
                        title: "{{ session('success') }}"
                    });
                });
            </script>
        @endif

        <!-- Header & Controls -->
        <div class="flex flex-col md:flex-row items-start md:items-center justify-between mb-6 space-y-4 md:space-y-0">
            <h1 class="text-2xl font-semibold text-gray-800">Products</h1>
            <div class="flex items-center space-x-4">
                <!-- Search Bar -->
                <input type="text" x-model="search" placeholder="Search products..."
                    class="w-full md:w-64 border border-gray-300 rounded-md px-2 py-1 focus:ring-blue-500 focus:border-blue-500 cursor-pointer" />
                <!-- Add New Product Button -->
                <button @click="showAddModal = true"
                    class="bg-blue-500 hover:bg-blue-600 text-white font-medium py-1 px-4 rounded-lg transition cursor-pointer">
                    Add New Product
                </button>
            </div>
        </div>

        <!-- Add Modal -->
        <template x-if="showAddModal">
            <div class="fixed inset-0 bg-black/50 backdrop-blur-lg z-50 flex items-center justify-center">
                <div class="bg-white rounded-lg shadow-lg w-full max-w-md">
                    <div class="px-6 py-4 border-b flex justify-between items-center">
                        <h2 class="text-lg font-semibold">Add New Product</h2>
                        <button @click="showAddModal = false"
                            class="text-gray-600 hover:text-gray-800 text-xl cursor-pointer">&times;</button>
                    </div>
                    <form action="{{ route('products.store') }}" method="POST" class="px-6 py-4">
                        @csrf
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 text-start">Name</label>
                            <input type="text" name="product_name" required
                                class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:ring-blue-500 focus:border-blue-500 cursor-pointer" />
                        </div>
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 text-start">SKU</label>
                            <input type="text" name="sku" required
                                class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:ring-blue-500 focus:border-blue-500 cursor-pointer" />
                        </div>
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 text-start">Seeding Density</label>
                            <input type="number" name="seeding_density" min="0" step="any" required
                                class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:ring-blue-500 focus:border-blue-500 cursor-pointer" />
                        </div>
                        <div class="flex justify-end space-x-2">
                            <button type="button" @click="showAddModal = false"
                                class="px-4 py-2 rounded bg-gray-200 hover:bg-gray-300 cursor-pointer">Cancel</button>
                            <button type="submit"
                                class="px-4 py-2 rounded bg-blue-500 text-white hover:bg-blue-600 cursor-pointer">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </template>

        <!-- Products Table -->
        <div class="overflow-x-auto overflow-y-auto bg-white shadow rounded-lg max-h-96">
            <table class="min-w-full divide-y divide-gray-200 table-auto">
                <thead class="bg-gray-50 sticky top-0 z-10 shadow-lg">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">SKU</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Seeding
                            Density</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <template x-if="search.trim() !== '' && !hasSearchResults()">
                        <tr>
                            <td colspan="4" class="px-6 py-4 whitespace-nowrap text-center text-gray-500">
                                No product found with "<span x-text="search"></span>"
                            </td>
                        </tr>
                    </template>

                    @forelse($products as $product)
                        <tr x-data="{ showEditModal: false }"
                            x-show="search.trim() === '' ||
                                '{{ strtolower($product->product_name) }}'.includes(search.toLowerCase()) ||
                                '{{ strtolower($product->sku) }}'.includes(search.toLowerCase())">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $product->product_name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $product->sku }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                {{ $product->seeding_density ? number_format($product->seeding_density) : '' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-right">
                                <button @click="showEditModal = true"
                                    class="text-indigo-600 hover:text-indigo-900 mr-4 cursor-pointer">Edit</button>

                                <form action="{{ route('products.destroy', $product) }}" method="POST"
                                    class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" onclick="confirmDelete(this)"
                                        class="text-red-600 hover:text-red-900 cursor-pointer">Delete</button>
                                </form>

                                <!-- Edit Modal -->
                                <template x-if="showEditModal">
                                    <div
                                        class="fixed inset-0 bg-black/50 backdrop-blur-lg z-50 flex items-center justify-center">
                                        <div class="bg-white rounded-lg shadow-lg w-full max-w-md">
                                            <div class="px-6 py-4 border-b flex justify-between items-center">
                                                <h2 class="text-lg font-semibold">Edit Product</h2>
                                                <button @click="showEditModal = false"
                                                    class="text-gray-600 hover:text-gray-800 text-xl cursor-pointer">&times;</button>
                                            </div>
                                            <form action="{{ route('products.update', $product) }}" method="POST"
                                                class="px-6 py-4">
                                                @csrf
                                                @method('PUT')
                                                <div class="mb-4">
                                                    <label
                                                        class="block text-sm font-medium text-gray-700 text-start">Name</label>
                                                    <input type="text" name="product_name"
                                                        value="{{ $product->product_name }}" required
                                                        class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:ring-blue-500 focus:border-blue-500 cursor-pointer" />
                                                </div>
                                                <div class="mb-4">
                                                    <label
                                                        class="block text-sm font-medium text-gray-700 text-start">SKU</label>
                                                    <input type="text" name="sku" value="{{ $product->sku }}"
                                                        class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:ring-blue-500 focus:border-blue-500 cursor-pointer" />
                                                </div>
                                                <div class="mb-4">
                                                    <label
                                                        class="block text-sm font-medium text-gray-700 text-start">Seeding
                                                        Density</label>
                                                    <input type="number" name="seeding_density"
                                                        value="{{ $product->seeding_density }}" min="0"
                                                        step="any"
                                                        class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:ring-blue-500 focus:border-blue-500 cursor-pointer" />
                                                </div>
                                                <div class="flex justify-end space-x-2">
                                                    <button type="button" @click="showEditModal = false"
                                                        class="px-4 py-2 rounded bg-gray-200 hover:bg-gray-300 cursor-pointer">Cancel</button>
                                                    <button type="submit"
                                                        class="px-4 py-2 rounded bg-blue-500 text-white hover:bg-blue-600 cursor-pointer">Update</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </template>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-4 whitespace-nowrap text-center text-gray-500">No products
                                found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <script>
        function confirmDelete(button) {
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    button.closest('form').submit();
                }
            });
        }
    </script>
@endsection
