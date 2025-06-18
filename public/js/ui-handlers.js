/**
 * Populates cell types in the dropdown
 * @param {Array} types - Array of cell type objects
 */
function populateCellTypes(types) {
    // Sort types array by product_name, case-insensitive
    types.sort((a, b) => {
        const nameA = a.product_name || "";
        const nameB = b.product_name || "";
        // localeCompare with sensitivity 'base' ignores case
        return nameA.localeCompare(nameB, undefined, { sensitivity: "base" });
    });

    // Get Semantic UI dropdown
    const dropdown = $("#cell_type_dropdown");
    // Clear existing options & reset dropdown state
    dropdown.dropdown("clear");

    // Add options to the menu
    const menu = dropdown.find(".menu");
    menu.empty();

    // Check if "Other" exists in API data (case-insensitive)
    const hasOtherInAPI = types.some(
        (type) =>
            type.product_name && type.product_name.toLowerCase() === "other"
    );

    // Add hardcoded "Other" option only if not available from API
    if (!hasOtherInAPI) {
        const otherOpt = document.createElement("div");
        otherOpt.className = "item";
        otherOpt.setAttribute("data-value", "other");
        otherOpt.setAttribute("data-seeding-density", "");
        otherOpt.textContent = "Other";
        menu.append(otherOpt);
    }

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
                value !== "other" &&
                $selectedItem &&
                $selectedItem.attr("data-seeding-density")
            ) {
                // Set flag to prevent manual input logic from triggering
                seedingInput._programmaticSet = true;
                seedingInput.value = $selectedItem.attr("data-seeding-density");
                seedingInput.classList.add("default-input");
                seedingInput.classList.remove("active-input");
                // Reset flag after a short delay
                setTimeout(() => {
                    seedingInput._programmaticSet = false;
                }, 50);
            } else if (value === "other") {
                // Don't auto-fill seeding density for "Other"
                seedingInput.classList.remove("default-input");
                seedingInput.classList.add("active-input");
            } else {
                seedingInput._programmaticSet = true;
                seedingInput.value = "";
                setTimeout(() => {
                    seedingInput._programmaticSet = false;
                }, 50);
            }
        },
    });
}

/**
 * Populates culture vessels in the dropdown
 * @param {Array} vessels - Array of culture vessel objects
 */
