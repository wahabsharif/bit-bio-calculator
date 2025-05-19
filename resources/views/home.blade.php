@extends('layouts.app')

@section('content')
    <div class="flex flex-col md:flex-row justify-between gap-4">
        <!-- Main Calculator Form -->
        <div class="w-full md:w-2/3 bg-zinc-200/50 p-4">
            <!-- Cell Stock Volume -->
            <div class="mb-4 flex items-start border-b-2 border-gray-50 py-2">
                <label for="suspension_volume" class="text-sm font-medium w-64 text-gray-700 flex items-center">
                    Cell stock volume
                    <span class="ml-1 text-gray-500 cursor-help" title="Initial suspension volume in ml">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </span>
                </label>
                <div class="flex items-center flex-1">
                    <input id="suspension_volume" type="number" step="0.01" value="1"
                        class="w-32 p-1 border text-right border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    <span class="ml-2 text-sm text-gray-700">ml</span>
                </div>
            </div>

            <!-- Live Cell Count -->
            <div class="mb-4 flex items-start border-b-2 border-gray-50 py-2">
                <label class="text-sm font-medium w-64 text-gray-700 flex items-center">
                    Live cell count
                    <span class="ml-1 text-gray-500 cursor-help" title="Enter your cell counts">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </span>
                </label>
                <div class="flex-1">
                    <div class="grid grid-cols-4 gap-2 items-center">
                        <div>
                            <div class="text-xs text-gray-600 mb-1">Count 1</div>
                            <input id="count1" type="number" value="1000000"
                                class="w-full px-3 py-1 border border-gray-300  focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div>
                            <div class="text-xs text-gray-600 mb-1">Count 2</div>
                            <input id="count2" type="number"
                                class="w-full px-3 py-1 border border-gray-300  focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div>
                            <div class="text-xs text-gray-600 mb-1">Count 3</div>
                            <input id="count3" type="number"
                                class="w-full px-3 py-1 border border-gray-300  focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div class="text-sm mt-4 text-gray-500">x 10<sup>6</sup> cells/ml</div>

                    </div>
                </div>
            </div>

            <!-- Cell Viability -->
            <div class="mb-4 flex items-start border-b-2 border-gray-50 py-2">
                <label class="text-sm font-medium w-64 text-gray-700 flex items-center">Cell viability</label>
                <div class="flex-1">
                    <div class="grid grid-cols-4 gap-2 items-center">
                        <div>
                            <div class="text-xs text-gray-600 mb-1">Count 1</div>
                            <input id="viability1" type="number" step="0.1" value="100"
                                class="w-full px-3 py-1 border border-gray-300  focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div>
                            <div class="text-xs text-gray-600 mb-1">Count 2</div>
                            <input id="viability2" type="number" step="0.1"
                                class="w-full px-3 py-1 border border-gray-300  focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div>
                            <div class="text-xs text-gray-600 mb-1">Count 3</div>
                            <input id="viability3" type="number" step="0.1"
                                class="w-full px-3 py-1 border border-gray-300  focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div class="text-sm text-gray-500 mt-4">%</div>

                    </div>
                </div>
            </div>

            <!-- Cell Type -->
            <div class="mb-4 flex items-start border-b-2 border-gray-50 py-2">
                <label for="cell_type" class="text-sm font-medium w-64 text-gray-700 flex items-center">Cell type</label>
                <div class="flex-1">
                    <select id="cell_type"
                        class="w-full px-3 py-1 border border-gray-300  focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        <option value="">--Select your cell type--</option>
                    </select>
                </div>
            </div>

            <!-- Seeding Density -->
            <div class="mb-4 flex items-start border-b-2 border-gray-50 py-2">
                <label for="seeding_density" class="text-sm font-medium w-64 text-gray-700 flex items-center">
                    Seeding density
                    <span class="ml-1 text-gray-500 cursor-help" title="Target cells/cm²">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </span>
                </label>
                <div class="flex items-center flex-1">
                    <input id="seeding_density" type="number"
                        class="w-32 px-3 py-1 border border-gray-300  focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    <span class="ml-2 text-sm text-gray-700">cells/cm²</span>
                </div>
            </div>

            <!-- Culture Vessel -->
            <div class="mb-4 flex items-start border-b-2 border-gray-50 py-2">
                <label for="culture_vessel" class="text-sm font-medium w-64 text-gray-700 flex items-center">
                    Culture vessel
                    <span class="ml-1 text-gray-500 cursor-help" title="Select plate format">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </span>
                </label>
                <div class="flex-1">
                    <select id="culture_vessel"
                        class="w-full px-3 py-1 border border-gray-300  focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        <!-- Options will be populated by JS -->
                    </select>
                </div>
            </div>

            <!-- Surface Area -->
            <div class="mb-4 flex items-start border-b-2 border-gray-50 py-2">
                <label for="surface_area" class="text-sm font-medium w-64 text-gray-700 flex items-center">Surface
                    area</label>
                <div class="flex items-center flex-1">
                    <input id="surface_area" type="number" step="0.01"
                        class="w-32 px-3 py-1 border border-gray-300  focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    <span class="ml-2 text-sm text-gray-700">cm²/well</span>
                </div>
            </div>

            <!-- Volume -->
            <div class="mb-4 flex items-start border-b-2 border-gray-50 py-2">
                <label for="media_volume" class="text-sm font-medium w-64 text-gray-700 flex items-center">Volume</label>
                <div class="flex items-center flex-1">
                    <input id="media_volume" type="number" step="0.01"
                        class="w-32 px-3 py-1 border border-gray-300  focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    <span class="ml-2 text-sm text-gray-700">ml/well</span>
                </div>
            </div>

            <!-- Number of Wells to Seed -->
            <div class="mb-4 flex items-start border-b-2 border-gray-50 py-2">
                <label for="num_wells" class="text-sm font-medium w-64 text-gray-700 flex items-center">Number of wells to
                    seed</label>
                <div class="flex items-center flex-1">
                    <input id="num_wells" type="number" value="96"
                        class="w-32 px-3 py-1 border border-gray-300  focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    <span class="ml-2 text-sm text-gray-700">wells</span>
                </div>
            </div>

            <!-- Seed Volume Allowance -->
            <div class="mb-6 flex items-start">
                <label for="buffer" class="text-sm font-medium w-64 text-gray-700 flex items-center">Seed volume
                    allowance</label>
                <div class="flex items-center flex-1">
                    <input id="buffer" type="number" step="0.1" value="15"
                        class="w-32 px-3 py-1 border border-gray-300  focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    <span class="ml-2 text-sm text-gray-700">%</span>
                </div>
            </div>

            <!-- Calculate Button -->
            <div class="mt-6 flex items-center justify-between">
                <p class="text-sm text-gray-500 mb-2">* Required field
                </p>
                <button id="calculateBtn" class="grad-bg w-60 text-white font-medium py-2 px-4 transition">
                    Calculate results
                </button>
            </div>
        </div>

        <!-- Help Section -->
        <div class="w-full md:w-1/3 p-4 border border-gray-200 self-start">
            <h2 class="text-lg font-medium mb-3">How to get started?</h2>
            <ul class="list-disc pl-5 space-y-3 text-sm">
                <li>Start by entering your cell stock volume.</li>
                <li>Add your cell count and viability. Ideally perform your count three times.</li>
                <li>Select your cell type and the recommended seeding density will be populated.</li>
                <li>Choose your vessel format to automatically fill in the surface area and volume.</li>
                <li>Include a 10-20% dead volume allowance or adjust based on your workflow.</li>
            </ul>
        </div>

        <!-- Results Modal -->
        <div id="resultsModal" class="fixed inset-0 bg-gray-100/90 z-50 hidden overflow-auto">
            <div
                class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-full max-w-md md:max-w-2xl p-5 bg-white  shadow-lg max-h-[95vh] overflow-auto">
                <button id="closeModal"
                    class="absolute top-4 right-4 text-gray-500 hover:text-gray-700 focus:outline-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>

                <div id="warnings" class="hidden bg-red-100 border border-red-400 text-red-700 px-4 py-3 mb-4">
                </div>

                <h3 class="text-lg font-medium text-gray-900 text-center mb-4">Calculation Results</h3>

                <div id="results" class="space-y-4">
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 bg-gray-50 p-4  shadow-sm">
                        <div class="bg-gray-100 p-4 ">
                            <p class="font-semibold">Cell Density (cells/ml)</p>
                            <p id="cell_density">-</p>
                        </div>
                        <div class="bg-gray-100 p-4 ">
                            <p class="font-semibold">Cells per Well</p>
                            <p id="cells_per_well">-</p>
                        </div>
                        <div class="bg-gray-100 p-4 ">
                            <p class="font-semibold">Required Number (total)</p>
                            <p id="required_cells_total">-</p>
                        </div>
                        <div class="bg-gray-100 p-4 ">
                            <p class="font-semibold">Volume to Plate (total)</p>
                            <p id="volume_plate_total">-</p>
                        </div>
                        <div class="bg-gray-100 p-4 ">
                            <p class="font-semibold">Volume to Plate (per well)</p>
                            <p id="volume_plate_perwell">-</p>
                        </div>
                        <div class="bg-gray-100 p-4 ">
                            <p class="font-semibold">Volume to Seed (ml)</p>
                            <p id="volume_to_seed">-</p>
                        </div>
                        <div class="bg-gray-100 p-4 ">
                            <p class="font-semibold">Volume to Dilute (ml)</p>
                            <p id="volume_to_dilute">-</p>
                        </div>
                    </div>

                    <div class="flex flex-col sm:flex-row justify-between items-center gap-4">
                        <button id="downloadCsv"
                            class="w-full sm:w-auto px-6 py-2 bg-blue-600 hover:bg-blue-800 text-white ">
                            Download CSV
                        </button>
                        <p class="text-sm text-gray-500 text-center sm:text-left">
                            For questions, contact <a href="mailto:technical@bit.bio"
                                class="underline">technical@bit.bio</a>.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <x-UsefulResources />
    <script>
        document.addEventListener('DOMContentLoaded', async () => {
            // Culture vessel setup
            const cultureVesselSelect = document.getElementById('culture_vessel');
            const surfaceAreaInput = document.getElementById('surface_area');
            const mediaVolumeInput = document.getElementById('media_volume');
            const cellTypeSelect = document.getElementById('cell_type');
            const seedingInput = document.getElementById('seeding_density');

            let cellTypes = [];
            let cultureVessels = [];

            // Fetch cell types
            try {
                const response = await fetch('{{ url('products') }}');
                cellTypes = await response.json();
                populateCellTypes(cellTypes);
            } catch (err) {
                console.error('Failed to fetch cell types', err);
            }

            // Fetch culture vessels
            try {
                const resp2 = await fetch('{{ route('culture-vessels.index') }}', {
                    headers: {
                        'Accept': 'application/json'
                    }
                });
                cultureVessels = await resp2.json();
                populateCultureVessels(cultureVessels);
            } catch (err) {
                console.error('Failed to fetch culture vessels', err);
            }

            function populateCellTypes(types) {
                cellTypeSelect.innerHTML = '<option value="">--Select your cell type--</option>';
                types.forEach(type => {
                    const opt = document.createElement('option');
                    opt.value = type.id;
                    opt.textContent = `${type.product_name} (${type.sku})`;
                    opt.dataset.seedingDensity = type.seeding_density || '';
                    cellTypeSelect.appendChild(opt);
                });
            }

            function populateCultureVessels(vessels) {
                cultureVesselSelect.innerHTML = '';
                vessels.forEach((v, i) => {
                    const opt = document.createElement('option');
                    opt.value = v.id;
                    opt.textContent = v.plate_format;
                    opt.dataset.surfaceArea = v.surface_area_cm2;
                    opt.dataset.mediaVolume = v.media_volume_per_well_ml;
                    if (i === 0) opt.selected = true;
                    cultureVesselSelect.appendChild(opt);
                });
                const first = cultureVesselSelect.options[0];
                if (first) {
                    surfaceAreaInput.value = first.dataset.surfaceArea;
                    mediaVolumeInput.value = first.dataset.mediaVolume;
                }
            }

            cellTypeSelect.addEventListener('change', function() {
                const opt = this.options[this.selectedIndex];
                if (opt && opt.dataset.seedingDensity) {
                    seedingInput.value = opt.dataset.seedingDensity;
                }
            });

            cultureVesselSelect.addEventListener('change', function() {
                const opt = this.options[this.selectedIndex];
                if (opt.dataset.surfaceArea === 'null') surfaceAreaInput.value = '';
                else surfaceAreaInput.value = opt.dataset.surfaceArea;
                if (opt.dataset.mediaVolume === 'null') mediaVolumeInput.value = '';
                else mediaVolumeInput.value = opt.dataset.mediaVolume;
            });

            // Calculation Logic
            document.getElementById('calculateBtn').addEventListener('click', () => {
                // Gather inputs
                const seeding = parseFloat(document.getElementById('seeding_density').value) || 0;
                const wells = parseInt(document.getElementById('num_wells').value) || 0;
                const area = parseFloat(document.getElementById('surface_area').value) || 0;
                const mediaVol = parseFloat(document.getElementById('media_volume').value) || 0;
                const counts = [
                    parseFloat(document.getElementById('count1').value) || 0,
                    parseFloat(document.getElementById('count2').value) || 0,
                    parseFloat(document.getElementById('count3').value) || 0
                ];
                const viabilities = [
                    parseFloat(document.getElementById('viability1').value) || 0,
                    parseFloat(document.getElementById('viability2').value) || 0,
                    parseFloat(document.getElementById('viability3').value) || 0
                ];
                const bufferPerc = parseFloat(document.getElementById('buffer').value) || 0;
                const suspensionVol = parseFloat(document.getElementById('suspension_volume').value) ||
                    1;

                // Compute averages
                const avgCount = counts.reduce((a, b) => a + b, 0) / counts.filter(n => n > 0).length;
                const avgViab = viabilities.reduce((a, b) => a + b, 0) / viabilities.filter(n => n > 0)
                    .length;

                // Cell density
                const cellDensity = avgCount * (avgViab / 100) / suspensionVol;

                // Cells per well & total required
                const cellsPerWell = seeding * area;
                let requiredCells = cellsPerWell * wells;
                requiredCells *= (1 + bufferPerc / 100);

                // Volume to seed & plate calculations
                const volToSeed = requiredCells / cellDensity;
                const totalMedia = mediaVol * wells;
                const volPlateTotal = totalMedia * (1 + bufferPerc / 100);
                const volPlatePerWell = mediaVol;
                const volDilute = volPlateTotal - volToSeed;

                // Build warnings
                const warningsArr = [];
                if (requiredCells > avgCount) {
                    warningsArr.push('⚠️ You do not have enough cells for your experimental design.');
                }
                if (bufferPerc === 0) {
                    warningsArr.push(
                        '⚠️ It is highly recommended to include a buffer to ensure enough cells and media.'
                    );
                }
                const warningsDiv = document.getElementById('warnings');
                if (warningsArr.length) {
                    warningsDiv.innerHTML = warningsArr.map(msg => `<p>${msg}</p>`).join('');
                    warningsDiv.classList.remove('hidden');
                } else {
                    warningsDiv.classList.add('hidden');
                }

                // Display results
                document.getElementById('cell_density').textContent = cellDensity.toExponential(2);
                document.getElementById('cells_per_well').textContent = cellsPerWell.toLocaleString(
                    undefined, {
                        maximumFractionDigits: 2
                    });
                document.getElementById('required_cells_total').textContent = requiredCells
                    .toExponential(2);
                document.getElementById('volume_plate_total').textContent = volPlateTotal.toFixed(2) +
                    ' ml';
                document.getElementById('volume_plate_perwell').textContent = volPlatePerWell.toFixed(
                    2) + ' ml';
                document.getElementById('volume_to_seed').textContent = volToSeed.toFixed(2) + ' ml';
                document.getElementById('volume_to_dilute').textContent = volDilute.toFixed(2) + ' ml';

                document.getElementById('resultsModal').classList.remove('hidden');
            });

            // Close modal events
            document.getElementById('closeModal').addEventListener('click', () => {
                document.getElementById('resultsModal').classList.add('hidden');
            });

            document.getElementById('resultsModal').addEventListener('click', (e) => {
                if (e.target === document.getElementById('resultsModal')) {
                    document.getElementById('resultsModal').classList.add('hidden');
                }
            });

            // CSV Download
            document.getElementById('downloadCsv').addEventListener('click', () => {
                const headers = ['Metric', 'Value'];
                const rows = [
                    ['Cell Density (cells/ml)', document.getElementById('cell_density')
                        .textContent
                    ],
                    ['Cells per Well', document.getElementById('cells_per_well').textContent],
                    ['Required Cells (total)', document.getElementById('required_cells_total')
                        .textContent
                    ],
                    ['Volume to Plate (total)', document.getElementById('volume_plate_total')
                        .textContent
                    ],
                    ['Volume to Plate (per well)', document.getElementById('volume_plate_perwell')
                        .textContent
                    ],
                    ['Volume to Seed (ml)', document.getElementById('volume_to_seed').textContent],
                    ['Volume to Dilute (ml)', document.getElementById('volume_to_dilute')
                        .textContent
                    ]
                ];
                let csvContent = headers.join(',') + '\n' + rows.map(r => r.join(',')).join('\n');
                const blob = new Blob([csvContent], {
                    type: 'text/csv;charset=utf-8;'
                });
                const link = document.createElement('a');
                link.href = URL.createObjectURL(blob);
                link.download = 'seeding_calculator_results.csv';
                link.style.display = 'none';
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);
            });
        });
    </script>
@endsection
