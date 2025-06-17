{{-- home.blade.php --}}
@extends('layouts.app')

@section('content')
    {{-- Home Page --}}
    <div class="flex flex-col md:flex-row mt-4 md:mt-0 justify-between gap-4 mb-[40px]">
        <!-- Main Calculator Form -->
        <div
            class="md:w-[75%] w-full table-container bg-[#f3f5f9] px-5 pt-1 justify-between pb-10 mx-auto flex-grow flex flex-col">
            <div>
                <!-- Cell Stock Volume - Improve responsive layout -->
                <div class="flex flex-col sm:flex-row md:items-center border-b-2 border-white py-2">
                    <label for="suspension_volume" class="font-semibold w-full sm:w-64  flex items-center sm:mb-0">
                        Cell stock volume <span class="text-black">*</span>
                        <span class="tooltip-container cursor-help">
                            <svg xmlns="http://www.w3.org/2000/svg" width="1rem" height="1rem" viewBox="0,0,256,256">
                                <g fill="#6d7e93" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt"
                                    stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0"
                                    font-family="none" font-weight="none" font-size="none" text-anchor="none"
                                    style="mix-blend-mode: normal">
                                    <g transform="scale(5.12,5.12)">
                                        <path
                                            d="M25,2c-12.703,0 -23,10.297 -23,23c0,12.703 10.297,23 23,23c12.703,0 23,-10.297 23,-23c0,-12.703 -10.297,-23 -23,-23zM25,11c1.657,0 3,1.343 3,3c0,1.657 -1.343,3 -3,3c-1.657,0 -3,-1.343 -3,-3c0,-1.657 1.343,-3 3,-3zM29,38h-2h-4h-2v-2h2v-13h-2v-2h2h4v2v13h2z">
                                        </path>
                                    </g>
                                </g>
                            </svg>
                            <div class="custom-tooltip">
                                <div class="flex justify-between items-start space-x-1">
                                    <div>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="1rem" height="1rem"
                                            viewBox="0,0,256,256">
                                            <g fill="#6d7e93" fill-rule="nonzero" stroke="none" stroke-width="1"
                                                stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10"
                                                stroke-dasharray="" stroke-dashoffset="0" font-family="none"
                                                font-weight="none" font-size="none" text-anchor="none"
                                                style="mix-blend-mode: normal">
                                                <g transform="scale(5.12,5.12)">
                                                    <path
                                                        d="M25,2c-12.703,0 -23,10.297 -23,23c0,12.703 10.297,23 23,23c12.703,0 23,-10.297 23,-23c0,-12.703 -10.297,-23 -23,-23zM25,11c1.657,0 3,1.343 3,3c0,1.657 -1.343,3 -3,3c-1.657,0 -3,-1.343 -3,-3c0,-1.657 1.343,-3 3,-3zM29,38h-2h-4h-2v-2h2v-13h-2v-2h2h4v2v13h2z">
                                                    </path>
                                                </g>
                                            </g>
                                        </svg>
                                    </div>
                                    <div class="flex items-start">
                                        <p> Please refer to the ioCELL user manual for your cell type for guidance on
                                            thawing and recommended initial suspension volume.</p>
                                        <button type="button" class=" text-[#96a5b8]">
                                            <svg class="tooltip-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M6 18L18 6M6 6l12 12"></path>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </span>
                    </label>
                    <div class="flex items-center flex-1">
                        <input id="suspension_volume" type="number" step="0.01" value="1"
                            class="pl-3 w-28 bg-white text-right border px-2 md:px-0 border-[#d3dbe6] focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        <span class="ml-2 text-sm ">mL</span>
                    </div>
                </div>

                <!-- Live Cell Count - Improve responsive layout -->
                <div class="flex flex-col md:flex-row items-start border-b-2 border-white py-2">
                    <label class="font-semibold w-full sm:w-64 flex items-center md:mb-2">
                        Live cell count
                        <span class="tooltip-container  cursor-help">
                            <svg xmlns="http://www.w3.org/2000/svg" width="1rem" height="1rem" viewBox="0,0,256,256">
                                <g fill="#6d7e93" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt"
                                    stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0"
                                    font-family="none" font-weight="none" font-size="none" text-anchor="none"
                                    style="mix-blend-mode: normal">
                                    <g transform="scale(5.12,5.12)">
                                        <path
                                            d="M25,2c-12.703,0 -23,10.297 -23,23c0,12.703 10.297,23 23,23c12.703,0 23,-10.297 23,-23c0,-12.703 -10.297,-23 -23,-23zM25,11c1.657,0 3,1.343 3,3c0,1.657 -1.343,3 -3,3c-1.657,0 -3,-1.343 -3,-3c0,-1.657 1.343,-3 3,-3zM29,38h-2h-4h-2v-2h2v-13h-2v-2h2h4v2v13h2z">
                                        </path>
                                    </g>
                                </g>
                            </svg>
                            <div class="custom-tooltip">
                                <div class="flex justify-between items-start space-x-1">
                                    <div>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="1rem" height="1rem"
                                            viewBox="0,0,256,256">
                                            <g fill="#6d7e93" fill-rule="nonzero" stroke="none" stroke-width="1"
                                                stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10"
                                                stroke-dasharray="" stroke-dashoffset="0" font-family="none"
                                                font-weight="none" font-size="none" text-anchor="none"
                                                style="mix-blend-mode: normal">
                                                <g transform="scale(5.12,5.12)">
                                                    <path
                                                        d="M25,2c-12.703,0 -23,10.297 -23,23c0,12.703 10.297,23 23,23c12.703,0 23,-10.297 23,-23c0,-12.703 -10.297,-23 -23,-23zM25,11c1.657,0 3,1.343 3,3c0,1.657 -1.343,3 -3,3c-1.657,0 -3,-1.343 -3,-3c0,-1.657 1.343,-3 3,-3zM29,38h-2h-4h-2v-2h2v-13h-2v-2h2h4v2v13h2z">
                                                    </path>
                                                </g>
                                            </g>
                                        </svg>
                                    </div>
                                    <div class="flex items-start">
                                        <p>
                                            Please count the number of cells using a viability marker. We recommend
                                            performing
                                            the
                                            count in triplicate. The calculator will automatically calculate the average
                                            value.
                                            If
                                            you have an outlier, best practice is to re-suspend the cells carefully and
                                            repeat
                                            the
                                            triplicate count from the beginning. Please do not enter the number of dead
                                            cells,
                                            the
                                            value should reflect the viable number of cells only.
                                        </p>
                                        <button type="button" class=" text-[#96a5b8]">
                                            <svg class="tooltip-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M6 18L18 6M6 6l12 12"></path>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </span>
                    </label>
                    <div class="flex-1 w-full md:relative">
                        <div class="flex grid-cols-3 md:grid-cols-4 gap-6 items-center">
                            <div>
                                <div class="mb-1">Count 1<span class="text-black">*</span></div>
                                <input id="count1" type="text" inputmode="decimal" pattern="[0-9]*[.,]?[0-9]*" required
                                    class="px-2 pt-1 pb-1 w-28 bg-white border border-[#d3dbe6] focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                <div class="mt-1 flex md:hidden symbol  items-center justify-start">x 10<sup>6</sup>
                                    cells/mL</div>
                            </div>
                            <div>
                                <div class="mb-1">Count 2</div>
                                <input id="count2" type="text" inputmode="decimal" pattern="[0-9]*[.,]?[0-9]*"
                                    class="px-3 w-28 bg-white border border-[#d3dbe6] focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                <div class="mt-1 flex md:hidden symbol items-center justify-start">x 10<sup>6</sup>
                                    cells/mL
                                </div>
                            </div>
                            <div>
                                <div class="mb-1">Count 3</div>
                                <input id="count3" type="text" inputmode="decimal" pattern="[0-9]*[.,]?[0-9]*"
                                    class="px-3 w-28 bg-white border border-[#d3dbe6] focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                <div class="mt-1 flex md:hidden symbol items-center justify-start">x 10<sup>6</sup>
                                    cells/mL
                                </div>
                            </div>
                            <div class="text-sm mt-4 hidden -ml-1.5 md:flex items-center justify-start">x 10<sup>6</sup>
                                cells/mL</div>
                        </div>
                        <div id="cellCountWarning" class="hidden">
                            <div
                                class="flex justify-between items-start md:absolute md:z-[999] md:-top-7 left-[82%] mt-2 p-2 border-2 border-[#d4dbe6] bg-white md:w-2/4">
                                <div class="flex justify-between text-orange-700">
                                    <svg class="h-5 w-5 text-orange-500 mr-2 flex-shrink-0" viewBox="0 0 24 24"
                                        fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 11c-.55 0-1-.45-1-1V8c0-.55.45-1 1-1s1 .45 1 1v4c0 .55-.45 1-1 1zm1 4h-2v-2h2v2z">
                                        </path>
                                    </svg>
                                </div>
                                <p class="text-sm">
                                    The variability in your live cell count exceeds 10%, we recommend that you re-suspend
                                    your cell suspension and perform a recount.
                                </p>
                                <button type="button" class=" text-[#96a5b8]"
                                    onclick="document.getElementById('cellCountWarning').classList.add('hidden')">
                                    <svg class="tooltip-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- Cell Viability - Improve responsive layout -->
                <div class="flex flex-col sm:flex-row items-start border-b-2 border-white py-2">
                    <label class="font-semibold w-full sm:w-64 flex items-center md:mb-2">Cell
                        viability</label>
                    <div class="flex-1 w-full md:relative">
                        <div class="flex grid-cols-3 md:grid-cols-4 gap-6 items-center">
                            <div class="xs:flex xs:flex-col xs:items-end">
                                <div class="mb-1">Count 1<span class="text-black">*</span></div>
                                <input id="viability1" type="number" step="0.1" value="100"
                                    class="px-2 pt-1 pb-1 w-28 text-sm bg-white border border-[#d3dbe6] focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                <div class="text-sm md:hidden symbol text-right flex items-center justify-end">
                                    %</div>
                            </div>
                            <div class="xs:flex xs:flex-col xs:items-end">
                                <div class="mb-1">Count 2</div>
                                <input id="viability2" type="number" step="0.1"
                                    class="px-2 pt-1 pb-1 w-28 text-sm pr-1 bg-white border border-[#d3dbe6] focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                <div class="text-sm md:hidden symbol text-right flex items-center justify-end">
                                    %</div>
                            </div>
                            <div class="xs:flex xs:flex-col xs:items-end">
                                <div class="mb-1">Count 3</div>
                                <input id="viability3" type="number" step="0.1"
                                    class="px-2 pt-1 pb-1 text-sm pr-1 w-28 bg-white border border-[#d3dbe6] focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                <div class="text-sm md:hidden symbol text-right flex items-center justify-end">
                                    %</div>
                            </div>
                            <div class="text-sm hidden text-left mt-4 md:flex items-center justify-start -ml-1.5">
                                %</div>
                        </div>
                        <div id="viabilityWarning" class="hidden">
                            <div
                                class="flex justify-between items-start md:absolute md:z-[999] md:top-7 left-[82%] mt-2 p-2 border-2 border-[#d4dbe6] bg-white md:w-2/4">
                                <div class="flex justify-between text-orange-700">
                                    <svg class="h-5 w-5 text-orange-500 mr-2 flex-shrink-0" viewBox="0 0 24 24"
                                        fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 11c-.55 0-1-.45-1-1V8c0-.55.45-1 1-1s1 .45 1 1v4c0 .55-.45 1-1 1zm1 4h-2v-2h2v2z" />
                                    </svg>
                                </div>
                                <p class="text-sm">
                                    If there is high variability in your cell viability percentage, or if this value is
                                    below 80%, we recommend that you re-suspend your cell suspension and perform a recount.
                                </p>
                                <button type="button" class=" text-[#96a5b8]"
                                    onclick="document.getElementById('viabilityWarning').classList.add('hidden')">
                                    <svg class="tooltip-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Cell Type - Improve responsive layout with Semantic UI -->
                <div class="flex flex-col sm:flex-row items-start border-b-2 border-white py-2">
                    <label for="cell_type" class="font-semibold w-full sm:w-64 flex items-center mb-2 sm:mb-0">Cell
                        type</label>
                    <div class="flex-1 relative w-full">
                        <div class="ui fluid search selection dropdown searchable-input" id="cell_type_dropdown">
                            <input type="hidden" id="cell_type">
                            <i class="dropdown icon"></i>
                            <div class="default text">--Select your cell type--</div>
                            <div class="menu">
                                <!-- Options will be populated by JS -->
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Seeding Density - Improve responsive layout -->
                <div class="flex flex-col sm:flex-row items-start border-b-2 border-white py-2">
                    <label for="seeding_density" class="font-semibold w-full sm:w-64  flex items-center mb-2 sm:mb-0">
                        Seeding density <span class="text-black">*</span>
                        <span class="ml-1 tooltip-container  cursor-help">
                            <svg xmlns="http://www.w3.org/2000/svg" width="1rem" height="1rem" viewBox="0,0,256,256">
                                <g fill="#6d7e93" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt"
                                    stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0"
                                    font-family="none" font-weight="none" font-size="none" text-anchor="none"
                                    style="mix-blend-mode: normal">
                                    <g transform="scale(5.12,5.12)">
                                        <path
                                            d="M25,2c-12.703,0 -23,10.297 -23,23c0,12.703 10.297,23 23,23c12.703,0 23,-10.297 23,-23c0,-12.703 -10.297,-23 -23,-23zM25,11c1.657,0 3,1.343 3,3c0,1.657 -1.343,3 -3,3c-1.657,0 -3,-1.343 -3,-3c0,-1.657 1.343,-3 3,-3zM29,38h-2h-4h-2v-2h2v-13h-2v-2h2h4v2v13h2z">
                                        </path>
                                    </g>
                                </g>
                            </svg>
                            <div class="custom-tooltip">
                                <div class="flex justify-between items-start space-x-1">
                                    <div>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="1rem" height="1rem"
                                            viewBox="0,0,256,256">
                                            <g fill="#6d7e93" fill-rule="nonzero" stroke="none" stroke-width="1"
                                                stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10"
                                                stroke-dasharray="" stroke-dashoffset="0" font-family="none"
                                                font-weight="none" font-size="none" text-anchor="none"
                                                style="mix-blend-mode: normal">
                                                <g transform="scale(5.12,5.12)">
                                                    <path
                                                        d="M25,2c-12.703,0 -23,10.297 -23,23c0,12.703 10.297,23 23,23c12.703,0 23,-10.297 23,-23c0,-12.703 -10.297,-23 -23,-23zM25,11c1.657,0 3,1.343 3,3c0,1.657 -1.343,3 -3,3c-1.657,0 -3,-1.343 -3,-3c0,-1.657 1.343,-3 3,-3zM29,38h-2h-4h-2v-2h2v-13h-2v-2h2h4v2v13h2z">
                                                    </path>
                                                </g>
                                            </g>
                                        </svg>
                                    </div>
                                    <div class="flex items-start">
                                        <p> Please note that the default seeding density has been optimized by bit.bio for
                                            ioCELL.
                                            Changing this value may impact performance. Consider what is needed based on
                                            your
                                            assay
                                            or application.</p>
                                        <button type="button" class=" text-[#96a5b8]">
                                            <svg class="tooltip-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M6 18L18 6M6 6l12 12"></path>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </span>
                    </label>
                    <div class="flex items-center flex-1">
                        <input id="seeding_density" type="number"
                            class="w-28 bg-white border border-[#d3dbe6] focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        <span class="ml-2 text-sm ">cells/cm²</span>
                    </div>
                </div>

                <!-- Culture Vessel - Improve responsive layout with Semantic UI -->
                <div class="flex flex-col sm:flex-row items-start border-b-2 border-white py-2">
                    <label for="culture_vessel" class="font-semibold w-full sm:w-64 flex items-center mb-2 sm:mb-0">
                        Culture vessel
                        <span class="ml-1 tooltip-container cursor-help">
                            <svg xmlns="http://www.w3.org/2000/svg" width="1rem" height="1rem" viewBox="0,0,256,256">
                                <g fill="#6d7e93" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt"
                                    stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0"
                                    font-family="none" font-weight="none" font-size="none" text-anchor="none"
                                    style="mix-blend-mode: normal">
                                    <g transform="scale(5.12,5.12)">
                                        <path
                                            d="M25,2c-12.703,0 -23,10.297 -23,23c0,12.703 10.297,23 23,23c12.703,0 23,-10.297 23,-23c0,-12.703 -10.297,-23 -23,-23zM25,11c1.657,0 3,1.343 3,3c0,1.657 -1.343,3 -3,3c-1.657,0 -3,-1.343 -3,-3c0,-1.657 1.343,-3 3,-3zM29,38h-2h-4h-2v-2h2v-13h-2v-2h2h4v2v13h2z">
                                        </path>
                                    </g>
                                </g>
                            </svg>
                            <div class="custom-tooltip">
                                <div class="flex justify-between items-start space-x-1">
                                    <div>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="1rem" height="1rem"
                                            viewBox="0,0,256,256">
                                            <g fill="#6d7e93" fill-rule="nonzero" stroke="none" stroke-width="1"
                                                stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10"
                                                stroke-dasharray="" stroke-dashoffset="0" font-family="none"
                                                font-weight="none" font-size="none" text-anchor="none"
                                                style="mix-blend-mode: normal">
                                                <g transform="scale(5.12,5.12)">
                                                    <path
                                                        d="M25,2c-12.703,0 -23,10.297 -23,23c0,12.703 10.297,23 23,23c12.703,0 23,-10.297 23,-23c0,-12.703 -10.297,-23 -23,-23zM25,11c1.657,0 3,1.343 3,3c0,1.657 -1.343,3 -3,3c-1.657,0 -3,-1.343 -3,-3c0,-1.657 1.343,-3 3,-3zM29,38h-2h-4h-2v-2h2v-13h-2v-2h2h4v2v13h2z">
                                                    </path>
                                                </g>
                                            </g>
                                        </svg>
                                    </div>
                                    <div class="flex items-start">
                                        <p>
                                            Please select the appropriate culture vessel for your experimental setup. The
                                            options
                                            and values provided are for reference only based on the most widely used
                                            formats—be
                                            sure
                                            to confirm them and adjust surface area and volume according to the supplier's
                                            recommendations.
                                        </p>
                                        <button type="button" class=" text-[#96a5b8]">
                                            <svg class="tooltip-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M6 18L18 6M6 6l12 12"></path>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </span>
                    </label>
                    <div class="flex-1 relative w-full">
                        <div class="ui fluid search selection dropdown" id="culture_vessel_dropdown">
                            <input type="hidden" id="culture_vessel">
                            <i class="dropdown icon"></i>
                            <div class="default text">--Select your culture vessel--</div>
                            <div class="menu">
                                <!-- Options will be populated by JS -->
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Surface Area - Improve responsive layout -->
                <div class="flex flex-col sm:flex-row items-center border-b-2 border-white py-2">
                    <label for="surface_area" class="font-semibold w-full sm:w-64  flex items-center mb-2 sm:mb-0">
                        Surface area <span class="text-black">*</span>
                    </label>
                    <div class="flex items-center flex-1 w-full">
                        <input id="surface_area" type="number" step="0.01"
                            class="w-28 bg-white text-right border border-[#d3dbe6] px-2 md:px-0-[#d3dbe6] focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        <span class="ml-2 text-sm ">cm²/well</span>
                    </div>
                </div>

                <!-- Media Volume - Improve responsive layout -->
                <div class="flex flex-col sm:flex-row items-center border-b-2 border-white py-2">
                    <label for="media_volume" class="font-semibold w-full sm:w-64  flex items-center mb-2 sm:mb-0">
                        Volume <span class="text-black">*</span>
                    </label>
                    <div class="flex items-center flex-1 w-full">
                        <input id="media_volume" type="number" step="0.01"
                            class=" w-28 bg-white border border-[#d3dbe6] text-right px-2 md:px-0-[#d3dbe6] focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        <span class="ml-2 text-sm ">mL/well</span>
                    </div>
                </div>

                <!-- Number of Wells - Improve responsive layout -->
                <div class="flex flex-col sm:flex-row items-center border-b-2 border-white py-2">
                    <label for="num_wells" class="font-semibold w-full sm:w-64  flex items-center mb-2 sm:mb-0">
                        Number of wells to seed <span class="text-black">*</span>
                    </label>
                    <div class="flex items-center flex-1 w-full">
                        <input id="num_wells" type="number" value="96"
                            class="w-28 bg-white text-right border px-2 border-[#d3dbe6] md:px-0-[#d3dbe6] focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        <span class="ml-2 text-sm ">wells</span>
                    </div>
                </div>

                <!-- Dead Volume Allowance - Improve responsive layout -->
                <div class="md:mb-1 flex flex-col sm:flex-row items-start py-2 pb-0">
                    <label for="buffer" class="font-semibold w-full sm:w-64  flex items-center mb-2 sm:mb-0">
                        Dead volume allowance
                        <span class="ml-1 tooltip-container  cursor-help">
                            <svg xmlns="http://www.w3.org/2000/svg" width="1rem" height="1rem" viewBox="0,0,256,256">
                                <g fill="#6d7e93" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt"
                                    stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0"
                                    font-family="none" font-weight="none" font-size="none" text-anchor="none"
                                    style="mix-blend-mode: normal">
                                    <g transform="scale(5.12,5.12)">
                                        <path
                                            d="M25,2c-12.703,0 -23,10.297 -23,23c0,12.703 10.297,23 23,23c12.703,0 23,-10.297 23,-23c0,-12.703 -10.297,-23 -23,-23zM25,11c1.657,0 3,1.343 3,3c0,1.657 -1.343,3 -3,3c-1.657,0 -3,-1.343 -3,-3c0,-1.657 1.343,-3 3,-3zM29,38h-2h-4h-2v-2h2v-13h-2v-2h2h4v2v13h2z">
                                        </path>
                                    </g>
                                </g>
                            </svg>
                            <div class="custom-tooltip">
                                <div class="flex justify-between items-start space-x-1">
                                    <div>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="1rem" height="1rem"
                                            viewBox="0,0,256,256">
                                            <g fill="#6d7e93" fill-rule="nonzero" stroke="none" stroke-width="1"
                                                stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10"
                                                stroke-dasharray="" stroke-dashoffset="0" font-family="none"
                                                font-weight="none" font-size="none" text-anchor="none"
                                                style="mix-blend-mode: normal">
                                                <g transform="scale(5.12,5.12)">
                                                    <path
                                                        d="M25,2c-12.703,0 -23,10.297 -23,23c0,12.703 10.297,23 23,23c12.703,0 23,-10.297 23,-23c0,-12.703 -10.297,-23 -23,-23zM25,11c1.657,0 3,1.343 3,3c0,1.657 -1.343,3 -3,3c-1.657,0 -3,-1.343 -3,-3c0,-1.657 1.343,-3 3,-3zM29,38h-2h-4h-2v-2h2v-13h-2v-2h2h4v2v13h2z">
                                                    </path>
                                                </g>
                                            </g>
                                        </svg>
                                    </div>
                                    <div class="flex items-start">
                                        <p>
                                            Include contingency (typically 10–20%) to account for dead volume. If unsure on
                                            what values to use, you can also change this value to what you'd recommend
                                            adding a few extra wells.
                                        </p>
                                        <button type="button" class=" text-[#96a5b8]">
                                            <svg class="tooltip-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M6 18L18 6M6 6l12 12"></path>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </span>
                    </label>
                    <div class="flex items-center flex-1 w-full">
                        <input id="buffer" type="number" step="0.1" value="10"
                            class="w-28 bg-white text-right border border-[#d3dbe6] px-2 md:px-0-[#d3dbe6] focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        <span class="ml-2 text-sm text-left ">%</span>
                    </div>
                </div>
            </div>

            <div>
                <p class="text-sm block md:hidden">* Required field</p>
                <!-- Calculate Button - Improve responsive layout -->
                <div class="mt-6 flex flex-col md:flex-row items-end justify-between gap-3">
                    <p class="text-[12px] hidden md:block relative -bottom-5">* Required field</p>
                    <div class="md:w-auto w-full">
                        <button id="calculateBtn"
                            class="btn-grad text-sm w-full sm:w-60 text-white px-4 py-[12px] transition">
                            Calculate results
                        </button>
                        <div id="actionButtons" class="hidden w-full">
                            <div class="flex flex-col-reverse sm:flex-row gap-2 mt-2 md:w-100">
                                <button id="resetBtn" class="bg-[#d6dce5] px-4 py-[12px] w-full">
                                    Reset
                                </button>
                                <button id="recalculateBtn" class="btn-grad text-white px-4 py-[12px] w-full">
                                    Recalculate
                                </button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <x-ResultSection />
    </div>
    <x-UsefulResources />
@endsection