function populateCultureVessels(vessels) {
    // Sort vessels array by plate_format, case-insensitive
    vessels.sort((a, b) => {
        const pfA = a.plate_format || "";
        const pfB = b.plate_format || "";
        return pfA.localeCompare(pfB, undefined, { sensitivity: "base" });
    });

    // Get Semantic UI dropdown
    const dropdown = $("#culture_vessel_dropdown");
    // Clear existing options & reset dropdown state
    dropdown.dropdown("clear");

    // Add options to the menu
    const menu = dropdown.find(".menu");
    menu.empty();

    // Improved check if "Other" exists in API data - more robust case-insensitive check
    const hasOtherInAPI = vessels.some(
        (vessel) =>
            vessel.plate_format && vessel.plate_format.toLowerCase() === "other"
    );

    // Add hardcoded "Other" option only if not available from API
    if (!hasOtherInAPI) {
        const otherOpt = document.createElement("div");
        otherOpt.className = "item";
        otherOpt.setAttribute("data-value", "other");
        otherOpt.setAttribute("data-surface-area", "");
        otherOpt.setAttribute("data-media-volume", "");
        otherOpt.textContent = "Other";
        menu.append(otherOpt);
    }

    // Track if we've added any option with "other" as the value attribute
    let hasOtherValue = false;

    vessels.forEach((v) => {
        const opt = document.createElement("div");
        opt.className = "item";

        // Special handling for "Other" option from API
        if (v.plate_format && v.plate_format.toLowerCase() === "other") {
            opt.setAttribute("data-value", "other");
            hasOtherValue = true;
        } else {
            opt.setAttribute("data-value", v.id);
        }

        opt.setAttribute("data-surface-area", v.surface_area_cm2);
        opt.setAttribute("data-media-volume", v.media_volume_per_well_ml);
        opt.textContent = v.plate_format;
        menu.append(opt);
    });

    // If we didn't add an "other" value option from the API but we need one
    if (!hasOtherValue && !hasOtherInAPI) {
        const otherOpt = document.createElement("div");
        otherOpt.className = "item";
        otherOpt.setAttribute("data-value", "other");
        otherOpt.setAttribute("data-surface-area", "");
        otherOpt.setAttribute("data-media-volume", "");
        otherOpt.textContent = "Other";
        menu.append(otherOpt);
    }

    // Remove any duplicate "Other" options
    const otherOptions = menu.find('.item[data-value="other"]');
    if (otherOptions.length > 1) {
        // Keep only the first one
        otherOptions.slice(1).remove();
    }

    const surfaceAreaInput = document.getElementById("surface_area");
    const mediaVolumeInput = document.getElementById("media_volume");

    // Initialize dropdown with fullTextSearch enabled
    dropdown.dropdown({
        fullTextSearch: true,
        match: "both",
        onChange: function (value, text, $selectedItem) {
            if (value && value !== "other" && $selectedItem) {
                const surfaceArea = $selectedItem.attr("data-surface-area");
                const mediaVolume = $selectedItem.attr("data-media-volume");

                if (surfaceArea && surfaceArea !== "null") {
                    surfaceAreaInput._programmaticSet = true;
                    surfaceAreaInput.value = surfaceArea;
                    surfaceAreaInput.classList.add("default-input");
                    surfaceAreaInput.classList.remove("active-input");
                    setTimeout(() => {
                        surfaceAreaInput._programmaticSet = false;
                    }, 50);
                } else {
                    surfaceAreaInput._programmaticSet = true;
                    surfaceAreaInput.value = "";
                    setTimeout(() => {
                        surfaceAreaInput._programmaticSet = false;
                    }, 50);
                }

                if (mediaVolume && mediaVolume !== "null") {
                    mediaVolumeInput._programmaticSet = true;
                    mediaVolumeInput.value = mediaVolume;
                    mediaVolumeInput.classList.add("default-input");
                    mediaVolumeInput.classList.remove("active-input");
                    setTimeout(() => {
                        mediaVolumeInput._programmaticSet = false;
                    }, 50);
                } else {
                    mediaVolumeInput._programmaticSet = true;
                    mediaVolumeInput.value = "";
                    setTimeout(() => {
                        mediaVolumeInput._programmaticSet = false;
                    }, 50);
                }
            } else if (value === "other") {
                // Don't auto-fill surface area and media volume for "Other"
                surfaceAreaInput.classList.remove("default-input");
                surfaceAreaInput.classList.add("active-input");
                mediaVolumeInput.classList.remove("default-input");
                mediaVolumeInput.classList.add("active-input");
            } else {
                surfaceAreaInput._programmaticSet = true;
                surfaceAreaInput.value = "";
                mediaVolumeInput._programmaticSet = true;
                mediaVolumeInput.value = "";
                setTimeout(() => {
                    surfaceAreaInput._programmaticSet = false;
                    mediaVolumeInput._programmaticSet = false;
                }, 50);
            }
        },
    });
}

/**
 * Handles manual input in seeding density field
 */
