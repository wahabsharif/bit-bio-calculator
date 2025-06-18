{{-- resources/views/dashboard/culture-vessels.blade.php --}}
@extends('layouts.dashboard')

@section('content')
    <div class="mx-auto" x-data="{
        showAddModal: false,
        showEditModal: false,
        showImportModal: false,
        editVesselId: null,
        editVesselData: {
            plate_format: '',
            surface_area_cm2: '',
            media_volume_per_well_ml: ''
        },
        search: '',
        hasSearchResults() {
            if (this.search.trim() === '') return true;

            const searchLower = this.search.toLowerCase();
            return Array.from(document.querySelectorAll('tbody tr')).some(row => {
                if (!row.hasAttribute('x-show')) return false;

                const plateFormat = row.querySelector('td:nth-child(1)')?.textContent.toLowerCase();
                const surfaceArea = row.querySelector('td:nth-child(2)')?.textContent.toLowerCase();

                return plateFormat?.includes(searchLower) || surfaceArea?.includes(searchLower);
            });
        },
        openEditModal(id, plateFormat, surfaceArea, mediaVolume) {
            this.editVesselId = id;
            this.editVesselData = {
                plate_format: plateFormat,
                surface_area_cm2: surfaceArea,
                media_volume_per_well_ml: mediaVolume
            };
            this.showEditModal = true;
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

        <!-- Sweet Alert Error Message -->
        @if (session('error'))
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        icon: "error",
                        title: "Error",
                        text: "{{ session('error') }}",
                        confirmButtonColor: "#3085d6"
                    });
                });
            </script>
        @endif

        <!-- Header & Controls -->
        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between mb-6 space-y-4 sm:space-y-0">
            <h1 class="text-xl sm:text-2xl font-semibold text-gray-800">Culture Vessels Management</h1>
            <div class="flex flex-col sm:flex-row w-full sm:w-auto items-center space-y-3 sm:space-y-0 sm:space-x-4">
                <!-- Search Bar -->
                <input type="text" x-model="search" placeholder="Search vessels..."
                    class="w-full sm:w-64 border text-xs md:text-sm border-gray-300 rounded-md px-3 py-2 focus:ring-blue-500 focus:border-blue-500 " />
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-3">
                    <!-- Import Excel Button -->
                    <button @click="showImportModal = true"
                        class="bg-blue-500 text-xs md:text-sm hover:bg-blue-600 text-white font-medium py-2 px-4 rounded-lg transition">
                        Import Excel
                    </button>

                    <!-- Export Excel Button -->
                    <a href="{{ route('dashboard.culture-vessels.export') }}"
                        class="bg-blue-500 text-xs md:text-sm hover:bg-blue-600 text-white font-medium py-2 px-4 rounded-lg transition text-center">
                        Export Excel
                    </a>

                    <button @click="showAddModal = true"
                        class="w-full sm:w-auto bg-blue-500 text-xs md:text-sm hover:bg-blue-600 text-white font-medium py-2 px-4 rounded-lg transition  mt-2 sm:mt-0">
                        Add New Vessel
                    </button>
                </div>
            </div>
        </div>
        <!-- Import Modal -->
        <template x-if="showImportModal">
            <div class="fixed inset-0 bg-black/50 backdrop-blur-lg z-50 flex items-center justify-center p-4">
                <div class="bg-white rounded-lg shadow-lg w-full max-w-md max-h-[90vh] overflow-y-auto">
                    <div class="px-4 sm:px-6 py-4 border-b flex justify-between items-center">
                        <h2 class="text-lg font-semibold">Import Vessel Data</h2>
                        <button @click="showImportModal = false"
                            class="text-gray-600 hover:text-gray-800 text-xl ">&times;</button>
                    </div>
                    <form action="{{ route('dashboard.culture-vessels.import') }}" method="POST"
                        enctype="multipart/form-data" class="px-4 sm:px-6 py-4">
                        @csrf
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 text-start">Excel File</label>
                            <input type="file" name="import_file" accept=".xlsx,.xls,.csv" required
                                class="mt-1 block w-full !cursor-pointer border border-gray-300 rounded-md p-2 focus:ring-blue-500 focus:border-blue-500" />
                        </div>
                        <div class="flex flex-col sm:flex-row sm:justify-end space-y-2 sm:space-y-0 sm:space-x-2">
                            <button type="button" @click="showImportModal = false"
                                class="w-full sm:w-auto px-4 py-2 rounded bg-gray-200 hover:bg-gray-300 ">Cancel</button>
                            <button type="submit"
                                class="w-full sm:w-auto px-4 py-2 rounded bg-green-500 text-white hover:bg-green-600 ">Import</button>
                        </div>
                    </form>
                </div>
            </div>
        </template>
        <!-- Add Modal -->
        <template x-if="showAddModal">
            <div class="fixed inset-0 bg-black/50 backdrop-blur-lg z-50 flex items-center justify-center p-4">
                <div class="bg-white rounded-lg shadow-lg w-full max-w-md max-h-[90vh] overflow-y-auto">
                    <div class="px-4 sm:px-6 py-4 border-b flex justify-between items-center">
                        <h2 class="text-lg font-semibold">Add Culture Vessel</h2>
                        <button @click="showAddModal = false"
                            class="text-gray-600 hover:text-gray-800 text-xl ">&times;</button>
                    </div>
                    <form action="{{ route('culture-vessels.store') }}" method="POST" class="px-4 sm:px-6 py-4">
                        @csrf
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 text-start">Plate Format</label>
                            <input type="text" name="plate_format" required
                                class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:ring-blue-500 focus:border-blue-500 " />
                        </div>
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 text-start">Surface Area (cm²)</label>
                            <input type="number" step="0.01" name="surface_area_cm2" required
                                class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:ring-blue-500 focus:border-blue-500 " />
                        </div>
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 text-start">Media Volume per Well
                                (ml)</label>
                            <input type="number" step="0.01" name="media_volume_per_well_ml" required
                                class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:ring-blue-500 focus:border-blue-500 " />
                        </div>
                        <div class="flex flex-col sm:flex-row sm:justify-end space-y-2 sm:space-y-0 sm:space-x-2">
                            <button type="button" @click="showAddModal = false"
                                class="w-full sm:w-auto px-4 py-2 rounded bg-gray-200 hover:bg-gray-300 ">Cancel</button>
                            <button type="submit"
                                class="w-full sm:w-auto px-4 py-2 rounded bg-blue-500 text-white hover:bg-blue-600 ">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </template>

        <!-- Edit Modal -->
        <template x-if="showEditModal">
            <div class="fixed inset-0 bg-black/50 backdrop-blur-lg z-50 flex items-center justify-center p-4">
                <div class="bg-white rounded-lg shadow-lg w-full max-w-md max-h-[90vh] overflow-y-auto">
                    <div class="px-4 sm:px-6 py-4 border-b flex justify-between items-center">
                        <h2 class="text-lg font-semibold">Edit Culture Vessel</h2>
                        <button @click="showEditModal = false"
                            class="text-gray-600 hover:text-gray-800 text-xl ">&times;</button>
                    </div>
                    <!-- filepath: culture-vessels.blade.php -->
                    <form :action="`{{ url('/culture-vessels') }}/${editVesselId}`" method="POST"
                        class="px-4 sm:px-6 py-4">
                        @csrf
                        @method('PUT')
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 text-start">Plate Format</label>
                            <input type="text" name="plate_format" x-model="editVesselData.plate_format" required
                                class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:ring-blue-500 focus:border-blue-500 " />
                        </div>
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 text-start">Surface Area (cm²)</label>
                            <input type="number" step="0.01" name="surface_area_cm2"
                                x-model="editVesselData.surface_area_cm2" required
                                class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:ring-blue-500 focus:border-blue-500 " />
                        </div>
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 text-start">Media Volume per Well
                                (ml)</label>
                            <input type="number" step="0.01" name="media_volume_per_well_ml"
                                x-model="editVesselData.media_volume_per_well_ml" required
                                class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:ring-blue-500 focus:border-blue-500 " />
                        </div>
                        <div class="flex flex-col sm:flex-row sm:justify-end space-y-2 sm:space-y-0 sm:space-x-2">
                            <button type="button" @click="showEditModal = false"
                                class="w-full sm:w-auto px-4 py-2 rounded bg-gray-200 hover:bg-gray-300 ">Cancel</button>
                            <button type="submit"
                                class="w-full sm:w-auto px-4 py-2 rounded bg-blue-500 text-white hover:bg-blue-600 ">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </template>

        <!-- Vessels Table with horizontal scroll on small screens -->
        <div class="bg-white shadow rounded-lg">
            <div
                class="sm:hidden text-center text-xs text-gray-500 py-2 bg-gray-50 rounded-t-lg border-b-2 border-gray-400">
                <span>← Swipe →</span>
            </div>
            <div class="overflow-x-auto w-full" style="max-height: 80vh; overflow-y: auto;">
                <table class="min-w-full divide-y divide-gray-200 table-auto">
                    <thead class="bg-gray-50 sticky top-0 z-10">
                        <tr>
                            <th
                                class="px-3 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider whitespace-nowrap bg-gray-50">
                                Plate Format</th>
                            <th
                                class="px-3 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider whitespace-nowrap bg-gray-50">
                                Surface Area (cm²)</th>
                            <th
                                class="px-3 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider whitespace-nowrap bg-gray-50">
                                Media Volume (ml)</th>
                            <th
                                class="px-3 sm:px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider whitespace-nowrap bg-gray-50">
                                Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <template x-if="search.trim() !== '' && !hasSearchResults()">
                            <tr>
                                <td colspan="4" class="px-3 sm:px-6 py-4 whitespace-nowrap text-center text-gray-500">
                                    No vessel found with "<span x-text="search"></span>"
                                </td>
                            </tr>
                        </template>

                        @forelse ($vessels as $vessel)
                            <tr
                                x-show="search.trim() === '' ||
                                '{{ strtolower($vessel->plate_format) }}'.includes(search.toLowerCase()) ||
                                '{{ strtolower((string) $vessel->surface_area_cm2) }}'.includes(search.toLowerCase())">
                                <td class="px-3 sm:px-6 py-4 whitespace-nowrap text-xs sm:text-sm text-gray-700">
                                    {{ $vessel->plate_format }}</td>
                                <td class="px-3 sm:px-6 py-4 whitespace-nowrap text-xs sm:text-sm text-gray-700">
                                    {{ $vessel->surface_area_cm2 }}</td>
                                <td class="px-3 sm:px-6 py-4 whitespace-nowrap text-xs sm:text-sm text-gray-700">
                                    {{ $vessel->media_volume_per_well_ml }}</td>
                                <td class="px-3 sm:px-6 py-4 whitespace-nowrap text-xs sm:text-sm font-medium text-right">
                                    <div class="flex items-center justify-end space-x-4">
                                        <button
                                            @click="openEditModal({{ $vessel->id }}, '{{ $vessel->plate_format }}', {{ $vessel->surface_area_cm2 }}, {{ $vessel->media_volume_per_well_ml }})"
                                            class="text-indigo-600 hover:text-indigo-900  whitespace-nowrap">Edit</button>
                                        <form action="{{ route('culture-vessels.destroy', $vessel->id) }}" method="POST"
                                            class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" onclick="confirmDelete(this)"
                                                class="text-red-600 hover:text-red-900  whitespace-nowrap">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-3 sm:px-6 py-4 whitespace-nowrap text-center text-gray-500">
                                    No culture vessels found
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
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
