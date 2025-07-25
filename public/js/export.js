/**
 * Downloads the results as an Excel file using the server
 */
function downloadAsExcel() {
    // Prevent multiple downloads
    if (window.isDownloading) return;
    window.isDownloading = true;

    // Get result data
    const resultData = getResultData();

    // Create a form to submit the data
    const form = document.createElement("form");
    form.method = "POST";
    form.action = "calculator/download-excel";
    form.style.display = "none";

    // Add CSRF token
    const csrfToken = document
        .querySelector('meta[name="csrf-token"]')
        ?.getAttribute("content");

    if (!csrfToken) {
        console.error("CSRF token not found");
        window.isDownloading = false;
        return;
    }

    const csrfInput = document.createElement("input");
    csrfInput.type = "hidden";
    csrfInput.name = "_token";
    csrfInput.value = csrfToken;
    form.appendChild(csrfInput);

    // Add well count
    const wellCountEl = document.getElementById("wellCount");
    const wellCountInput = document.createElement("input");
    wellCountInput.type = "hidden";
    wellCountInput.name = "wellCount";
    wellCountInput.value = wellCountEl ? wellCountEl.textContent || "0" : "0";
    form.appendChild(wellCountInput);

    // Add all result data
    Object.keys(resultData).forEach((key) => {
        const input = document.createElement("input");
        input.type = "hidden";
        input.name = key;
        input.value = resultData[key] || "";
        form.appendChild(input);
    });

    // Detect browser timezone
    let timezone = "UTC";
    try {
        const tz = Intl.DateTimeFormat().resolvedOptions().timeZone;
        if (tz) {
            timezone = tz;
        }
    } catch (e) {
        console.warn("Could not detect timezone, defaulting to UTC", e);
    }
    const tzInput = document.createElement("input");
    tzInput.type = "hidden";
    tzInput.name = "timezone";
    tzInput.value = timezone;
    form.appendChild(tzInput);

    // Submit the form
    document.body.appendChild(form);
    try {
        form.submit();
    } catch (e) {
        console.error("Error submitting form:", e);
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
    const requiredCellsEl = document.getElementById(
        "required_cells_total_formatted"
    );
    const volumeToDiluteEl = document.getElementById("volume_to_dilute");
    const volumeToSeedEl = document.getElementById("volume_to_seed");
    const volumePerWellEl = document.getElementById(
        "volume_plate_perwell_simple"
    );

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
        parseDecimalInput(count1El?.value || "0"),
        parseDecimalInput(count2El?.value || "0"),
        parseDecimalInput(count3El?.value || "0"),
    ].filter((count) => count > 0);
    const avgCount =
        counts.length > 0
            ? (counts.reduce((a, b) => a + b, 0) / counts.length).toFixed(2)
            : "-";

    // Calculate average viability
    const viabilities = [
        parseFloat(viability1El?.value || "0"),
        parseFloat(viability2El?.value || "0"),
        parseFloat(viability3El?.value || "0"),
    ].filter((v) => v > 0);
    const avgViability =
        viabilities.length > 0
            ? (
                  viabilities.reduce((a, b) => a + b, 0) / viabilities.length
              ).toFixed(1)
            : "-";

    // Get selected cell type and culture vessel text from Semantic UI dropdowns
    let cellTypeText = "-";
    const cellTypeDropdown = $("#cell_type_dropdown");
    if (cellTypeDropdown.length && cellTypeDropdown.dropdown("get value")) {
        cellTypeText = cellTypeDropdown.dropdown("get text") || "-";
    }

    let cultureVesselText = "-";
    const cultureVesselDropdown = $("#culture_vessel_dropdown");
    if (
        cultureVesselDropdown.length &&
        cultureVesselDropdown.dropdown("get value")
    ) {
        cultureVesselText = cultureVesselDropdown.dropdown("get text") || "-";
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
        wellCount: numWellsEl ? numWellsEl.value : "",
        buffer: bufferEl ? bufferEl.value : "",

        // Individual count values
        count1: count1El ? count1El.value : "",
        count2: count2El ? count2El.value : "",
        count3: count3El ? count3El.value : "",

        // Individual viability values
        viability1: viability1El ? viability1El.value : "",
        viability2: viability2El ? viability2El.value : "",
        viability3: viability3El ? viability3El.value : "",
    };
}

