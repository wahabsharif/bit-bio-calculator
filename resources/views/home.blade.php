@extends('layouts.app')

@section('content')
    <div class="max-w-3xl mx-auto my-5 bg-gray-200/50 p-4 rounded-lg shadow-md space-y-6">
        <!-- Cell Type & Seeding Density -->
        <div class="bg-white/50 border border-gray-300 rounded-lg shadow-sm p-6 space-y-4">
            <div>
                <label for="cell_type" class="block text-sm md:text-md font-bold text-gray-700 mb-2">
                    Select Cell Type
                </label>
                <div class="relative" id="custom-dropdown-wrapper">
                    <div id="dropdown-toggle"
                        class="w-full px-4 py-2 border  text-xs md:text-sm border-gray-300 rounded-lg bg-white/50 cursor-pointer focus:ring-blue-500 focus:border-blue-500">
                        <span id="selected-cell-type">-- Select a Cell Type --</span>
                    </div>
                    <div id="dropdown-menu"
                        class="absolute inset-x-0 mt-1  text-xs md:text-sm bg-white border border-gray-300 rounded-lg shadow-lg hidden">
                        <input id="dropdown-search" type="text" placeholder="Search cell type..."
                            class="w-full px-4 py-2  text-xs md:text-sm border-b border-gray-300 focus:outline-none" />
                        <div id="dropdown-options" class="max-h-60 overflow-y-auto"></div>
                    </div>
                </div>
                <p class="text-xs md:text-sm text-gray-500 mt-1">
                    When one of our products is selected, the recommended seeding density will be filled automatically.
                </p>
            </div>
            <div>
                <label for="seeding_density" class="block text-sm md:text-md font-bold text-gray-700 mb-2">
                    Enter your desired seeding density (cells/cm²)
                </label>
                <input id="seeding_density" type="number"
                    class="w-full px-4 py-2  text-xs md:text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-blue-500 focus:border-blue-500" />
                <p class="text-xs md:text-sm text-gray-500 mt-1">
                    Default densities are optimized by bit.bio for monocultures. Adjust based on your assay.
                </p>
            </div>
        </div>

        <!-- Number of Wells -->
        <div class="bg-white/50 border border-gray-300 rounded-lg shadow-sm p-6">
            <label for="num_wells" class="block text-sm md:text-md font-bold text-gray-700 mb-2">
                Number of wells you will be seeding
            </label>
            <input id="num_wells" type="number" value="96"
                class="w-full px-4 py-2  text-xs md:text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-blue-500 focus:border-blue-500" />
            <p class="text-xs md:text-sm text-gray-500 mt-1">
                Include replicates and controls in your well count.
            </p>
        </div>

        <!-- Culture Vessel -->
        <div class="bg-white/50 border border-gray-300 rounded-lg shadow-sm p-6 space-y-4">
            <div>
                <label for="culture_vessel" class="block text-sm md:text-md font-bold text-gray-700 mb-2">
                    Select your culture vessel format
                </label>
                <select id="culture_vessel"
                    class="w-full px-4 py-2  text-xs md:text-sm border border-gray-300 rounded-lg bg-white/50 cursor-pointer focus:ring-blue-500 focus:border-blue-500">
                </select>
                <p class="text-xs md:text-sm text-gray-500 mt-1">
                    If using multiple plate formats, calculate seeding volumes separately.
                </p>
            </div>
            <div class="grid grid-cols-1 gap-6">
                <div>
                    <label for="surface_area" class="block text-sm md:text-md font-bold text-gray-700 mb-2">
                        Surface area per well (cm²)
                    </label>
                    <input id="surface_area" type="number" step="0.01"
                        class="w-full px-4 py-2  text-xs md:text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-blue-500 focus:border-blue-500" />
                </div>
                <div>
                    <label for="media_volume" class="block text-sm md:text-md font-bold text-gray-700 mb-2">
                        Media volume per well (ml)
                    </label>
                    <input id="media_volume" type="number" step="0.01"
                        class="w-full px-4 py-2 border  text-xs md:text-sm  border-gray-300 rounded-lg focus:outline-none focus:ring-blue-500 focus:border-blue-500" />
                </div>
            </div>
        </div>

        <!-- Cell Counts -->
        <div class="bg-white/50 border border-gray-300 rounded-lg shadow-sm p-6">
            <label class="block text-sm md:text-md font-bold text-gray-700 mb-2">
                Enter the number of cells
            </label>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                <input id="count1" type="number" value="1000000"
                    class="w-full px-4 py-2 border  text-xs md:text-sm border-gray-300 rounded-lg focus:outline-none focus:ring-blue-500 focus:border-blue-500" />
                <input id="count2" type="number" value="1000000"
                    class="w-full px-4 py-2 border  text-xs md:text-sm border-gray-300 rounded-lg focus:outline-none focus:ring-blue-500 focus:border-blue-500" />
                <input id="count3" type="number" value="1000000"
                    class="w-full px-4 py-2 border  text-xs md:text-sm border-gray-300 rounded-lg focus:outline-none focus:ring-blue-500 focus:border-blue-500" />
            </div>
            <p class="text-xs md:text-sm text-gray-500 mt-1">
                The calculator will use the average of your counts.
            </p>
        </div>

        <!-- Viability -->
        <div class="bg-white/50 border border-gray-300 rounded-lg shadow-sm p-6">
            <label class="block text-sm md:text-md font-bold text-gray-700 mb-2">
                Input cell viability post-thaw (%)
            </label>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                <input id="viability1" type="number" step="0.01" value="100"
                    class="w-full px-4 py-2 border  text-xs md:text-sm border-gray-300 rounded-lg focus:outline-none focus:ring-blue-500 focus:border-blue-500" />
                <input id="viability2" type="number" step="0.01"
                    class="w-full px-4 py-2 border  text-xs md:text-sm border-gray-300 rounded-lg focus:outline-none focus:ring-blue-500 focus:border-blue-500" />
                <input id="viability3" type="number" step="0.01"
                    class="w-full px-4 py-2 border  text-xs md:text-sm border-gray-300 rounded-lg focus:outline-none focus:ring-blue-500 focus:border-blue-500" />
            </div>
            <p class="text-xs md:text-sm text-gray-500 mt-1">
                The calculator will use the average viability.
            </p>
        </div>

        <!-- Buffer -->
        <div class="bg-white/50 border border-gray-300 rounded-lg shadow-sm p-6">
            <label for="buffer" class="block text-sm md:text-md font-bold text-gray-700 mb-2">
                Extra / Buffer (%)
            </label>
            <input id="buffer" type="number" step="0.01" value="15"
                class="w-full px-4 py-2 border  text-xs md:text-sm border-gray-300 rounded-lg focus:outline-none focus:ring-blue-500 focus:border-blue-500" />
            <p class="text-xs md:text-sm text-gray-500 mt-1">
                Include a buffer to account for dead volume in plating.
            </p>
        </div>

        <!-- Initial Suspension -->
        <div class="bg-white/50 border border-gray-300 rounded-lg shadow-sm p-6">
            <label for="suspension_volume" class="block text-sm md:text-md font-bold text-gray-700 mb-2">
                Initial suspension volume (ml)
            </label>
            <input id="suspension_volume" type="number" step="0.01" value="1"
                class="w-full px-4 py-2 border  text-xs md:text-sm border-gray-300 rounded-lg focus:outline-none focus:ring-blue-500 focus:border-blue-500" />
            <p class="text-xs md:text-sm text-gray-500 mt-1">
                Follow the cell type manual for suspension volume.
            </p>
        </div>

        <!-- Calculate Button -->
        <div class="flex justify-center">
            <button id="calculateBtn"
                class="w-full md:w-auto px-6 py-2 text-sm cursor-pointer md:text-lg bg-gray-700 hover:bg-gray-900 text-white rounded-lg uppercase tracking-wide transition">
                Calculate Results
            </button>
        </div>

        <!-- Results Modal -->
        <div id="resultsModal" class="fixed inset-0 bg-gray-100 z-50 hidden overflow-auto">
            <div
                class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2
                  w-full max-w-md md:max-w-2xl  p-5 bg-white rounded-lg shadow-lg max-h-[95vh] overflow-auto">
                <button id="closeModal"
                    class="absolute top-4 right-4 cursor-pointer text-gray-500 hover:text-gray-700 focus:outline-none">
                    <!-- X icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>

                <div id="warnings" class="hidden bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                </div>

                <h3 class="text-lg font-medium text-gray-900 text-center mb-4">
                    Calculation Results
                </h3>

                <div id="results" class="space-y-4">
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 bg-gray-50 p-4 rounded-lg shadow-sm">
                        <!-- result cards here… -->
                        <div class="bg-gray-100 p-4 rounded-lg">
                            <p class="font-semibold">Cell Density (cells/ml)</p>
                            <p id="cell_density">-</p>
                        </div>
                        <div class="bg-gray-100 p-4 rounded-lg">
                            <p class="font-semibold">Cells per Well</p>
                            <p id="cells_per_well">-</p>
                        </div>
                        <div class="bg-gray-100 p-4 rounded-lg">
                            <p class="font-semibold">Required Number (total)</p>
                            <p id="required_cells_total">-</p>
                        </div>
                        <div class="bg-gray-100 p-4 rounded-lg">
                            <p class="font-semibold">Volume to Plate (total)</p>
                            <p id="volume_plate_total">-</p>
                        </div>
                        <div class="bg-gray-100 p-4 rounded-lg">
                            <p class="font-semibold">Volume to Plate (per well)</p>
                            <p id="volume_plate_perwell">-</p>
                        </div>
                        <div class="bg-gray-100 p-4 rounded-lg">
                            <p class="font-semibold">Volume to Seed (ml)</p>
                            <p id="volume_to_seed">-</p>
                        </div>
                        <div class="bg-gray-100 p-4 rounded-lg">
                            <p class="font-semibold">Volume to Dilute (ml)</p>
                            <p id="volume_to_dilute">-</p>
                        </div>
                    </div>

                    <div class="flex flex-col sm:flex-row justify-between items-center gap-4">
                        <button id="downloadCsv"
                            class="w-full sm:w-auto px-6 py-2 cursor-pointer bg-blue-600 hover:bg-blue-800 text-white rounded-lg">
                            Download CSV
                        </button>
                        <p class="text-sm text-gray-500 text-center sm:text-left">
                            For questions, contact
                            <a href="mailto:technical@bit.bio" class="underline">technical@bit.bio</a>.
                        </p>
                    </div>
                </div>
            </div>
        </div>

    </div>


    <script>
        document.addEventListener('DOMContentLoaded', async () => {
            // Existing dropdown & culture vessel setup
            const toggle = document.getElementById('dropdown-toggle');
            const menu = document.getElementById('dropdown-menu');
            const search = document.getElementById('dropdown-search');
            const optionsContainer = document.getElementById('dropdown-options');
            const selectedText = document.getElementById('selected-cell-type');
            const seedingInput = document.getElementById('seeding_density');
            const cultureVesselSelect = document.getElementById('culture_vessel');
            const surfaceAreaInput = document.getElementById('surface_area');
            const mediaVolumeInput = document.getElementById('media_volume');

            let cellTypes = [];
            let cultureVessels = [];

            // Fetch cell types
            try {
                const response = await fetch('{{ url('products') }}');
                cellTypes = await response.json();
                renderOptions(cellTypes);
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
                surfaceAreaInput.value = first.dataset.surfaceArea;
                mediaVolumeInput.value = first.dataset.mediaVolume;
            }

            cultureVesselSelect.addEventListener('change', function() {
                const opt = this.options[this.selectedIndex];
                if (opt.dataset.surfaceArea === 'null') surfaceAreaInput.value = '';
                else surfaceAreaInput.value = opt.dataset.surfaceArea;
                if (opt.dataset.mediaVolume === 'null') mediaVolumeInput.value = '';
                else mediaVolumeInput.value = opt.dataset.mediaVolume;
            });

            toggle.addEventListener('click', () => {
                menu.classList.toggle('hidden');
                search.focus();
            });
            document.addEventListener('click', e => {
                if (!document.getElementById('custom-dropdown-wrapper').contains(e.target)) menu
                    .classList.add('hidden');
            });
            search.addEventListener('input', () => {
                const val = search.value.toLowerCase();
                renderOptions(cellTypes.filter(ct => ct.product_name.toLowerCase().includes(val)));
            });

            function renderOptions(list) {
                optionsContainer.innerHTML = '';
                if (!list.length) {
                    optionsContainer.innerHTML =
                        `<div class="px-4 py-2 text-gray-500">No results found for "${search.value}"</div>`;
                    return;
                }
                list.forEach(ct => {
                    const d = document.createElement('div');
                    d.textContent = `${ct.product_name} (${ct.sku})`;
                    d.className = 'px-4 py-2 hover:bg-blue-100 cursor-pointer';
                    d.addEventListener('click', () => {
                        selectedText.textContent = `${ct.product_name} (${ct.sku})`;
                        menu.classList.add('hidden');
                        seedingInput.value = ct.seeding_density || '';
                    });
                    optionsContainer.appendChild(d);
                });
            }

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