function handleSeedingDensityManualInput() {
    const seedingInput = document.getElementById("seeding_density");
    const cellTypeDropdown = $("#cell_type_dropdown");

    let typingTimeout;

    // Track when user starts typing manually
    seedingInput.addEventListener("input", function (e) {
        // Skip if this was a programmatic change
        if (this._programmaticSet) {
            return;
        }

        // Clear any existing timeout
        clearTimeout(typingTimeout);

        // Update styling immediately
        this.classList.remove("default-input");
        this.classList.add("active-input");

        // Set a timeout to handle the "Other" selection after user stops typing
        typingTimeout = setTimeout(() => {
            if (this.value.trim() !== "") {
                // Set cell type dropdown to "Other"
                cellTypeDropdown.dropdown("set selected", "other");
            }
        }, 50);
    });

    // Also handle focus event to update styling
    seedingInput.addEventListener("focus", function () {
        if (!this._programmaticSet) {
            this.classList.remove("default-input");
            this.classList.add("active-input");
        }
    });

    // Handle keydown for immediate clearing behavior
    seedingInput.addEventListener("keydown", function (e) {
        // Skip if this was a programmatic change
        if (this._programmaticSet) {
            return;
        }

        // If a number key is pressed and no text is selected, clear field
        if (
            ((e.key >= "0" && e.key <= "9") ||
                e.key === "." ||
                e.key === ",") &&
            this.selectionStart === this.selectionEnd &&
            this.selectionStart > 0
        ) {
            this.value = "";
        }
    });
}

/**
 * Handles manual input in surface area field
 */
function handleSurfaceAreaManualInput() {
    const surfaceAreaInput = document.getElementById("surface_area");
    const cultureVesselDropdown = $("#culture_vessel_dropdown");

    let typingTimeout;

    // Track when user starts typing manually
    surfaceAreaInput.addEventListener("input", function (e) {
        // Skip if this was a programmatic change
        if (this._programmaticSet) {
            return;
        }

        // Clear any existing timeout
        clearTimeout(typingTimeout);

        // Update styling immediately
        this.classList.remove("default-input");
        this.classList.add("active-input");

        // Set a timeout to handle the "Other" selection after user stops typing
        typingTimeout = setTimeout(() => {
            if (this.value.trim() !== "") {
                // Improved approach to set culture vessel dropdown to "Other"
                // First ensure the "other" option exists
                const otherExists =
                    cultureVesselDropdown.find('.item[data-value="other"]')
                        .length > 0;

                if (otherExists) {
                    // Set culture vessel dropdown to "Other"
                    cultureVesselDropdown.dropdown("set selected", "other");
                } else {
                    // If "other" option doesn't exist in dropdown, try adding it
                    const menu = cultureVesselDropdown.find(".menu");
                    const otherOpt = document.createElement("div");
                    otherOpt.className = "item";
                    otherOpt.setAttribute("data-value", "other");
                    otherOpt.setAttribute("data-surface-area", "");
                    otherOpt.setAttribute("data-media-volume", "");
                    otherOpt.textContent = "Other";
                    menu.append(otherOpt);

                    // Now set it as selected
                    cultureVesselDropdown.dropdown("refresh");
                    cultureVesselDropdown.dropdown("set selected", "other");
                }
            }
        }, 50);
    });

    // Also handle focus event to update styling
    surfaceAreaInput.addEventListener("focus", function () {
        if (!this._programmaticSet) {
            this.classList.remove("default-input");
            this.classList.add("active-input");
        }
    });

    // Handle keydown for immediate clearing behavior
    surfaceAreaInput.addEventListener("keydown", function (e) {
        // Skip if this was a programmatic change
        if (this._programmaticSet) {
            return;
        }

        // If a number key is pressed and no text is selected, clear field
        if (
            ((e.key >= "0" && e.key <= "9") ||
                e.key === "." ||
                e.key === ",") &&
            this.selectionStart === this.selectionEnd &&
            this.selectionStart > 0
        ) {
            this.value = "";
        }
    });
}

/**
 * Handles manual input in media volume field
 */
