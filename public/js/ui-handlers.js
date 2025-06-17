/**
 * Populates cell types in the dropdown
 * @param {Array} types - Array of cell type objects
 */
function populateCellTypes(types) {
    // Get Semantic UI dropdown
    const dropdown = $("#cell_type_dropdown");
    // Clear existing options & reset dropdown state
    dropdown.dropdown("clear");

    // Add options to the menu
    const menu = dropdown.find(".menu");
    menu.empty();

    types.forEach((type) => {
        const opt = document.createElement("div");
        opt.className = "item";
        opt.setAttribute("data-value", type.id);
        // Include seeding density as a custom attribute if present
        opt.setAttribute("data-seeding-density", type.seeding_density || "");
        // The text to display; if SKU should also be searchable, include in text
        opt.textContent = `${type.product_name} (${type.sku})`;
        menu.append(opt);
    });

    // Initialize dropdown with fullTextSearch enabled
    dropdown.dropdown({
        fullTextSearch: true,
        match: "both", // also match value if desired
        onChange: function (value, text, $selectedItem) {
            const seedingInput = document.getElementById("seeding_density");
            if (
                value &&
                $selectedItem &&
                $selectedItem.attr("data-seeding-density")
            ) {
                seedingInput.value = $selectedItem.attr("data-seeding-density");
                seedingInput.classList.add("default-input");
                seedingInput.classList.remove("active-input");
            } else {
                seedingInput.value = "";
            }
        },
    });
}

/**
 * Populates culture vessels in the dropdown
 * @param {Array} vessels - Array of culture vessel objects
 */
function populateCultureVessels(vessels) {
    // Get Semantic UI dropdown
    const dropdown = $("#culture_vessel_dropdown");
    // Clear existing options & reset dropdown state
    dropdown.dropdown("clear");

    // Add options to the menu
    const menu = dropdown.find(".menu");
    menu.empty();

    vessels.forEach((v) => {
        const opt = document.createElement("div");
        opt.className = "item";
        opt.setAttribute("data-value", v.id);
        opt.setAttribute("data-surface-area", v.surface_area_cm2);
        opt.setAttribute("data-media-volume", v.media_volume_per_well_ml);
        // Display plate_format, but if you want other searchable metadata,
        // you could include it in text or a data attribute that dropdown can search.
        opt.textContent = v.plate_format;
        menu.append(opt);
    });

    const surfaceAreaInput = document.getElementById("surface_area");
    const mediaVolumeInput = document.getElementById("media_volume");

    // Initialize dropdown with fullTextSearch enabled
    dropdown.dropdown({
        fullTextSearch: true,
        match: "both",
        onChange: function (value, text, $selectedItem) {
            if (value && $selectedItem) {
                const surfaceArea = $selectedItem.attr("data-surface-area");
                const mediaVolume = $selectedItem.attr("data-media-volume");

                if (surfaceArea !== "null") {
                    surfaceAreaInput.value = surfaceArea;
                    surfaceAreaInput.classList.add("default-input");
                    surfaceAreaInput.classList.remove("active-input");
                } else {
                    surfaceAreaInput.value = "";
                }

                if (mediaVolume !== "null") {
                    mediaVolumeInput.value = mediaVolume;
                    mediaVolumeInput.classList.add("default-input");
                    mediaVolumeInput.classList.remove("active-input");
                } else {
                    mediaVolumeInput.value = "";
                }
            } else {
                surfaceAreaInput.value = "";
                mediaVolumeInput.value = "";
            }
        },
    });
}

/**
 * Resets the calculator form to its initial state
 */
function resetCalculator() {
    // Reset all inputs to default state
    document
        .querySelectorAll('input[type="number"], input[type="number"]')
        .forEach((input) => {
            // Only reset non-default inputs
            if (input.id === "suspension_volume") {
                input.value = "1";
            } else if (input.id === "viability1") {
                input.value = "100";
            } else if (input.id === "buffer") {
                input.value = "10";
            } else if (input.id === "num_wells") {
                input.value = "96";
            } else {
                input.value = "";
            }
            input.classList.remove("active-input", "border-red-500");
            if (input.value) {
                input.classList.add("default-input");
            }
        });

    // Reset select elements
    document.getElementById("cell_type").value = "";
    document.getElementById("culture_vessel").value = "";

    // Hide results and show help content
    document.getElementById("resultsContent").classList.add("hidden");
    document.getElementById("helpContent").classList.remove("hidden");
    document.getElementById("validationErrors").classList.add("hidden");
    document.getElementById("warnings").classList.add("hidden");

    // Hide download options and copy/paste info
    document.getElementById("downloadOptions").classList.add("hidden");
    if (document.getElementById("copyPasteInfo")) {
        document.getElementById("copyPasteInfo").classList.add("hidden");
    }

    // Show calculate button, hide action buttons
    document.getElementById("calculateBtn").classList.remove("hidden");
    document.getElementById("actionButtons").classList.add("hidden");

    // Reset any warning messages
    document.getElementById("cellCountWarning").classList.add("hidden");
    document.getElementById("viabilityWarning").classList.add("hidden");
}

