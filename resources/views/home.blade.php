{{-- home.blade.php --}}
@extends('layouts.app')

@section('content')
    {{-- Home Page --}}
    <div class="flex flex-col md:flex-row justify-between gap-4">
        <!-- Main Calculator Form -->
        <div class="w-full lg:w-2/3 bg-zinc-200/50 p-3 sm:p-4 mx-auto">
            <!-- Cell Stock Volume - Improve responsive layout -->
            <div class="mb-4 flex flex-col sm:flex-row items-start border-b-2 border-gray-50 py-2">
                <label for="suspension_volume"
                    class="text-sm font-medium w-full sm:w-64 text-gray-700 flex items-center mb-2 sm:mb-0">
                    Cell stock volume <span class="text-red-500">*</span>
                    <span class="ml-1 tooltip-container text-gray-500 cursor-help">
                        <svg xmlns="http://www.w3.org/2000/svg" class="tooltip-icon" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <div class="custom-tooltip">
                            <div class="flex justify-between items-start">

                                <div class="flex-grow">
                                    Please refer to the ioCELL user manual for your cell type for guidance on thawing and
                                    recommended initial suspension volume.
                                </div>
                            </div>
                        </div>
                    </span>
                </label>
                <div class="flex items-center flex-1 w-full">
                    <input id="suspension_volume" type="number" step="0.01" value="1"
                        class="w-32 p-1 border text-right border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    <span class="ml-2 text-sm text-gray-700">ml</span>
                </div>
            </div>

            <!-- Live Cell Count - Improve responsive layout -->
            <div class="mb-4 flex flex-col sm:flex-row items-start border-b-2 border-gray-50 py-2">
                <label class="text-sm font-medium w-full sm:w-64 text-gray-700 flex items-center mb-2 sm:mb-0">
                    Live cell count
                    <span class="ml-1 tooltip-container text-gray-500 cursor-help">
                        <svg xmlns="http://www.w3.org/2000/svg" class="tooltip-icon" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <div class="custom-tooltip">
                            <div class="flex justify-between items-start">

                                <div class="flex-grow">
                                    Please count the number of cells using a viability marker. We recommend performing the
                                    count in triplicate. The calculator will automatically calculate the average value. If
                                    you have an outlier, best practice is to re-suspend the cells carefully and repeat the
                                    triplicate count from the beginning. Please do not enter the number of dead cells, the
                                    value should reflect the viable number of cells only.
                                </div>
                            </div>
                        </div>
                    </span>
                </label>
                <div class="flex-1 w-full">
                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-2 items-center">
                        <div>
                            <div class="text-xs text-gray-600 mb-1">Count 1</div>
                            <input id="count1" type="text"
                                class="w-full px-3 py-1 border border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div>
                            <div class="text-xs text-gray-600 mb-1">Count 2</div>
                            <input id="count2" type="text"
                                class="w-full px-3 py-1 border border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div>
                            <div class="text-xs text-gray-600 mb-1">Count 3</div>
                            <input id="count3" type="text"
                                class="w-full px-3 py-1 border border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div class="text-sm mt-4 text-gray-500 flex items-center justify-start sm:justify-center">x
                            10<sup>6</sup> cells/ml</div>
                    </div>
                    <div id="cellCountWarning" class="hidden mt-2 p-2 bg-white border-l-4 border-orange-400">
                        <div class="flex justify-between text-orange-700">
                            <svg class="h-4 w-4 text-orange-400 mr-2" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <circle cx="12" cy="12" r="10" stroke-width="2" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01" />
                            </svg>
                            <button type="button" class="ml-auto text-orange-700 hover:text-orange-900"
                                onclick="document.getElementById('cellCountWarning').classList.add('hidden')">
                                <svg class="tooltip-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                        <p class="text-sm">
                            If there is significant variability in your live cell count, we recommend that you resuspend
                            your cell suspension and perform a recount.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Cell Viability - Improve responsive layout -->
            <div class="mb-4 flex flex-col sm:flex-row items-start border-b-2 border-gray-50 py-2">
                <label class="text-sm font-medium w-full sm:w-64 text-gray-700 flex items-center mb-2 sm:mb-0">Cell
                    viability</label>
                <div class="flex-1 w-full">
                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-2 items-center">
                        <div>
                            <div class="text-xs text-gray-600 mb-1">Count 1</div>
                            <input id="viability1" type="number" step="0.1" value="100"
                                class="w-full px-3 py-1 border border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div>
                            <div class="text-xs text-gray-600 mb-1">Count 2</div>
                            <input id="viability2" type="number" step="0.1"
                                class="w-full px-3 py-1 border border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div>
                            <div class="text-xs text-gray-600 mb-1">Count 3</div>
                            <input id="viability3" type="number" step="0.1"
                                class="w-full px-3 py-1 border border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div class="text-sm text-gray-500 mt-4 flex items-center justify-start sm:justify-center">%</div>
                    </div>
                    <div id="viabilityWarning" class="hidden mt-2 p-2 bg-white border-l-4 border-orange-400">
                        <div class="flex justify-between text-orange-700">
                            <svg class="h-4 w-4 text-orange-400 mr-2" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <circle cx="12" cy="12" r="10" stroke-width="2" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4m0 4h.01" />
                            </svg>
                            <button type="button" class="ml-auto text-orange-700 hover:text-orange-900"
                                onclick="document.getElementById('viabilityWarning').classList.add('hidden')">
                                <svg class="tooltip-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                        <p class="text-sm">
                            If there is significant variability in your cell viability percentage, or if this value is below
                            80%, we recommend that you re-suspend your cell suspension and perform a recount.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Cell Type - Improve responsive layout -->
            <div class="mb-4 flex flex-col sm:flex-row items-start border-b-2 border-gray-50 py-2">
                <label for="cell_type"
                    class="text-sm font-medium w-full sm:w-64 text-gray-700 flex items-center mb-2 sm:mb-0">Cell
                    type</label>
                <div class="flex-1 relative w-full">
                    <select id="cell_type"
                        class="w-full px-3 py-1 border !cursor-text border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 searchable-select">
                        <option value="">--Select your cell type--</option>
                    </select>
                </div>
            </div>

            <!-- Seeding Density - Improve responsive layout -->
            <div class="mb-4 flex flex-col sm:flex-row items-start border-b-2 border-gray-50 py-2">
                <label for="seeding_density"
                    class="text-sm font-medium w-full sm:w-64 text-gray-700 flex items-center mb-2 sm:mb-0">
                    Seeding density <span class="text-red-500">*</span>
                    <span class="ml-1 tooltip-container text-gray-500 cursor-help">
                        <svg xmlns="http://www.w3.org/2000/svg" class="tooltip-icon" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <div class="custom-tooltip">
                            <div class="flex justify-between items-start">

                                <div class="flex-grow">
                                    Please note that the default seeding density has been optimized by bit.bio for ioCELLs.
                                    Changing this value may impact performance. Consider what is needed based on your assay
                                    or application.
                                </div>
                            </div>
                        </div>
                    </span>
                </label>
                <div class="flex items-center flex-1 w-full">
                    <input id="seeding_density" type="number"
                        class="w-32 px-3 py-1 border border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    <span class="ml-2 text-sm text-gray-700">cells/cm²</span>
                </div>
            </div>

            <!-- Culture Vessel - Improve responsive layout -->
            <div class="mb-4 flex flex-col sm:flex-row items-start border-b-2 border-gray-50 py-2">
                <label for="culture_vessel"
                    class="text-sm font-medium w-full sm:w-64 text-gray-700 flex items-center mb-2 sm:mb-0">
                    Culture vessel
                    <span class="ml-1 tooltip-container text-gray-500 cursor-help">
                        <svg xmlns="http://www.w3.org/2000/svg" class="tooltip-icon" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <div class="custom-tooltip">
                            <div class="flex justify-between items-start">

                                <div class="flex-grow">
                                    Please select the appropriate culture vessel for your experimental setup. The options
                                    and values provided are for reference only based on the most widely used formats—be sure
                                    to confirm them and adjust surface area and volume according to the supplier's
                                    recommendations.
                                </div>
                            </div>
                        </div>
                    </span>
                </label>
                <div class="flex-1 relative w-full">
                    <select id="culture_vessel"
                        class="w-full px-3 py-1 !cursor-text border border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 searchable-select">
                        <!-- Options will be populated by JS -->
                    </select>
                </div>
            </div>

            <!-- Surface Area - Improve responsive layout -->
            <div class="mb-4 flex flex-col sm:flex-row items-start border-b-2 border-gray-50 py-2">
                <label for="surface_area"
                    class="text-sm font-medium w-full sm:w-64 text-gray-700 flex items-center mb-2 sm:mb-0">
                    Surface area <span class="text-red-500">*</span>
                </label>
                <div class="flex items-center flex-1 w-full">
                    <input id="surface_area" type="number" step="0.01"
                        class="w-32 px-3 py-1 border border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    <span class="ml-2 text-sm text-gray-700">cm²/well</span>
                </div>
            </div>

            <!-- Media Volume - Improve responsive layout -->
            <div class="mb-4 flex flex-col sm:flex-row items-start border-b-2 border-gray-50 py-2">
                <label for="media_volume"
                    class="text-sm font-medium w-full sm:w-64 text-gray-700 flex items-center mb-2 sm:mb-0">
                    Volume <span class="text-red-500">*</span>
                </label>
                <div class="flex items-center flex-1 w-full">
                    <input id="media_volume" type="number" step="0.01"
                        class="w-32 px-3 py-1 border border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    <span class="ml-2 text-sm text-gray-700">ml/well</span>
                </div>
            </div>

            <!-- Number of Wells - Improve responsive layout -->
            <div class="mb-4 flex flex-col sm:flex-row items-start border-b-2 border-gray-50 py-2">
                <label for="num_wells"
                    class="text-sm font-medium w-full sm:w-64 text-gray-700 flex items-center mb-2 sm:mb-0">
                    Number of wells to seed <span class="text-red-500">*</span>
                </label>
                <div class="flex items-center flex-1 w-full">
                    <input id="num_wells" type="number" value="96"
                        class="w-32 px-3 py-1 border border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    <span class="ml-2 text-sm text-gray-700">wells</span>
                </div>
            </div>

            <!-- Dead Volume Allowance - Improve responsive layout -->
            <div class="mb-6 flex flex-col sm:flex-row items-start">
                <label for="buffer"
                    class="text-sm font-medium w-full sm:w-64 text-gray-700 flex items-center mb-2 sm:mb-0">
                    Dead volume allowance
                    <span class="ml-1 tooltip-container text-gray-500 cursor-help">
                        <svg xmlns="http://www.w3.org/2000/svg" class="tooltip-icon" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <div class="custom-tooltip">
                            <div class="flex justify-between items-start">

                                <div class="flex-grow">
                                    Include contingency (typically 10–20%) to account for dead volume. If unsure on what
                                    values to use, you can also change this value to what you'd recommend adding a few extra
                                    wells.
                                </div>
                            </div>
                        </div>
                    </span>
                </label>
                <div class="flex items-center flex-1 w-full">
                    <input id="buffer" type="number" step="0.1" value="10"
                        class="w-32 px-3 py-1 border border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    <span class="ml-2 text-sm text-gray-700">%</span>
                </div>
            </div>

            <!-- Calculate Button - Improve responsive layout -->
            <div class="mt-6 flex flex-col sm:flex-row items-center justify-between gap-3">
                <p class="text-sm text-gray-500 mb-2 sm:mb-0">* Required field</p>
                <div>
                    <div id="validationErrors" class="hidden w-full sm:w-64 my-2 text-xs text-red-700"></div>
                    <button id="calculateBtn" class="grad-bg w-full sm:w-60 text-white font-medium py-2 px-4 transition">
                        Calculate results
                    </button>
                    <div id="actionButtons" class="hidden w-full">
                        <div class="flex flex-col sm:flex-row gap-2 mt-2">
                            <button id="resetBtn"
                                class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-medium py-2 px-4 transition w-full sm:w-40">
                                Reset
                            </button>
                            <button id="recalculateBtn"
                                class="grad-bg text-white font-medium py-2 px-4 transition w-full">
                                Recalculate
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Results Section - Always full width on mobile -->
        <div class="w-full lg:w-1/3 p-3 sm:p-4 border border-gray-200 self-start">
            <h2 class="text-lg font-medium mb-3">Results</h2>
            <div id="results" class="space-y-4">
                <!-- Initial help content shown before calculation -->
                <div id="helpContent">
                    <h3 class="text-md font-medium mb-2">How to get started?</h3>
                    <ul class="list-disc pl-5 space-y-3 text-sm">
                        <li>Start by entering your cell stock volume.</li>
                        <li>Add your cell count and viability. Ideally perform your count three times.</li>
                        <li>Select your cell type and the recommended seeding density will be populated.</li>
                        <li>Choose your vessel format to automatically fill in the surface area and volume.</li>
                        <li>Include a 10-20% dead volume allowance or adjust based on your workflow.</li>
                    </ul>
                </div>

                <!-- Results content hidden initially, shown after calculation -->
                <div id="resultsContent" class="hidden">
                    <p class="text-sm mb-3">Your results for seeding of <span id="wellCount">XYZ</span> wells</p>

                    <div class="mb-4">
                        <label class="text-sm font-medium text-gray-700 mb-1 block">Volume of media for dilution</label>
                        <div class="bg-blue-50 px-3 py-1 border border-blue-100 rounded">
                            <span id="volume_to_dilute" class="text-lg font-medium">9.98</span> mL
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="text-sm font-medium text-gray-700 mb-1 block">From your initial cell stock volume,
                            pipette</label>
                        <div class="bg-blue-50 px-3 py-1 border border-blue-100 rounded">
                            <span id="volume_to_seed" class="text-lg font-medium">1.06</span> mL
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="text-sm font-medium text-gray-700 mb-1 block">Add <span
                                id="volume_plate_perwell_simple">XYZ</span> μL of the final dilution to each well</label>
                        <p class="text-xs text-gray-600 mt-1">Review the values below and adjust if needed for your
                            experiment</p>
                    </div>

                    <div class="mb-4">
                        <label class="text-sm font-medium text-gray-700 mb-1 block">Cell density</label>
                        <div class="bg-blue-50 px-3 py-1 border border-blue-100 rounded">
                            <span id="cell_density_formatted" class="text-lg font-medium">1.00 x 10<sup>6</sup></span>
                            cells/mL
                        </div>
                    </div>

                    <!-- Required number of cells - Improve grid for mobile -->
                    <div class="mb-4">
                        <label class="text-sm font-medium text-gray-700 mb-1 block">Required number of cells</label>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">
                            <div>
                                <p class="text-xs text-gray-600 mb-1">Total</p>
                                <div class="bg-blue-50 px-3 py-1 border border-blue-100 rounded">
                                    <span id="required_cells_total_formatted" class="text-md font-medium">1.10 x
                                        10<sup>6</sup></span> cells
                                </div>
                            </div>
                            <div>
                                <p class="text-xs text-gray-600 mb-1">per well</p>
                                <div class="bg-blue-50 px-3 py-1 border border-blue-100 rounded">
                                    <span id="cells_per_well_formatted" class="text-md font-medium">9,600</span> cells
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="warnings" class="hidden bg-red-100 border border-red-400 text-red-700 px-4 py-3 mb-4">
                    </div>

                    <!-- Additional info about copy/paste functionality -->
                    <div id="copyPasteInfo" class="text-xs no-print text-gray-500 mt-2 hidden">
                        <p>✨ <i>Tip: Double-click any value to select it for copy/paste.</i></p>
                    </div>

                    <!-- Download buttons for results -->
                    <div id="downloadOptions" class="hidden mt-4 space-y-2">
                        <button id="downloadExcel"
                            class="w-full px-6 py-2 !cursor-pointer bg-gray-200 hover:bg-gray-300 text-gray-800 flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            Download as Excel
                        </button>
                        <button id="downloadPdf"
                            class="w-full px-6 py-2 grad-bg text-white flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 10v6m0 0l-3-3m3 3l3-3M3 17V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z" />
                            </svg>
                            Download as PDF
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <x-UsefulResources />
    <style>
        /* Input styling for default/active states */
        .default-input {
            color: #9ca3af;
            /* Gray-400 for default values */
        }

        .active-input {
            color: #111827;
            /* Gray-900 for active/used values */
        }

        /* Gradient background for buttons */
        .grad-bg {
            background-image: linear-gradient(to right, #3b82f6, #9333ea);
        }

        .grad-bg:hover {
            cursor: pointer;
        }

        /* Search dropdown styling */
        .search-container {
            position: relative;
            width: 100%;
        }

        .search-input {
            width: 100%;
            padding: 0.25rem 0.75rem;
            border: 1px solid #d1d5db;
            border-radius: 0.25rem;
        }

        .search-results {
            position: absolute;
            width: 100%;
            max-height: 200px;
            overflow-y: auto;
            background-color: white;
            border: 1px solid #d1d5db;
            border-top: none;
            z-index: 10;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }

        .search-option {
            padding: 0.5rem 0.75rem;
            cursor: pointer;
        }

        .search-option:hover {
            background-color: #f3f4f6;
        }

        .search-option.selected {
            background-color: #e5e7eb;
        }

        /* Info tooltip styling */
        .info-tooltip {
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
            z-index: 100;
        }

        /* Tooltip icon sizing */
        .tooltip-icon {
            height: 1rem;
            width: 1rem;
        }

        /* Make info icons more obviously clickable */
        .cursor-help {
            cursor: pointer;
        }

        .cursor-help:hover svg {
            color: #4B5563;
        }

        /* Responsive tooltip styling */
        .custom-tooltip {
            display: none;
            position: absolute;
            z-index: 50;
            width: 100%;
            max-width: 30rem;
            left: 0;
            background-color: white;
            border-radius: 4px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            padding: 10px;
            font-size: 0.875rem;
            margin-top: 0.5rem;
            border: 1px solid #e5e7eb;
            color: #4b5563;
        }

        @media (max-width: 640px) {
            .custom-tooltip {
                left: -50px;
                right: -50px;
                width: calc(100% + 100px);
            }
        }

        @media (min-width: 641px) and (max-width: 768px) {
            .custom-tooltip {
                left: -100px;
                width: calc(100% + 100px);
            }
        }

        .tooltip-container {
            position: relative;
            display: inline-block;
        }

        .tooltip-container:hover .custom-tooltip {
            display: block;
        }

        /* Improve form responsiveness */
        @media (max-width: 640px) {

            input[type="number"],
            input[type="text"] {
                width: 100%;
                max-width: 140px;
            }
        }
    </style>
    <script>
        function printScreen() {
            window.print();
        }

        // Attach it to your button once the DOM is ready
        document.addEventListener('DOMContentLoaded', function() {
            const btn = document.getElementById('downloadPdf');
            if (btn) {
                btn.addEventListener('click', function(e) {
                    e.preventDefault();
                    printScreen();
                });
            }
        });

        // Helper function to parse numeric inputs that may contain either commas or periods as decimal separators
        function parseDecimalInput(value) {
            if (!value || value.trim() === '') return 0;
            // Replace commas with periods for consistent parsing
            const normalized = value.replace(',', '.');
            const result = parseFloat(normalized);
            return isNaN(result) ? 0 : result;
        }

        document.addEventListener('DOMContentLoaded', async () => {
            // Apply default styling to all inputs with default values
            const numericInputs = document.querySelectorAll('input[type="number"]');
            numericInputs.forEach(input => {
                if (input.value) {
                    input.classList.add('default-input');
                }

                // Update styling when user interacts with the input
                input.addEventListener('input', function() {
                    this.classList.remove('default-input');
                    this.classList.add('active-input');
                });

                input.addEventListener('focus', function() {
                    this.classList.remove('default-input');
                    this.classList.add('active-input');
                    // Auto-select all text when input receives focus
                    this.select();
                });

                // Clear input when user starts typing a new number
                input.addEventListener('keydown', function(e) {
                    // If a number key is pressed and no text is selected
                    if ((e.key >= '0' && e.key <= '9' || e.key === '.' || e.key === ',') &&
                        this.selectionStart === this.selectionEnd &&
                        this.selectionStart > 0) {
                        // Clear the field if user is typing a new number
                        this.value = '';
                    }
                });
            });

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
                cultureVesselSelect.innerHTML = '<option value="">--Select your culture vessel--</option>';
                vessels.forEach((v, i) => {
                    const opt = document.createElement('option');
                    opt.value = v.id;
                    opt.textContent = v.plate_format;
                    opt.dataset.surfaceArea = v.surface_area_cm2;
                    opt.dataset.mediaVolume = v.media_volume_per_well_ml;
                    cultureVesselSelect.appendChild(opt);
                });
                // Remove auto-population of first vessel values
            }

            // Prevent Enter key from triggering the calculate button
            document.querySelectorAll('input, select').forEach(element => {
                element.addEventListener('keydown', function(e) {
                    if (e.key === 'Enter') {
                        e.preventDefault();
                        // Move focus to the next field or just prevent submission
                        const form = document.querySelector('form');
                        const index = [...form ? form.elements : document.querySelectorAll(
                            'input, select')].indexOf(this);
                        const next = [...form ? form.elements : document.querySelectorAll(
                            'input, select')][index + 1];
                        if (next) next.focus();
                    }
                });
            });

            // Track the currently open search container
            let currentOpenSearchContainer = null;

            // Search functionality for select elements
            document.querySelectorAll('.searchable-select').forEach(select => {
                initializeSearchableSelect(select);
            });

            function initializeSearchableSelect(selectElement) {
                selectElement.addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();

                    // Close any existing open search container first
                    if (currentOpenSearchContainer) {
                        const oldSelect = currentOpenSearchContainer.previousElementSibling;
                        if (oldSelect) {
                            oldSelect.style.display = '';
                        }
                        if (currentOpenSearchContainer.parentNode) {
                            currentOpenSearchContainer.parentNode.removeChild(
                                currentOpenSearchContainer);
                        }
                        currentOpenSearchContainer = null;
                    }

                    // Create search container
                    const searchContainer = document.createElement('div');
                    searchContainer.className = 'search-container';

                    // Create search input
                    const searchInput = document.createElement('input');
                    searchInput.type = 'text';
                    searchInput.className =
                        'search-input focus:outline-none focus:ring-blue-500 focus:border-blue-500';
                    searchInput.placeholder = 'Search...';

                    // Create results container
                    const resultsContainer = document.createElement('div');
                    resultsContainer.className = 'search-results hidden';

                    // Add elements to container
                    searchContainer.appendChild(searchInput);
                    searchContainer.appendChild(resultsContainer);

                    // Hide select and show search
                    selectElement.style.display = 'none';
                    selectElement.parentNode.appendChild(searchContainer);

                    // Store reference to current open search container
                    currentOpenSearchContainer = searchContainer;

                    // Focus on input
                    searchInput.focus();

                    // Get all options from the select element
                    const options = Array.from(selectElement.options).filter(opt => opt.value !== '');

                    // Populate initial results
                    updateSearchResults('', options, resultsContainer, selectElement, searchContainer);

                    // Add input event listener
                    searchInput.addEventListener('input', function() {
                        const searchTerm = this.value.toLowerCase();
                        updateSearchResults(searchTerm, options, resultsContainer,
                            selectElement, searchContainer);
                    });

                    // Close search when clicking outside
                    document.addEventListener('click', function closeSearch(e) {
                        if (!searchContainer.contains(e.target)) {
                            selectElement.style.display = '';
                            if (searchContainer.parentNode) {
                                searchContainer.parentNode.removeChild(searchContainer);
                            }
                            // Reset the current open container reference
                            if (currentOpenSearchContainer === searchContainer) {
                                currentOpenSearchContainer = null;
                            }
                            document.removeEventListener('click', closeSearch);
                        }
                    });
                });
            }

            function updateSearchResults(searchTerm, options, resultsContainer, selectElement,
                searchContainer) {
                // Filter options based on search term
                const filteredOptions = options.filter(opt =>
                    opt.textContent.toLowerCase().includes(searchTerm)
                );

                // Clear previous results
                resultsContainer.innerHTML = '';

                if (filteredOptions.length === 0) {
                    resultsContainer.innerHTML = '<div class="p-2 text-gray-500">No results found</div>';
                    resultsContainer.classList.remove('hidden');
                    return;
                }

                // Add filtered options to results
                filteredOptions.forEach(opt => {
                    const resultItem = document.createElement('div');
                    resultItem.className = 'search-option';
                    resultItem.textContent = opt.textContent;
                    resultItem.dataset.value = opt.value;
                    if (opt.dataset) {
                        for (const key in opt.dataset) {
                            resultItem.dataset[key] = opt.dataset[key];
                        }
                    }

                    resultItem.addEventListener('click', function() {
                        // Set the selected value in the original select
                        selectElement.value = this.dataset.value;

                        // Trigger change event to update dependent fields
                        const changeEvent = new Event('change', {
                            bubbles: true
                        });
                        selectElement.dispatchEvent(changeEvent);

                        // Remove search container and show select
                        selectElement.style.display = '';
                        searchContainer.parentNode.removeChild(searchContainer);
                    });

                    resultsContainer.appendChild(resultItem);
                });

                // Show results
                resultsContainer.classList.remove('hidden');
            }

            cellTypeSelect.addEventListener('change', function() {
                const opt = this.options[this.selectedIndex];
                if (opt && opt.dataset.seedingDensity) {
                    seedingInput.value = opt.dataset.seedingDensity;
                    seedingInput.classList.add('default-input');
                    seedingInput.classList.remove('active-input');
                } else {
                    seedingInput.value = '';
                }
            });

            cultureVesselSelect.addEventListener('change', function() {
                const opt = this.options[this.selectedIndex];
                if (opt && opt.value) {
                    if (opt.dataset.surfaceArea !== 'null') {
                        surfaceAreaInput.value = opt.dataset.surfaceArea;
                        surfaceAreaInput.classList.add('default-input');
                        surfaceAreaInput.classList.remove('active-input');
                    } else {
                        surfaceAreaInput.value = '';
                    }

                    if (opt.dataset.mediaVolume !== 'null') {
                        mediaVolumeInput.value = opt.dataset.mediaVolume;
                        mediaVolumeInput.classList.add('default-input');
                        mediaVolumeInput.classList.remove('active-input');
                    } else {
                        mediaVolumeInput.value = '';
                    }
                } else {
                    surfaceAreaInput.value = '';
                    mediaVolumeInput.value = '';
                }
            });

            // Add event listeners for when these fields get manually changed
            seedingInput.addEventListener('input', function() {
                this.classList.remove('default-input');
                this.classList.add('active-input');
            });

            surfaceAreaInput.addEventListener('input', function() {
                this.classList.remove('default-input');
                this.classList.add('active-input');
            });

            mediaVolumeInput.addEventListener('input', function() {
                this.classList.remove('default-input');
                this.classList.add('active-input');
            });

            // Calculation Logic
            document.getElementById('calculateBtn').addEventListener('click', performCalculation);

            // Reset functionality
            document.getElementById('resetBtn').addEventListener('click', () => {
                // Reset all inputs to default state
                document.querySelectorAll('input[type="number"], input[type="text"]').forEach(input => {
                    // Only reset non-default inputs
                    if (input.id === 'suspension_volume') {
                        input.value = '1';
                    } else if (input.id === 'viability1') {
                        input.value = '100';
                    } else if (input.id === 'buffer') {
                        input.value = '10';
                    } else if (input.id === 'num_wells') {
                        input.value = '96';
                    } else {
                        input.value = '';
                    }
                    input.classList.remove('active-input', 'border-red-500');
                    if (input.value) {
                        input.classList.add('default-input');
                    }
                });

                // Reset select elements
                document.getElementById('cell_type').value = '';
                document.getElementById('culture_vessel').value = '';

                // Hide results and show help content
                document.getElementById('resultsContent').classList.add('hidden');
                document.getElementById('helpContent').classList.remove('hidden');
                document.getElementById('validationErrors').classList.add('hidden');
                document.getElementById('warnings').classList.add('hidden');

                // Hide download options and copy/paste info
                document.getElementById('downloadOptions').classList.add('hidden');
                document.getElementById('copyPasteInfo').classList.add('hidden');

                // Show calculate button, hide action buttons
                document.getElementById('calculateBtn').classList.remove('hidden');
                document.getElementById('actionButtons').classList.add('hidden');

                // Reset any warning messages
                document.getElementById('cellCountWarning').classList.add('hidden');
                document.getElementById('viabilityWarning').classList.add('hidden');
            });

            // Recalculate functionality
            document.getElementById('recalculateBtn').addEventListener('click', performCalculation);

            // Function to perform calculation (extracted from the click handler)
            function performCalculation() {
                // Validate required fields first
                const missingFields = validateRequiredFields();
                const warningsDiv = document.getElementById('warnings');
                const validationErrorsDiv = document.getElementById('validationErrors');
                const helpContent = document.getElementById('helpContent');
                const resultsContent = document.getElementById('resultsContent');

                if (missingFields.length > 0) {
                    // Show error message inline (not in modal)
                    validationErrorsDiv.innerHTML =
                        `<p>⚠️ Please fill in the following required fields: <br/>-- ${missingFields.join(', ')}</p>`;
                    validationErrorsDiv.classList.remove('hidden');

                    return; // Stop execution if validation fails
                } else {
                    // Clear validation errors if passed
                    validationErrorsDiv.classList.add('hidden');
                    validationErrorsDiv.innerHTML = '';
                }

                // Hide help content and show results content
                helpContent.classList.add('hidden');
                resultsContent.classList.remove('hidden');

                // Hide calculate button and show action buttons
                document.getElementById('calculateBtn').classList.add('hidden');
                document.getElementById('actionButtons').classList.remove('hidden');

                // Show download options and copy/paste info
                document.getElementById('downloadOptions').classList.remove('hidden');
                document.getElementById('copyPasteInfo').classList.remove('hidden');

                // Gather inputs
                const seeding = parseFloat(document.getElementById('seeding_density').value) || 0;
                const wells = parseInt(document.getElementById('num_wells').value) || 0;
                const area = parseFloat(document.getElementById('surface_area').value) || 0;
                const mediaVol = parseFloat(document.getElementById('media_volume').value) || 0;
                const counts = [
                    parseDecimalInput(document.getElementById('count1').value),
                    parseDecimalInput(document.getElementById('count2').value),
                    parseDecimalInput(document.getElementById('count3').value)
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

                // Build calculation warnings (not validation errors)
                const warningsArr = [];
                if (requiredCells > avgCount) {
                    warningsArr.push('⚠️ You do not have enough cells for your experimental design.');
                }
                if (bufferPerc === 0) {
                    warningsArr.push(
                        '⚠️ It is highly recommended to include a buffer to ensure enough cells and media.'
                    );
                }

                if (warningsArr.length) {
                    warningsDiv.innerHTML = warningsArr.map(msg => `<p>${msg}</p>`).join('');
                    warningsDiv.classList.remove('hidden');
                } else {
                    warningsDiv.classList.add('hidden');
                }

                // Format numbers for display
                const formatExponential = (num) => {
                    const exp = num.toExponential(2);
                    const parts = exp.split('e+');
                    return `${parts[0]} x 10<sup>${parts[1]}</sup>`;
                };

                // Display results in the side panel
                document.getElementById('wellCount').textContent = wells;
                document.getElementById('volume_to_dilute').textContent = volDilute.toFixed(2);
                document.getElementById('volume_to_seed').textContent = volToSeed.toFixed(2);
                document.getElementById('volume_plate_perwell_simple').textContent = (volPlatePerWell *
                    1000).toFixed(0);
                document.getElementById('cell_density_formatted').innerHTML = formatExponential(
                    cellDensity);
                document.getElementById('required_cells_total_formatted').innerHTML = formatExponential(
                    requiredCells);

                // Mark all inputs used in calculations as active
                const inputsUsedInCalculation = [
                    'seeding_density', 'num_wells', 'surface_area',
                    'media_volume', 'count1', 'count2', 'count3',
                    'viability1', 'viability2', 'viability3',
                    'buffer', 'suspension_volume'
                ];

                inputsUsedInCalculation.forEach(id => {
                    const input = document.getElementById(id);
                    if (input) {
                        input.classList.remove('default-input');
                        input.classList.add('active-input');
                    }
                });

                document.getElementById('cells_per_well_formatted').textContent = cellsPerWell
                    .toLocaleString(undefined, {
                        maximumFractionDigits: 0
                    });

                // Check viability values when calculating
                checkViabilityValues();

                // Check cell count variability when calculating
                checkCellCountVariability();
            }

            // Improve validation function to handle edge cases
            function validateRequiredFields() {
                const requiredFields = [{
                        id: 'suspension_volume',
                        name: 'Cell stock volume'
                    },
                    {
                        id: 'seeding_density',
                        name: 'Seeding density'
                    },
                    {
                        id: 'surface_area',
                        name: 'Surface area'
                    },
                    {
                        id: 'media_volume',
                        name: 'Volume'
                    },
                    {
                        id: 'num_wells',
                        name: 'Number of wells to seed'
                    }
                ];

                const missingFields = [];

                requiredFields.forEach(field => {
                    const input = document.getElementById(field.id);
                    // Check if value is empty, zero, or NaN
                    const value = input.value;
                    const numValue = parseFloat(value);

                    if (value === '' || isNaN(numValue) || numValue === 0) {
                        missingFields.push(field.name);
                        // Highlight the empty field
                        input.classList.add('border-red-500');
                    } else {
                        // Remove highlighting if field is filled
                        input.classList.remove('border-red-500');
                    }
                });

                return missingFields;
            }

            // Close modal events
            document.getElementById('closeModal').addEventListener('click', () => {
                document.getElementById('resultsModal').classList.add('hidden');
            });

            document.getElementById('resultsModal').addEventListener('click', (e) => {
                if (e.target === document.getElementById('resultsModal')) {
                    document.getElementById('resultsModal').classList.add('hidden');
                }
            });
            document.getElementById('cells_per_well_formatted').textContent = cellsPerWell
                .toLocaleString(undefined, {
                    maximumFractionDigits: 0
                });
        });

        document.addEventListener('DOMContentLoaded', function() {
            // Setup download buttons
            setupDownloadButtons();
        });

        function setupDownloadButtons() {
            const excelBtn = document.getElementById("downloadExcel");

            if (excelBtn) {
                excelBtn.addEventListener("click", function(e) {
                    e.preventDefault();
                    downloadAsExcel();
                });
            }
        }

        /**
         * Downloads the results as an Excel file using the server
         */
        function downloadAsExcel() {
            console.log('Starting Excel download...');

            // Prevent multiple downloads
            if (window.isDownloading) return;
            window.isDownloading = true;

            // Get result data
            const resultData = getResultData();
            console.log('Result data:', resultData);

            // Create a form to submit the data
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = '{{ route('calculator.download.excel') }}';
            form.style.display = 'none';

            // Add CSRF token
            const csrfToken = '{{ csrf_token() }}';
            const csrfInput = document.createElement('input');
            csrfInput.type = 'hidden';
            csrfInput.name = '_token';
            csrfInput.value = csrfToken;
            form.appendChild(csrfInput);

            // Add well count
            const wellCountInput = document.createElement('input');
            wellCountInput.type = 'hidden';
            wellCountInput.name = 'wellCount';
            wellCountInput.value = document.getElementById('wellCount').textContent || '0';
            form.appendChild(wellCountInput);

            // Add all result data
            Object.keys(resultData).forEach(key => {
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = key;
                input.value = resultData[key] || '';
                form.appendChild(input);
            });

            // Submit the form
            document.body.appendChild(form);

            try {
                form.submit();
                console.log('Form submitted successfully');
            } catch (e) {
                console.error('Error submitting form:', e);
            }

            // Reset download flag after a delay
            setTimeout(() => {
                document.body.removeChild(form);
                window.isDownloading = false;
            }, 2000);
        }

        /**
         * Gets formatted result data for download
         */
        function getResultData() {
            const cellDensityEl = document.getElementById("cell_density_formatted");
            const cellsPerWellEl = document.getElementById("cells_per_well_formatted");
            const requiredCellsEl = document.getElementById("required_cells_total_formatted");
            const volumeToDiluteEl = document.getElementById("volume_to_dilute");
            const volumeToSeedEl = document.getElementById("volume_to_seed");
            const volumePerWellEl = document.getElementById("volume_plate_perwell_simple");

            // Get input field values
            const suspensionVolumeEl = document.getElementById("suspension_volume");
            const count1El = document.getElementById("count1");
            const count2El = document.getElementById("count2");
            const count3El = document.getElementById("count3");
            const viability1El = document.getElementById("viability1");
            const viability2El = document.getElementById("viability2");
            const viability3El = document.getElementById("viability3");
            const cellTypeEl = document.getElementById("cell_type");
            const seedingDensityEl = document.getElementById("seeding_density");
            const cultureVesselEl = document.getElementById("culture_vessel");
            const surfaceAreaEl = document.getElementById("surface_area");
            const mediaVolumeEl = document.getElementById("media_volume");
            const numWellsEl = document.getElementById("num_wells");
            const bufferEl = document.getElementById("buffer");

            // Calculate average cell count
            const counts = [
                parseDecimalInput(count1El?.value || '0'),
                parseDecimalInput(count2El?.value || '0'),
                parseDecimalInput(count3El?.value || '0')
            ].filter(count => count > 0);
            const avgCount = counts.length > 0 ? (counts.reduce((a, b) => a + b, 0) / counts.length).toFixed(2) : '-';

            // Calculate average viability
            const viabilities = [
                parseFloat(viability1El?.value || '0'),
                parseFloat(viability2El?.value || '0'),
                parseFloat(viability3El?.value || '0')
            ].filter(v => v > 0);
            const avgViability = viabilities.length > 0 ? (viabilities.reduce((a, b) => a + b, 0) / viabilities.length)
                .toFixed(1) : '-';

            // Get selected cell type and culture vessel text
            let cellTypeText = '-';
            if (cellTypeEl && cellTypeEl.selectedIndex > 0) {
                cellTypeText = cellTypeEl.options[cellTypeEl.selectedIndex].text;
            }

            let cultureVesselText = '-';
            if (cultureVesselEl && cultureVesselEl.selectedIndex > 0) {
                cultureVesselText = cultureVesselEl.options[cultureVesselEl.selectedIndex].text;
            }

            return {
                // Results
                cellDensity: cellDensityEl ? cellDensityEl.innerHTML : "",
                cellsPerWell: cellsPerWellEl ? cellsPerWellEl.textContent : "",
                requiredCells: requiredCellsEl ? requiredCellsEl.innerHTML : "",
                volumeToDilute: volumeToDiluteEl ? volumeToDiluteEl.textContent : "",
                volumeToSeed: volumeToSeedEl ? volumeToSeedEl.textContent : "",
                volumePerWell: volumePerWellEl ? volumePerWellEl.textContent : "",

                // Input parameters
                suspensionVolume: suspensionVolumeEl ? suspensionVolumeEl.value : "",
                liveCellCount: avgCount,
                cellViability: avgViability,
                cellType: cellTypeText,
                seedingDensity: seedingDensityEl ? seedingDensityEl.value : "",
                cultureVessel: cultureVesselText,
                surfaceArea: surfaceAreaEl ? surfaceAreaEl.value : "",
                mediaVolume: mediaVolumeEl ? mediaVolumeEl.value : "",
                buffer: bufferEl ? bufferEl.value : "",
            };
        }

        // Add an event listener to close validation errors when focus moves to any input
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('input, select').forEach(el => {
                el.addEventListener('focus', function() {
                    const validationErrors = document.getElementById('validationErrors');
                    if (validationErrors) {
                        validationErrors.classList.add('hidden');
                    }
                });
            });
        });

        // Check viability values when they change
        document.addEventListener('DOMContentLoaded', function() {
            const viabilityInputs = ['viability1', 'viability2', 'viability3'];
            viabilityInputs.forEach(id => {
                const input = document.getElementById(id);
                if (input) {
                    input.addEventListener('change', checkViabilityValues);
                }
            });

            // Add event listeners for calculate button
            const calculateBtn = document.getElementById('calculateBtn');
            if (calculateBtn) {
                calculateBtn.addEventListener('click', function() {
                    // Check viability values when calculating
                    checkViabilityValues();
                    // Check cell count variability when calculating
                    checkCellCountVariability();
                });
            }

            // Add cell count variability listeners
            const countInputs = ['count1', 'count2', 'count3'];
            countInputs.forEach(id => {
                const input = document.getElementById(id);
                if (input) {
                    input.addEventListener('input', checkCellCountVariability);
                }
            });
        });

        function checkViabilityValues() {
            const viabilityWarning = document.getElementById('viabilityWarning');
            if (!viabilityWarning) return;

            const viabilities = [
                parseFloat(document.getElementById('viability1')?.value) || 0,
                parseFloat(document.getElementById('viability2')?.value) || 0,
                parseFloat(document.getElementById('viability3')?.value) || 0
            ].filter(v => v > 0); // Only consider non-zero values

            // Check if any viability value is below 80%
            const lowViability = viabilities.some(v => v < 80);

            if (lowViability && viabilities.length > 0) {
                viabilityWarning.classList.remove('hidden');
            } else {
                viabilityWarning.classList.add('hidden');
            }
        }

        // Check cell count variability
        function checkCellCountVariability() {
            const count1El = document.getElementById('count1');
            const count2El = document.getElementById('count2');
            const count3El = document.getElementById('count3');
            const cellCountWarning = document.getElementById('cellCountWarning');

            if (!count1El || !count2El || !count3El || !cellCountWarning) return;

            const counts = [
                parseDecimalInput(count1El.value),
                parseDecimalInput(count2El.value),
                parseDecimalInput(count3El.value)
            ].filter(count => count > 0); // Only consider non-zero values

            // Need at least 2 counts to compare
            if (counts.length < 2) {
                cellCountWarning.classList.add('hidden');
                return;
            }

            let showWarning = false;

            // Check each pair of counts for ≥10% variability
            for (let i = 0; i < counts.length - 1; i++) {
                for (let j = i + 1; j < counts.length; j++) {
                    const larger = Math.max(counts[i], counts[j]);
                    const smaller = Math.min(counts[i], counts[j]);

                    // Calculate percentage difference relative to the larger value
                    const percentDiff = ((larger - smaller) / larger) * 100;

                    if (percentDiff >= 10) {
                        showWarning = true;
                        break;
                    }
                }
                if (showWarning) break;
            }

            if (showWarning) {
                cellCountWarning.classList.remove('hidden');
            } else {
                cellCountWarning.classList.add('hidden');
            }
        }
    </script>
@endsection
