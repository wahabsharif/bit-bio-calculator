@extends('layouts.app')

@section('content')
    <div class="max-w-3xl space-y-4 mx-auto my-5 bg-gray-200/50 p-4 rounded-lg shadow-md">
        <!-- Input Sections -->
        <div class="border space-y-4 border-gray-300 rounded-lg shadow-sm p-6 bg-white/50">
            <!-- Cell Type & Seeding Density -->
            <div>
                <label for="cell_type" class="block text-md font-bold text-gray-700 mb-2">Select Cell Type</label>
                <div class="relative w-full" id="custom-dropdown-wrapper">
                    <div id="dropdown-toggle"
                        class="block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm bg-white/50 cursor-pointer focus:ring-blue-500 focus:border-blue-500">
                        <span id="selected-cell-type">-- Select a Cell Type --</span>
                    </div>
                    <div id="dropdown-menu"
                        class="absolute left-0 right-0 bg-white border border-gray-300 rounded-lg shadow-lg mt-1 hidden">
                        <input id="dropdown-search" type="text" placeholder="Search cell type..."
                            class="w-full px-4 py-2 border-b border-gray-300 focus:outline-none" />
                        <div id="dropdown-options" class="max-h-60 overflow-y-auto"></div>
                    </div>
                </div>
                <p class="text-sm text-gray-500 mt-1 ml-2">When one of our products is selected, the recommended seeding
                    density will be filled automatically.</p>
            </div>
            <div>
                <label for="seeding_density" class="block text-md font-bold text-gray-700 mb-2">Enter your desired seeding
                    density (cells/cm²)</label>
                <input id="seeding_density" type="number"
                    class="block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" />
                <p class="text-sm text-gray-500 mt-1 ml-2">Please note that the seeding density provided by default has been
                    optimized by bit.bio for monocultures. Adjust the seeding density depending on your assay or
                    application.</p>
            </div>
        </div>

        <div class="border space-y-4 border-gray-300 rounded-lg shadow-sm p-6 bg-white/50">
            <!-- Number of Wells -->
            <div>
                <label for="num_wells" class="block text-md font-bold text-gray-700 mb-2">Input the number of wells you will
                    be seeding</label>
                <input id="num_wells" type="number" value="96"
                    class="block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" />
                <p class="text-sm text-gray-500 mt-1 ml-2">Based on your experimental design, provide the number of wells
                    that you will be seeding, making sure to include replicates and controls.</p>
            </div>
        </div>

        <div class="border space-y-4 border-gray-300 rounded-lg shadow-sm p-6 bg-white/50">
            <!-- Culture Vessel -->
            <div>
                <label for="culture_vessel" class="block text-md font-bold text-gray-700 mb-2">Select your culture vessel
                    format</label>
                <select id="culture_vessel"
                    class="block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm bg-white/50 cursor-pointer focus:ring-blue-500 focus:border-blue-500"></select>
                <p class="text-sm text-gray-500 mt-1 ml-2">Please note that if you are using different plate formats, please
                    calculate your seeding volumes separately.</p>
            </div>
            <div>
                <label for="surface_area" class="block text-md font-bold text-gray-700 mb-2">Surface area per well in
                    culture vessel(s) (cm²/well)</label>
                <input id="surface_area" type="number" step="0.01"
                    class="block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" />
                <p class="text-sm text-gray-500 mt-1 ml-2">This value is automatically populated based on the selected
                    culture vessel but can be adjusted if needed.</p>
            </div>
            <div>
                <label for="media_volume" class="block text-md font-bold text-gray-700 mb-2">Media volume per well in
                    culture vessel(s) (ml/well)</label>
                <input id="media_volume" type="number" step="0.01"
                    class="block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" />
                <p class="text-sm text-gray-500 mt-1 ml-2">This value is automatically populated based on the selected
                    culture vessel but can be adjusted if needed.</p>
            </div>
        </div>

        <div class="border space-y-4 border-gray-300 rounded-lg shadow-sm p-6 bg-white/50">
            <!-- Cell Counts -->
            <div>
                <label class="block text-md font-bold text-gray-700 mb-2">Input the number of cells </label>
                <div class="grid grid-cols-3 gap-4">
                    <input id="count1" type="number" value="1000000"
                        class="block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" />
                    <input id="count2" type="number" value="1000000"
                        class="block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" />
                    <input id="count3" type="number" value="1000000"
                        class="block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" />
                </div>
                <p class="text-sm text-gray-500 mt-1 ml-2">Following the user manual instructions for the specific cell
                    type, count the number of cells including a cell viability marker. The calculator will use the average
                    value.</p>
            </div>
        </div>

        <div class="border space-y-4 border-gray-300 rounded-lg shadow-sm p-6 bg-white/50">
            <!-- Viability -->
            <div>
                <label class="block text-md font-bold text-gray-700 mb-2">Input the cell viability post-thaw (%)
                </label>
                <div class="grid grid-cols-3 gap-4">
                    <input id="viability1" type="number" step="0.01" value="100"
                        class="block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" />
                    <input id="viability2" type="number" step="0.01"
                        class="block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" />
                    <input id="viability3" type="number" step="0.01"
                        class="block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" />
                </div>
                <p class="text-sm text-gray-500 mt-1 ml-2">We recommend that the cell viability is quantified. The
                    calculator will use the average value.</p>
            </div>
        </div>

        <div class="border space-y-4 border-gray-300 rounded-lg shadow-sm p-6 bg-white/50">
            <!-- Buffer -->
            <div>
                <label for="buffer" class="block text-md font-bold text-gray-700 mb-2">Extra / Buffer (%)</label>
                <input id="buffer" type="number" value="15" step="0.01"
                    class="block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" />
                <p class="text-sm text-gray-500 mt-1 ml-2">Please include a buffer value to account for dead volume,
                    perfectly normal during cell plating.</p>
            </div>
        </div>

        <div class="border space-y-4 border-gray-300 rounded-lg shadow-sm p-6 bg-white/50">
            <!-- Initial Suspension -->
            <div>
                <label for="suspension_volume" class="block text-md font-bold text-gray-700 mb-2">Input the initial
                    suspension volume (ml)</label>
                <input id="suspension_volume" type="number" value="1" step="0.01"
                    class="block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" />
                <p class="text-sm text-gray-500 mt-1 ml-2">Please follow the user manual specific for the cell type for
                    detailed instructions on suspension volume.</p>
            </div>
        </div>

        <!-- Calculate Button -->
        <div class="flex justify-center items-center py-5">
            <button id="calculateBtn"
                class="px-6 py-2 rounded-lg bg-gray-700 cursor-pointer hover:bg-gray-900 text-gray-50 uppercase tracking-widest transition-colors">Calculate
                Results</button>
        </div>

        <!-- Results Modal -->
        <div id="resultsModal" class="fixed inset-0 bg-gray-100 z-50 hidden min-h-screen">
            <div
                class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 p-5 w-full max-w-3xl shadow-lg rounded-md bg-white">
                <button id="closeModal"
                    class="absolute top-1 right-1 cursor-pointer text-gray-500 hover:text-gray-700 focus:outline-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
                <div id="warnings" class="hidden bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                </div>
                <div class="mt-3">
                    <h3 class="text-lg leading-6 font-medium text-gray-900 text-center">Calculation Results</h3>
                    <div id="results" class="mt-2 space-y-4">
                        <div class="space-y-4 rounded-lg shadow-sm p-2 bg-gray-50">
                            <div class="grid grid-cols-2 gap-2">
                                <div class="bg-gray-100 p-4 rounded-lg">
                                    <p class="font-semibold">Cell Density (cells/ml)</p>
                                    <p id="cell_density">-</p>
                                </div>
                                <div class="bg-gray-100 p-4 rounded-lg">
                                    <p class="font-semibold">Cells per Well</p>
                                    <p id="cells_per_well">-</p>
                                </div>
                                <div class="bg-gray-100 p-4 rounded-lg">
                                    <p class="font-semibold">Required Number of Cells (total)</p>
                                    <p id="required_cells_total">-</p>
                                </div>
                                <div class="bg-gray-100 p-4 rounded-lg">
                                    <p class="font-semibold">Required Volume to Plate (total)</p>
                                    <p id="volume_plate_total">-</p>
                                </div>
                                <div class="bg-gray-100 p-4 rounded-lg">
                                    <p class="font-semibold">Required Volume to Plate (per well)</p>
                                    <p id="volume_plate_perwell">-</p>
                                </div>
                                <div class="bg-gray-100 p-4 rounded-lg">
                                    <p class="font-semibold">Volume of Cell Suspension to Seed (ml)</p>
                                    <p id="volume_to_seed">-</p>
                                </div>
                                <div class="bg-gray-100 p-4 rounded-lg">
                                    <p class="font-semibold">Volume to Dilute with Media (ml)</p>
                                    <p id="volume_to_dilute">-</p>
                                </div>
                            </div>
                        </div>
                        <!-- Download & Contact -->
                        <div class="flex justify-between items-center">
                            <button id="downloadCsv"
                                class="px-6 py-2 rounded-lg cursor-pointer bg-blue-600 hover:bg-blue-800 text-white">Download
                                CSV</button>
                            <p class="text-sm text-gray-500">For questions, contact <a href="mailto:technical@bit.bio"
                                    class="underline">technical@bit.bio</a>.</p>
                        </div>
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
                const response = await fetch('/products');
                cellTypes = await response.json();
                renderOptions(cellTypes);
            } catch (err) {
                console.error('Failed to fetch cell types', err);
            }
            // Fetch culture vessels
            try {
                const resp2 = await fetch('/culture-vessels');
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