/**
 * Downloads the results as a PDF file using the server
 */
function downloadAsPdf() {
    // Prevent multiple downloads
    if (window.isDownloading) return;
    window.isDownloading = true;

    // Get result data
    const resultData = getResultData();

    // Create a form to submit the data
    const form = document.createElement("form");
    form.method = "POST";
    form.action = "calculator/download-pdf";
    form.style.display = "none";

    // Add CSRF token
    const csrfToken = document
        .querySelector('meta[name="csrf-token"]')
        ?.getAttribute("content");

    if (!csrfToken) {
        console.error("CSRF token not found");
        window.isDownloading = false;
        return;
    }

    const csrfInput = document.createElement("input");
    csrfInput.type = "hidden";
    csrfInput.name = "_token";
    csrfInput.value = csrfToken;
    form.appendChild(csrfInput);

    // Add well count - try multiple sources to ensure we get the value
    let wellCountValue = "0";
    const wellCountEl = document.getElementById("wellCount");
    const numWellsEl = document.getElementById("num_wells");

    if (wellCountEl && wellCountEl.textContent) {
        wellCountValue = wellCountEl.textContent;
    } else if (numWellsEl && numWellsEl.value) {
        wellCountValue = numWellsEl.value;
    } else if (resultData.wellCount) {
        wellCountValue = resultData.wellCount;
    }

    const wellCountInput = document.createElement("input");
    wellCountInput.type = "hidden";
    wellCountInput.name = "wellCount";
    wellCountInput.value = wellCountValue;
    form.appendChild(wellCountInput);

    // Get volume per well value
    const volumePerWellEl = document.getElementById(
        "volume_plate_perwell_simple"
    );
    const volumePerWellInput = document.createElement("input");
    volumePerWellInput.type = "hidden";
    volumePerWellInput.name = "volumePerWell";
    volumePerWellInput.value = volumePerWellEl
        ? volumePerWellEl.textContent || "0"
        : "0";
    form.appendChild(volumePerWellInput);

    // Add all result data
    Object.keys(resultData).forEach((key) => {
        const input = document.createElement("input");
        input.type = "hidden";
        input.name = key;
        input.value = resultData[key] || "";
        form.appendChild(input);
    });

    // Detect browser timezone
    let timezone = "UTC";
    try {
        const tz = Intl.DateTimeFormat().resolvedOptions().timeZone;
        if (tz) {
            timezone = tz;
        }
    } catch (e) {
        console.warn("Could not detect timezone, defaulting to UTC", e);
    }
    const tzInput = document.createElement("input");
    tzInput.type = "hidden";
    tzInput.name = "timezone";
    tzInput.value = timezone;
    form.appendChild(tzInput);

    // Get any warnings
    const warningsDiv = document.getElementById("warnings");
    let warningsText = "";
    if (warningsDiv && !warningsDiv.classList.contains("hidden")) {
        warningsText = warningsDiv.textContent || "";
    }
    const warningsInput = document.createElement("input");
    warningsInput.type = "hidden";
    warningsInput.name = "warnings";
    warningsInput.value = warningsText;
    form.appendChild(warningsInput);

    // Submit the form
    document.body.appendChild(form);
    try {
        form.submit();
    } catch (e) {
        console.error("Error submitting form:", e);
    }

    // Reset download flag after a delay
    setTimeout(() => {
        document.body.removeChild(form);
        window.isDownloading = false;
    }, 2000);
}

/**
 * Prints the current screen for PDF export
 */
function printScreen() {
    window.print();
}