/**
 * Setup event listeners for the calculator
 */
function setupEventListeners() {
    // Apply default styling to all inputs with default values
    const numericInputs = document.querySelectorAll('input[type="number"]');
    numericInputs.forEach((input) => {
        if (input.value) {
            input.classList.add("default-input");
        }

        // Update styling when user interacts with the input
        input.addEventListener("input", function () {
            this.classList.remove("default-input");
            this.classList.add("active-input");
        });

        input.addEventListener("focus", function () {
            this.classList.remove("default-input");
            this.classList.add("active-input");
            // Auto-select all text when input receives focus
            this.select();
        });

        // Clear input when user starts typing a new number
        input.addEventListener("keydown", function (e) {
            // If a number key is pressed and no text is selected
            if (
                ((e.key >= "0" && e.key <= "9") ||
                    e.key === "." ||
                    e.key === ",") &&
                this.selectionStart === this.selectionEnd &&
                this.selectionStart > 0
            ) {
                // Clear the field if user is typing a new number
                this.value = "";
            }
        });
    });

    // Add listeners for calculate, reset, recalculate buttons
    const calculateBtn = document.getElementById("calculateBtn");
    const resetBtn = document.getElementById("resetBtn");
    const recalculateBtn = document.getElementById("recalculateBtn");
    const downloadExcelBtn = document.getElementById("downloadExcel");
    const downloadPdfBtn = document.getElementById("downloadPdf");

    if (calculateBtn) {
        calculateBtn.addEventListener("click", performCalculation);
    }

    if (resetBtn) {
        resetBtn.addEventListener("click", resetCalculator);
    }

    if (recalculateBtn) {
        recalculateBtn.addEventListener("click", performCalculation);
    }

    if (downloadExcelBtn) {
        downloadExcelBtn.addEventListener("click", function (e) {
            e.preventDefault();
            downloadAsExcel();
        });
    }

    if (downloadPdfBtn) {
        downloadPdfBtn.addEventListener("click", function (e) {
            e.preventDefault();
            printScreen();
        });
    }

    // Add cell count variability listeners
    const countInputs = ["count1", "count2", "count3"];
    countInputs.forEach((id) => {
        const input = document.getElementById(id);
        if (input) {
            input.addEventListener("input", checkCellCountVariability);
        }
    });

    // Add viability check listeners
    const viabilityInputs = ["viability1", "viability2", "viability3"];
    viabilityInputs.forEach((id) => {
        const input = document.getElementById(id);
        if (input) {
            input.addEventListener("change", checkViabilityValues);
        }
    });

    // Prevent tooltip clicks from selecting inputs
    document.querySelectorAll(".tooltip-container").forEach((tooltip) => {
        tooltip.addEventListener("click", function (e) {
            e.preventDefault();
            e.stopPropagation();
        });
    });

    // Hide validation errors when focusing on any input
    document.querySelectorAll("input, select").forEach((el) => {
        el.addEventListener("focus", function () {
            const validationErrors =
                document.getElementById("validationErrors");
            if (validationErrors) {
                validationErrors.classList.add("hidden");
            }
        });
    });
}

/**
 * Initialize the calculator app
 */
async function initCalculator() {
    // Setup event listeners
    setupEventListeners();

    let cellTypes = [];
    let cultureVessels = [];

    // Fetch cell types
    try {
        const response = await fetch("products");
        cellTypes = await response.json();
        populateCellTypes(cellTypes);
    } catch (err) {
        console.error("Failed to fetch cell types", err);
    }

    // Fetch culture vessels
    try {
        const resp2 = await fetch("culture-vessels", {
            headers: {
                Accept: "application/json",
            },
        });
        cultureVessels = await resp2.json();
        populateCultureVessels(cultureVessels);
    } catch (err) {
        console.error("Failed to fetch culture vessels", err);
    }
}
