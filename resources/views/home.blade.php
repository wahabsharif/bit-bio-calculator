{{-- home.blade.php --}}
@extends('layouts.app')

@section('content')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/semantic-ui@2.4.2/dist/semantic.min.css">
    <script src="https://cdn.jsdelivr.net/npm/semantic-ui@2.4.2/dist/semantic.min.js"></script>
    {{-- Home Page --}}
    <div class="flex flex-col md:flex-row mt-4 md:mt-0 justify-between gap-4 mb-[40px]">
        <!-- Main Calculator Form -->
        <div class="md:w-[75%] w-full bg-[#f3f5f9] px-5 pt-1 justify-between pb-10 mx-auto flex-grow flex flex-col">
            <div>
                <!-- Cell Stock Volume - Improve responsive layout -->
                <div class="flex flex-col pb-[14px] md:pb-0 sm:flex-row md:items-center border-b-2 border-white py-2">
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
                                    <div class="flex-grow">
                                        Please refer to the ioCELL user manual for your cell type for guidance on thawing
                                        and
                                        recommended initial suspension volume.
                                    </div>
                                </div>
                            </div>
                        </span>
                    </label>
                    <div class="flex items-center flex-1">
                        <input id="suspension_volume" type="number" step="0.01" value="1"
                            class="pl-3 w-28 bg-white text-right border px-2 md:px-0 border-[#d3dbe6] focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        <span class="ml-2 md:text-sm text-xs">mL</span>
                    </div>
                </div>

                <!-- Live Cell Count - Improve responsive layout -->
                <div class="flex flex-col pb-[14px] md:pb-0 md:flex-row items-start border-b-2 border-white py-2">
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
                                    <div class="flex-grow">
                                        Please count the number of cells using a viability marker. We recommend performing
                                        the
                                        count in triplicate. The calculator will automatically calculate the average value.
                                        If
                                        you have an outlier, best practice is to re-suspend the cells carefully and repeat
                                        the
                                        triplicate count from the beginning. Please do not enter the number of dead cells,
                                        the
                                        value should reflect the viable number of cells only.
                                    </div>
                                </div>
                            </div>
                        </span>
                    </label>
                    <div class="flex-1 w-full md:relative">
                        <div class="flex grid-cols-3 md:grid-cols-4 gap-6 items-center">
                            <div>
                                <div class="mb-1">Count 1<span class="text-black">*</span></div>
                                <input id="count1" type="number" required
                                    class="px-2 pt-1 pb-1 w-28 bg-white border border-[#d3dbe6] focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                <div class="mt-1 flex md:hidden text-sm items-center justify-start">x
                                    10<sup>6</sup> cells/mL</div>
                            </div>
                            <div>
                                <div class="mb-1">Count 2</div>
                                <input id="count2" type="number"
                                    class="px-3 w-28 bg-white border border-[#d3dbe6] focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                <div class="mt-1 flex md:hidden text-sm items-center justify-start">x
                                    10<sup>6</sup> cells/mL</div>
                            </div>
                            <div>
                                <div class="mb-1">Count 3</div>
                                <input id="count3" type="number"
                                    class="px-3 w-28 bg-white border border-[#d3dbe6] focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                <div class="mt-1 flex md:hidden text-sm items-center justify-start">x
                                    10<sup>6</sup> cells/mL</div>
                            </div>
                            <div class="text-sm mt-4 hidden -ml-1.5 md:flex items-center justify-start">x
                                10<sup>6</sup> cells/mL</div>
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
                                    If there is significant variability in your live cell count, we recommend that you
                                    re-suspend your cell suspension and perform a recount.
                                </p>
                                <button type="button" class="ml-auto text-[#96a5b8]"
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
                <div class="flex flex-col pb-[14px] md:pb-0 sm:flex-row items-start border-b-2 border-white py-2">
                    <label class="font-semibold w-full sm:w-64 flex items-center md:mb-2">Cell
                        viability</label>
                    <div class="flex-1 w-full md:relative">
                        <div class="flex grid-cols-3 md:grid-cols-4 gap-6 items-center">
                            <div class="xs:flex xs:flex-col xs:items-end">
                                <div class="mb-1">Count 1<span class="text-black">*</span></div>
                                <input id="viability1" type="number" step="0.1" value="100"
                                    class="px-2 pt-1 pb-1 w-28 text-sm bg-white border border-[#d3dbe6] focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                <div class="text-sm md:hidden text-right flex items-center justify-end">
                                    %</div>
                            </div>
                            <div class="xs:flex xs:flex-col xs:items-end">
                                <div class="mb-1">Count 2</div>
                                <input id="viability2" type="number" step="0.1"
                                    class="px-2 pt-1 pb-1 w-28 text-sm pr-1 bg-white border border-[#d3dbe6] focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                <div class="text-sm md:hidden text-right flex items-center justify-end">
                                    %</div>
                            </div>
                            <div class="xs:flex xs:flex-col xs:items-end">
                                <div class="mb-1">Count 3</div>
                                <input id="viability3" type="number" step="0.1"
                                    class="px-2 pt-1 pb-1 text-sm pr-1 w-28 bg-white border border-[#d3dbe6] focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                <div class="text-sm md:hidden text-right flex items-center justify-end">
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
                                    If there is significant variability in your cell viability percentage, or if this value
                                    is
                                    below 80%, we recommend that you re-suspend your cell suspension and perform a recount.
                                </p>
                                <button type="button" class="ml-auto text-[#96a5b8]"
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
                <div class="flex flex-col pb-[14px] md:pb-0 sm:flex-row items-start border-b-2 border-white py-2">
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
                <div class="flex flex-col pb-[14px] md:pb-0 sm:flex-row items-start border-b-2 border-white py-2">
                    <label for="seeding_density" class="font-semibold w-full sm:w-64  flex items-center mb-2 sm:mb-0">
                        Seeding density <span class="text-black">*</span>
                        <span class="ml-1 tooltip-container  cursor-help">
                            <svg xmlns="http://www.w3.org/2000/svg" width="1rem" height="1rem" viewBox="0,0,256,256">
                                <g fill="#6d7e93" fill-rule="nonzero" stroke="none" stroke-width="1"
                                    stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10"
                                    stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none"
                                    font-size="none" text-anchor="none" style="mix-blend-mode: normal">
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
                                    <div class="flex-grow">
                                        Please note that the default seeding density has been optimized by bit.bio for
                                        ioCELLs.
                                        Changing this value may impact performance. Consider what is needed based on your
                                        assay
                                        or application.
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
                <div class="flex flex-col pb-[14px] md:pb-0 sm:flex-row items-start border-b-2 border-white py-2">
                    <label for="culture_vessel" class="font-semibold w-full sm:w-64 flex items-center mb-2 sm:mb-0">
                        Culture vessel
                        <span class="ml-1 tooltip-container cursor-help">
                            <svg xmlns="http://www.w3.org/2000/svg" width="1rem" height="1rem" viewBox="0,0,256,256">
                                <g fill="#6d7e93" fill-rule="nonzero" stroke="none" stroke-width="1"
                                    stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10"
                                    stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none"
                                    font-size="none" text-anchor="none" style="mix-blend-mode: normal">
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
                                    <div class="flex-grow">
                                        Please select the appropriate culture vessel for your experimental setup. The
                                        options
                                        and values provided are for reference only based on the most widely used formats—be
                                        sure
                                        to confirm them and adjust surface area and volume according to the supplier's
                                        recommendations.
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
                <div class="flex flex-col pb-[14px] md:pb-0 sm:flex-row items-center border-b-2 border-white py-2">
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
                <div class="flex flex-col pb-[14px] md:pb-0 sm:flex-row items-center border-b-2 border-white py-2">
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
                <div class="flex flex-col pb-[14px] md:pb-0 sm:flex-row items-center border-b-2 border-white py-2">
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
                <div class="md:mb-1 flex flex-col pb-[14px] md:pb-0 sm:flex-row items-start py-2">
                    <label for="buffer" class="font-semibold w-full sm:w-64  flex items-center mb-2 sm:mb-0">
                        Dead volume allowance
                        <span class="ml-1 tooltip-container  cursor-help">
                            <svg xmlns="http://www.w3.org/2000/svg" width="1rem" height="1rem" viewBox="0,0,256,256">
                                <g fill="#6d7e93" fill-rule="nonzero" stroke="none" stroke-width="1"
                                    stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10"
                                    stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none"
                                    font-size="none" text-anchor="none" style="mix-blend-mode: normal">
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
                                    <div class="flex-grow">
                                        Include contingency (typically 10–20%) to account for dead volume. If unsure on what
                                        values to use, you can also change this value to what you'd recommend adding a few
                                        extra
                                        wells.
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
                        <div id="validationErrors" class="hidden w-full sm:w-64 my-2 text-red-700"></div>
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

        <!-- Results Section - Always full width on mobile -->
        <div class="md:w-[25%] w-full p-6 bg-[#fdffff] border border-[#d3dbe6] flex-grow flex flex-col">

            <div id="results" class="space-y-4">
                <!-- Initial help content shown before calculation -->
                <div id="helpContent">
                    <h3 class="!text-[16px] font-semibold mb-5">How to get started?</h3>
                    <ul class="list-disc pl-5 space-y-3 text-sm font-medium">
                        <li>Start by entering your cell stock volume.</li>
                        <li>Add your cell count and viability. Ideally perform your count three times.</li>
                        <li>Select your cell type and the recommended seeding density will be populated.</li>
                        <li>Choose your vessel format to automatically fill in the surface area and volume.</li>
                        <li>Include a 10-20% dead volume allowance or adjust based on your workflow.</li>
                    </ul>
                </div>

                <!-- Results content hidden initially, shown after calculation -->
                <div id="resultsContent" class="hidden">
                    <h2 class="font-semibold mb-2">Results</h2>
                    <p class="text-sm mb-3">Your results for seeding of <span id="wellCount">XYZ</span> wells</p>

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
                        <label class="font-semibold  mb-1 block">Add <span id="volume_plate_perwell_simple">XYZ</span> μL
                            of the final dilution to each well</label>
                        <p class="mt-1">Review the values below and adjust if needed for your
                            experiment</p>
                    </div>

                    <div class="mb-4">
                        <label class="font-semibold  mb-1 block">Cell density</label>
                        <div class=" px-3 py-1 border border-blue-100">
                            <span id="cell_density_formatted" class="font-semibold">1.00 x 10<sup>6</sup></span>
                            cells/mL
                        </div>
                    </div>

                    <!-- Required number of cells - Improve grid for mobile -->
                    <div class="mb-4">
                        <label class="font-semibold  mb-1 block">Required number of cells</label>
                        <div class="grid grid-cols-2 gap-2">
                            <div>
                                <p class="mb-1">Total</p>
                                <div class=" px-3 py-1 border border-blue-100 ">
                                    <span id="required_cells_total_formatted" class="text-md font-semibold">1.10 x
                                        10<sup>6</sup></span> cells
                                </div>
                            </div>
                            <div>
                                <p class="mb-1">per well</p>
                                <div class=" px-3 py-1 border border-blue-100 ">
                                    <span id="cells_per_well_formatted" class="text-md font-semibold">9,600</span> cells
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="warnings" class="hidden text-sm border border-[#d4dbe6] px-4 py-3 mb-4">
                        <div class="flex justify-between text-orange-700">
                            <svg class="h-5 w-5 text-orange-500 mr-2 flex-shrink-0" viewBox="0 0 24 24"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 11c-.55 0-1-.45-1-1V8c0-.55.45-1 1-1s1 .45 1 1v4c0 .55-.45 1-1 1zm1 4h-2v-2h2v2z" />
                            </svg>
                        </div>
                    </div>

                    <!-- Download buttons for results -->
                    <div id="downloadOptions" class="hidden mt-4 !space-y-2">
                        <button id="downloadExcel"
                            class="w-full px-4 py-2 text-sm !cursor-pointer bg-gray-200 hover:bg-gray-300 text-gray-800 flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            Download as Excel
                        </button>
                        <button id="downloadPdf"
                            class="w-full px-4 py-2 text-sm btn-grad text-white flex items-center justify-center">
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
            const surfaceAreaInput = document.getElementById('surface_area');
            const mediaVolumeInput = document.getElementById('media_volume');
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
                // Get Semantic UI dropdown
                const dropdown = $('#cell_type_dropdown');
                // Clear existing options
                dropdown.dropdown('clear');

                // Add options to the menu
                const menu = dropdown.find('.menu');
                menu.empty();

                types.forEach(type => {
                    const opt = document.createElement('div');
                    opt.className = 'item';
                    opt.setAttribute('data-value', type.id);
                    opt.setAttribute('data-seeding-density', type.seeding_density || '');
                    opt.textContent = `${type.product_name} (${type.sku})`;
                    menu.append(opt);
                });

                // Initialize dropdown
                dropdown.dropdown({
                    onChange: function(value, text, $selectedItem) {
                        if (value && $selectedItem && $selectedItem.attr('data-seeding-density')) {
                            seedingInput.value = $selectedItem.attr('data-seeding-density');
                            seedingInput.classList.add('default-input');
                            seedingInput.classList.remove('active-input');
                        } else {
                            seedingInput.value = '';
                        }
                    }
                });
            }

            function populateCultureVessels(vessels) {
                // Get Semantic UI dropdown
                const dropdown = $('#culture_vessel_dropdown');
                // Clear existing options
                dropdown.dropdown('clear');

                // Add options to the menu
                const menu = dropdown.find('.menu');
                menu.empty();

                vessels.forEach((v, i) => {
                    const opt = document.createElement('div');
                    opt.className = 'item';
                    opt.setAttribute('data-value', v.id);
                    opt.setAttribute('data-surface-area', v.surface_area_cm2);
                    opt.setAttribute('data-media-volume', v.media_volume_per_well_ml);
                    opt.textContent = v.plate_format;
                    menu.append(opt);
                });

                // Initialize dropdown
                dropdown.dropdown({
                    onChange: function(value, text, $selectedItem) {
                        if (value && $selectedItem) {
                            const surfaceArea = $selectedItem.attr('data-surface-area');
                            const mediaVolume = $selectedItem.attr('data-media-volume');

                            if (surfaceArea !== 'null') {
                                surfaceAreaInput.value = surfaceArea;
                                surfaceAreaInput.classList.add('default-input');
                                surfaceAreaInput.classList.remove('active-input');
                            } else {
                                surfaceAreaInput.value = '';
                            }

                            if (mediaVolume !== 'null') {
                                mediaVolumeInput.value = mediaVolume;
                                mediaVolumeInput.classList.add('default-input');
                                mediaVolumeInput.classList.remove('active-input');
                            } else {
                                mediaVolumeInput.value = '';
                            }
                        } else {
                            surfaceAreaInput.value = '';
                            mediaVolumeInput.value = '';
                        }
                    }
                });
            }

            // Calculation Logic
            document.getElementById('calculateBtn').addEventListener('click', performCalculation);

            // Update validation to work with Semantic UI dropdowns
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
                    },
                    {
                        id: 'count1',
                        name: 'Live cell Count 1'
                    },
                    {
                        id: 'viability1',
                        name: 'Cell viability Count 1'
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

                        // If it's a hidden input for a dropdown, highlight the dropdown
                        if (field.id === 'cell_type') {
                            document.querySelector('#cell_type_dropdown').classList.add('error');
                        } else if (field.id === 'culture_vessel') {
                            document.querySelector('#culture_vessel_dropdown').classList.add('error');
                        }
                    } else {
                        // Remove highlighting if field is filled
                        input.classList.remove('border-red-500');

                        // Remove error class from dropdowns if applicable
                        if (field.id === 'cell_type') {
                            document.querySelector('#cell_type_dropdown').classList.remove('error');
                        } else if (field.id === 'culture_vessel') {
                            document.querySelector('#culture_vessel_dropdown').classList.remove(
                                'error');
                        }
                    }
                });

                return missingFields;
            }

            // Reset functionality
            document.getElementById('resetBtn').addEventListener('click', () => {
                // Reset all inputs to default state
                document.querySelectorAll('input[type="number"], input[type="number"]').forEach(
                    input => {
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
                    warningsArr.push(
                        'Please Note that the number of live cells available is insufficient for your experimental design. Please review your setup and consider adjustments, such as reducing the number of wells used in the experiment.'
                    );
                }
                if (bufferPerc === 0) {
                    warningsArr.push(
                        '⚠️ It is highly recommended to include a buffer to ensure enough cells and media.'
                    );
                }

                if (warningsArr.length) {
                    warningsDiv.innerHTML = warningsArr.map((msg, index) => `<div id="warning-${index}" class="flex justify-between items-start mb-2">
                         <div class="flex justify-between text-orange-700">
                                    <svg class="h-5 w-5 text-orange-500 mr-2 flex-shrink-0" viewBox="0 0 24 24"
                                        fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 11c-.55 0-1-.45-1-1V8c0-.55.45-1 1-1s1 .45 1 1v4c0 .55-.45 1-1 1zm1 4h-2v-2h2v2z" />
                                    </svg>
                                </div>
                                <p class="flex-grow mx-2">${msg}</p>
                                <button type="button" class="ml-auto text-[#96a5b8]" onclick="document.getElementById('warning-${index}').remove()">
                                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </button>
                            </div>`).join('');
                    warningsDiv.classList.remove('hidden');
                } else {
                    warningsDiv.classList.add('hidden');
                }

                // Format numbers for display
                const formatExponential = (num) => {
                    const exp = num.toExponential(2);
                    const parts = exp.split('e+');
                    // Format the coefficient part with commas
                    const coefficient = parseFloat(parts[0]).toLocaleString(undefined, {
                        minimumFractionDigits: 2,
                        maximumFractionDigits: 2
                    });
                    return `${coefficient} x 10<sup>${parts[1]}</sup>`;
                };

                // Display results in the side panel
                document.getElementById('wellCount').textContent = wells.toLocaleString();
                document.getElementById('volume_to_dilute').textContent = volDilute.toLocaleString(undefined, {
                    minimumFractionDigits: 2,
                    maximumFractionDigits: 2
                });
                document.getElementById('volume_to_seed').textContent = volToSeed.toLocaleString(undefined, {
                    minimumFractionDigits: 2,
                    maximumFractionDigits: 2
                });
                document.getElementById('volume_plate_perwell_simple').textContent = (volPlatePerWell * 1000)
                    .toLocaleString(undefined, {
                        maximumFractionDigits: 0
                    });
                document.getElementById('cell_density_formatted').innerHTML = formatExponential(cellDensity);
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

                if (cellsPerWell !== undefined) {
                    document.getElementById('cells_per_well_formatted').textContent = cellsPerWell
                        .toLocaleString(undefined, {
                            maximumFractionDigits: 0
                        });
                }

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
                    },
                    {
                        id: 'count1',
                        name: 'Live cell Count 1'
                    },
                    {
                        id: 'viability1',
                        name: 'Cell viability Count 1'
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

                        // If it's a hidden input for a dropdown, highlight the dropdown
                        if (field.id === 'cell_type') {
                            document.querySelector('#cell_type_dropdown').classList.add('error');
                        } else if (field.id === 'culture_vessel') {
                            document.querySelector('#culture_vessel_dropdown').classList.add('error');
                        }
                    } else {
                        // Remove highlighting if field is filled
                        input.classList.remove('border-red-500');

                        // Remove error class from dropdowns if applicable
                        if (field.id === 'cell_type') {
                            document.querySelector('#cell_type_dropdown').classList.remove('error');
                        } else if (field.id === 'culture_vessel') {
                            document.querySelector('#culture_vessel_dropdown').classList.remove(
                                'error');
                        }
                    }
                });

                return missingFields;
            }

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
            const avgCount = counts.length > 0 ?
                parseFloat((counts.reduce((a, b) => a + b, 0) / counts.length).toFixed(2)).toLocaleString(undefined, {
                    minimumFractionDigits: 2,
                    maximumFractionDigits: 2
                }) : '-';

            // Calculate average viability
            const viabilities = [
                parseFloat(viability1El?.value || '0'),
                parseFloat(viability2El?.value || '0'),
                parseFloat(viability3El?.value || '0')
            ].filter(v => v > 0);
            const avgViability = viabilities.length > 0 ?
                parseFloat((viabilities.reduce((a, b) => a + b, 0) / viabilities.length).toFixed(1)).toLocaleString(
                    undefined, {
                        minimumFractionDigits: 1,
                        maximumFractionDigits: 1
                    }) : '-';

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
        };

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
            const avgCount = counts.length > 0 ?
                parseFloat((counts.reduce((a, b) => a + b, 0) / counts.length).toFixed(2)).toLocaleString(undefined, {
                    minimumFractionDigits: 2,
                    maximumFractionDigits: 2
                }) : '-';

            // Calculate average viability
            const viabilities = [
                parseFloat(viability1El?.value || '0'),
                parseFloat(viability2El?.value || '0'),
                parseFloat(viability3El?.value || '0')
            ].filter(v => v > 0);
            const avgViability = viabilities.length > 0 ?
                parseFloat((viabilities.reduce((a, b) => a + b, 0) / viabilities.length).toFixed(1)).toLocaleString(
                    undefined, {
                        minimumFractionDigits: 1,
                        maximumFractionDigits: 1
                    }) : '-';

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
