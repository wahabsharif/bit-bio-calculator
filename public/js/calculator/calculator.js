/**
 * Performs all calculations and updates the UI with results
 */
function performCalculation() {
    // Validate required fields first
    const missingFields = validateRequiredFields();
    const warningsDiv = document.getElementById("warnings");
    const validationErrorsDiv = document.getElementById("validationErrors");
    const helpContent = document.getElementById("helpContent");
    const resultsContent = document.getElementById("resultsContent");

    // Add null checks for all critical elements
    if (!warningsDiv || !helpContent || !resultsContent) {
        console.error("Critical DOM elements not found");
        return;
    }

    // Silently validate - just return without showing error messages if fields are missing
    if (missingFields.length > 0) {
        // Clear any previous validation error messages
        if (validationErrorsDiv) {
            validationErrorsDiv.classList.add("hidden");
            validationErrorsDiv.innerHTML = "";
        }
        return; // Stop execution if validation fails, but don't show any message
    } else if (validationErrorsDiv) {
        validationErrorsDiv.classList.add("hidden");
        validationErrorsDiv.innerHTML = "";
    }

    // Hide help content and show results content
    helpContent.classList.add("hidden");
    resultsContent.classList.remove("hidden");

    // Get button elements with null checks
    const calculateBtn = document.getElementById("calculateBtn");
    const actionButtons = document.getElementById("actionButtons");
    const downloadOptions = document.getElementById("downloadOptions");
    const copyPasteInfo = document.getElementById("copyPasteInfo");

    // Only manipulate elements that exist
    if (calculateBtn) {
        calculateBtn.classList.add("hidden");
    }
    if (actionButtons) {
        actionButtons.classList.remove("hidden");
    }
    if (downloadOptions) {
        downloadOptions.classList.remove("hidden");
    }
    if (copyPasteInfo) {
        copyPasteInfo.classList.remove("hidden");
    }

    // Gather inputs with null checks
    const seedingEl = document.getElementById("seeding_density");
    const wellsEl = document.getElementById("num_wells");
    const areaEl = document.getElementById("surface_area");
    const mediaVolEl = document.getElementById("media_volume");
    const count1El = document.getElementById("count1");
    const count2El = document.getElementById("count2");
    const count3El = document.getElementById("count3");
    const viability1El = document.getElementById("viability1");
    const viability2El = document.getElementById("viability2");
    const viability3El = document.getElementById("viability3");
    const bufferEl = document.getElementById("buffer");
    const suspensionVolEl = document.getElementById("suspension_volume");

    // Check if required elements exist
    if (
        !seedingEl ||
        !wellsEl ||
        !areaEl ||
        !mediaVolEl ||
        !count1El ||
        !viability1El ||
        !bufferEl ||
        !suspensionVolEl
    ) {
        console.error("Required input elements not found");
        return;
    }

    const seeding = parseFloat(seedingEl.value) || 0;
    const wells = parseInt(wellsEl.value) || 0;
    const area = parseFloat(areaEl.value) || 0;
    const mediaVol = parseFloat(mediaVolEl.value) || 0;
    const counts = [
        parseDecimalInput(count1El.value),
        count2El ? parseDecimalInput(count2El.value) : 0,
        count3El ? parseDecimalInput(count3El.value) : 0,
    ];
    const viabilities = [
        parseFloat(viability1El.value) || 0,
        viability2El ? parseFloat(viability2El.value) || 0 : 0,
        viability3El ? parseFloat(viability3El.value) || 0 : 0,
    ];
    const bufferPerc = parseFloat(bufferEl.value) || 0;
    const suspensionVol = parseFloat(suspensionVolEl.value) || 1;

    // Compute averages
    const validCounts = counts.filter((n) => n > 0);
    const validViabilities = viabilities.filter((n) => n > 0);

    if (validCounts.length === 0 || validViabilities.length === 0) {
        console.error("No valid cell counts or viabilities found");
        return;
    }

    const avgCount =
        validCounts.reduce((a, b) => a + b, 0) / validCounts.length;
    const avgViab =
        validViabilities.reduce((a, b) => a + b, 0) / validViabilities.length;

    // Cell density
    const cellDensity = (avgCount * (avgViab / 100)) / suspensionVol;

    // Cells per well & total required
    const cellsPerWell = seeding * area;
    let requiredCells = cellsPerWell * wells;
    requiredCells *= 1 + bufferPerc / 100;

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
            "Please Note that the number of live cells available is insufficient for your experimental design. Please review your setup and consider adjustments, such as reducing the number of wells used in the experiment."
        );
    }
    if (bufferPerc === 0) {
        warningsArr.push(
            "⚠️ It is highly recommended to include a buffer to ensure enough cells and media."
        );
    }

    if (warningsArr.length) {
        warningsDiv.innerHTML = warningsArr
            .map(
                (msg, index) => `
            <div id="warning-${index}" class="flex justify-between no-print items-start mb-2">
                <div class="flex justify-between text-orange-700">
                    <svg class="h-5 w-5 text-orange-500 mr-2 flex-shrink-0" viewBox="0 0 24 24" fill="currentColor">
                        <path fill-rule="evenodd" d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 11c-.55 0-1-.45-1-1V8c0-.55.45-1 1-1s1 .45 1 1v4c0 .55-.45 1-1 1zm1 4h-2v-2h2v2z" />
                    </svg>
                </div>
                <p class="flex-grow mx-2">${msg}</p>
                <button type="button" class="ml-auto text-[#96a5b8]" onclick="document.getElementById('warning-${index}').remove()">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        `
            )
            .join("");
        warningsDiv.classList.remove("hidden");
    } else {
        warningsDiv.classList.add("hidden");
    }

    // Format numbers for display
    const formatExponential = (num) => {
        const exp = num.toExponential(2);
        const parts = exp.split("e+");
        return `${parts[0]} x 10<sup>${parts[1]}</sup>`;
    };

    // Display results in the side panel with null checks
    const wellCountEl = document.getElementById("wellCount");
    const volumeToDiluteEl = document.getElementById("volume_to_dilute");
    const volumeToSeedEl = document.getElementById("volume_to_seed");
    const volumePlatePerWellEl = document.getElementById(
        "volume_plate_perwell_simple"
    );
    const cellDensityFormattedEl = document.getElementById(
        "cell_density_formatted"
    );
    const requiredCellsFormattedEl = document.getElementById(
        "required_cells_total_formatted"
    );
    const cellsPerWellFormattedEl = document.getElementById(
        "cells_per_well_formatted"
    );

    if (wellCountEl) wellCountEl.textContent = wells;
    if (volumeToDiluteEl) volumeToDiluteEl.textContent = volDilute.toFixed(2);
    if (volumeToSeedEl) volumeToSeedEl.textContent = volToSeed.toFixed(2);
    if (volumePlatePerWellEl)
        volumePlatePerWellEl.textContent = (volPlatePerWell * 1000).toFixed(0);
    if (cellDensityFormattedEl)
        cellDensityFormattedEl.innerHTML = formatExponential(cellDensity);
    if (requiredCellsFormattedEl)
        requiredCellsFormattedEl.innerHTML = formatExponential(requiredCells);
    if (cellsPerWellFormattedEl) {
        cellsPerWellFormattedEl.textContent = cellsPerWell.toLocaleString(
            undefined,
            {
                maximumFractionDigits: 0,
            }
        );
    }

    // Mark all inputs used in calculations as active
    const inputsUsedInCalculation = [
        "seeding_density",
        "num_wells",
        "surface_area",
        "media_volume",
        "count1",
        "count2",
        "count3",
        "viability1",
        "viability2",
        "viability3",
        "buffer",
        "suspension_volume",
    ];

    inputsUsedInCalculation.forEach((id) => {
        const input = document.getElementById(id);
        if (input) {
            input.classList.remove("default-input");
            input.classList.add("active-input");
        }
    });

    // Check viability values when calculating
    checkViabilityValues();

    // Check cell count variability when calculating
    checkCellCountVariability();
}