function handleMediaVolumeManualInput() {
    const mediaVolumeInput = document.getElementById("media_volume");
    const cultureVesselDropdown = $("#culture_vessel_dropdown");

    let typingTimeout;

    // Track when user starts typing manually
    mediaVolumeInput.addEventListener("input", function (e) {
        // Skip if this was a programmatic change
        if (this._programmaticSet) {
            return;
        }

        // Clear any existing timeout
        clearTimeout(typingTimeout);

        // Update styling immediately
        this.classList.remove("default-input");
        this.classList.add("active-input");

        // Set a timeout to handle the "Other" selection after user stops typing
        typingTimeout = setTimeout(() => {
            if (this.value.trim() !== "") {
                // Set culture vessel dropdown to "Other"
                cultureVesselDropdown.dropdown("set selected", "other");
            }
        }, 500); // Wait 500ms after user stops typing
    });

    // Also handle focus event to update styling
    mediaVolumeInput.addEventListener("focus", function () {
        if (!this._programmaticSet) {
            this.classList.remove("default-input");
            this.classList.add("active-input");
        }
    });

    // Handle keydown for immediate clearing behavior
    mediaVolumeInput.addEventListener("keydown", function (e) {
        // Skip if this was a programmatic change
        if (this._programmaticSet) {
            return;
        }

        // If a number key is pressed and no text is selected, clear field
        if (
            ((e.key >= "0" && e.key <= "9") ||
                e.key === "." ||
                e.key === ",") &&
            this.selectionStart === this.selectionEnd &&
            this.selectionStart > 0
        ) {
            this.value = "";
        }
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

    // Reset select elements and Semantic UI dropdowns
    document.getElementById("cell_type").value = "";
    document.getElementById("culture_vessel").value = "";

    // Reset Semantic UI dropdowns
    $("#cell_type_dropdown").dropdown("clear");
    $("#culture_vessel_dropdown").dropdown("clear");

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

            // Enforce min/max constraints for direct input
            if (
                this.hasAttribute("min") &&
                parseFloat(this.value) < parseFloat(this.getAttribute("min"))
            ) {
                this.value = this.getAttribute("min");
                showValidationError("Please do not include negative numbers");
            }

            if (
                this.hasAttribute("max") &&
                parseFloat(this.value) > parseFloat(this.getAttribute("max"))
            ) {
                this.value = this.getAttribute("max");
                showValidationError(
                    "Your percentage value is higher than 100%, please confirm your values"
                );
            }
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

    // Handle text inputs with decimal mode (count1, count2, count3)
    const decimalInputs = document.querySelectorAll(
        'input[type="text"][inputmode="decimal"]'
    );
    decimalInputs.forEach((input) => {
        input.addEventListener("input", function () {
            const value = parseDecimalInput(this.value);
            if (!isNaN(value) && value < 0) {
                this.value = "0";
                showValidationError("Please do not include negative numbers");
            }
        });
    });

    // Setup manual input handling for all relevant fields
    handleSeedingDensityManualInput();
    handleSurfaceAreaManualInput();
    handleMediaVolumeManualInput();

    // Add calculate button click handler with validation
    const calculateBtn = document.getElementById("calculateBtn");
    if (calculateBtn) {
        calculateBtn.addEventListener("click", function () {
            // First check for negative numbers or percentage over 100
            const allInputs = document.querySelectorAll(
                'input[type="number"], input[type="text"][inputmode="decimal"]'
            );
            let hasNegative = false;
            let hasPercentageOverLimit = false;
            const percentageFields = [
                "viability1",
                "viability2",
                "viability3",
                "buffer",
            ];

            allInputs.forEach((input) => {
                if (input.value.trim() === "") return;

                const value = parseDecimalInput(input.value);
                if (isNaN(value)) return;

                if (value < 0) {
                    hasNegative = true;
                    input.classList.add("border-red-500");
                } else if (percentageFields.includes(input.id) && value > 100) {
                    hasPercentageOverLimit = true;
                    input.classList.add("border-red-500");
                }
            });

            if (hasNegative) {
                showValidationError("Please do not include negative numbers");
                return;
            }

            if (hasPercentageOverLimit) {
                showValidationError(
                    "Your percentage value is higher than 100%, please confirm your values"
                );
                return;
            }

            // If no validation errors, proceed with calculation
            performCalculation();
        });
    }

    // Add listeners for calculate, reset, recalculate buttons
    const resetBtn = document.getElementById("resetBtn");
    const recalculateBtn = document.getElementById("recalculateBtn");
    const downloadExcelBtn = document.getElementById("downloadExcel");
    const downloadPdfBtn = document.getElementById("downloadPdf");

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
