<div class="md:w-[25%] w-full p-6 bg-[#fdffff] border border-[#d3dbe6] flex-grow flex flex-col">
    <div id="results" class="space-y-4">
        <!-- Initial help content shown before calculation -->
        <div id="helpContent max-w-[205px]">
            <h3 class="!text-[14px] !font-medium mb-5">How to get started?</h3>
            <ul class="list-disc pl-5 space-y-3 text-sm font-light">
                <li>Start by entering your cell stock volume.</li>
                <li>Add live cell count and viability, ideally perform your count three times.</li>
                <li>Select your cell type and adjust the seeding density as needed. The default values are optimised for
                    monocultures.</li>
                <li>Choose your vessel format and enter the number of wells.</li>
                <li>Include a 10–20% dead volume contingency or add extra wells.</li>
            </ul>
        </div>

        <!-- Results content hidden initially, shown after calculation -->
        <div id="resultsContent" class="hidden">
            <h2 class="font-semibold mb-2">Results</h2>
            <div id="narrativeText"
                class="text-sm p-2 hover:bg-blue-50 cursor-pointer transition-colors rounded relative"
                title="Click to copy to clipboard">
                Your results for seeding <span id="narrativeWellCount">XYZ</span> wells, prepare a dilution by
                combining <span id="narrativeVolumeSeed">0</span> mL of cell stock with <span
                    id="narrativeVolumeDilute">0</span> mL of media. Add <span id="narrativeVolumePerWell">0</span>
                μL of the final dilution to each well for a density of <span id="narrativeCellDensity">0</span>
                cells/mL, resulting in <span id="narrativeCellsPerWell">0</span> cells per well.
                <span id="copyIndicator"
                    class="hidden absolute top-2 right-2 text-xs text-green-600 bg-green-100 px-2 py-1 rounded">Copied!</span>
            </div>

            <div class="mb-4">
                <label class="font-semibold mb-1 block">Volume of media for dilution</label>
                <div class=" px-3 py-1 border border-blue-100 ">
                    <span id="volume_to_dilute" class="font-semibold">9.98</span> mL
                </div>
            </div>

            <div class="mb-4">
                <label class="font-semibold mb-1 block">From your initial cell stock volume,
                    pipette</label>
                <div class=" px-3 py-1 border border-blue-100 ">
                    <span id="volume_to_seed" class="font-semibold">1.06</span> mL
                </div>
            </div>

            <div class="mb-4">
                <label class="font-semibold  mb-1 block">Add <span id="volume_plate_perwell_simple">XYZ</span>
                    μL
                    of the final dilution to each well</label>
                <p class="mt-1">Review the values below and adjust if needed for your
                    experiment</p>
            </div>

            <div class="mb-4">
                <label class="font-semibold  mb-1 block">Cell density</label>
                <div class=" px-3 py-1 border border-blue-100">
                    <span id="cell_density_formatted" class="font-semibold">1.00 x 10⁶</span>
                    cells/mL
                </div>
            </div>

            <!-- Required number of cells - Improve grid for mobile -->
            <div class="mb-4">
                <label class="font-semibold  mb-1 block">Required number of cells</label>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">
                    <div class=" px-3 py-1 border border-blue-100 ">
                        <p class="mb-1">Total</p>
                        <span id="required_cells_total_formatted" class="text-md font-semibold">1.10 x 10⁶</span>
                        cells
                    </div>
                    <div class=" px-3 py-1 border border-blue-100 ">
                        <p class="mb-1">per well</p>
                        <span id="cells_per_well_formatted" class="text-md font-semibold">9,600</span> cells
                    </div>
                </div>
            </div>

            <div id="warnings" class="hidden text-sm border border-[#d4dbe6] px-4 py-3 mb-4">
                <div class="flex justify-between text-orange-700">
                    <svg class="h-5 w-5 text-orange-500 mr-2 flex-shrink-0" viewBox="0 0 24 24" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 11c-.55 0-1-.45-1-1V8c0-.55.45-1 1-1s1 .45 1 1v4c0 .55-.45 1-1 1zm1 4h-2v-2h2v2z" />
                    </svg>
                </div>
            </div>

            <!-- Download buttons for results -->
            <div id="downloadOptions" class="hidden mt-4 !space-y-2">
                <button id="downloadExcel"
                    class="w-full px-4 py-[9px] text-sm !cursor-pointer bg-gray-200 hover:bg-gray-300 text-gray-800 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    Download as Excel
                </button>
                <button id="downloadPdf"
                    class="w-full px-4 py-[9px] text-sm btn-grad text-white flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 10v6m0 0l-3-3m3 3l3-3M3 17V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z" />
                    </svg>
                    Download as PDF
                </button>
            </div>
        </div>
    </div>
</div>
