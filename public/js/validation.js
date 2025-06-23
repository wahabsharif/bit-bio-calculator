/**
 * Validates required fields and highlights missing or invalid fields
 * @returns {Array} Array of missing or invalid field names
 */
function validateRequiredFields() {
    const requiredFields = [
        { id: "suspension_volume", name: "Cell stock volume" },
        { id: "seeding_density", name: "Seeding density" },
        { id: "surface_area", name: "Surface area" },
        { id: "media_volume", name: "Volume" },
        { id: "num_wells", name: "Number of wells to seed" },
        { id: "count1", name: "Live cell Count 1" },
        { id: "viability1", name: "Cell viability Count 1" },
    ];

    const missingFields = [];
    const negativeValueFields = [];
    const percentageOverLimitFields = [];
    const percentageFields = [
        "viability1",
        "viability2",
        "viability3",
        "buffer",
    ];

    // Check required fields
    requiredFields.forEach((field) => {
        validateSingleField(
            field,
            missingFields,
            negativeValueFields,
            percentageOverLimitFields,
            percentageFields
        );
    });

    // Check non-required fields for negative values and percentage limits
    const allInputs = document.querySelectorAll(
        'input[type="number"], input[type="text"][inputmode="decimal"]'
    );

    allInputs.forEach((input) => {
        if (requiredFields.some((field) => field.id === input.id)) return; // Skip required fields

        const rawValue = input.value;
        if (rawValue.trim() === "") return; // Skip empty fields

        const numValue = parseDecimalInput(rawValue);
        if (isNaN(numValue)) return; // Skip non-numeric values

        const fieldName = input.previousElementSibling?.textContent || input.id;

        // Check for negative values
        if (numValue < 0) {
            negativeValueFields.push(fieldName);
            input.classList.add("border-red-500");
        }
        // Check for percentage fields over 100%
        else if (percentageFields.includes(input.id) && numValue > 100) {
            percentageOverLimitFields.push(fieldName);
            input.classList.add("border-red-500");
        }
    });

    // Display error messages if needed
    if (negativeValueFields.length > 0) {
        showValidationError("Please do not include negative numbers");
        return []; // Return empty to prevent calculation
    }

    if (percentageOverLimitFields.length > 0) {
        showValidationError(
            "Your percentage value is higher than 100%, please confirm your values"
        );
        return []; // Return empty to prevent calculation
    }

    return missingFields;
}

/**
 * Validates a single field and adds to appropriate error arrays
 * @param {Object} field - Field definition object
 * @param {Array} missingFields - Array to collect missing fields
 * @param {Array} negativeValueFields - Array to collect fields with negative values
 * @param {Array} percentageOverLimitFields - Array to collect fields with percentage over limit
 * @param {Array} percentageFields - Array of field IDs that should be percentages
 */
function validateSingleField(
    field,
    missingFields,
    negativeValueFields,
    percentageOverLimitFields,
    percentageFields
) {
    const input = document.getElementById(field.id);
    if (!input) return;

    const rawValue = input.value;
    const numValue = parseDecimalInput(rawValue);

    // Treat empty or NaN or zero as missing/invalid
    if (rawValue.trim() === "" || isNaN(numValue) || numValue === 0) {
        missingFields.push(field.name);
        input.classList.add("border-red-500");
        // Highlight dropdowns if needed
        highlightDropdownIfNeeded(field.id);
    } else {
        // Check for negative values
        if (numValue < 0) {
            negativeValueFields.push(field.name);
            input.classList.add("border-red-500");
        }
        // Check for percentage fields over 100%
        else if (percentageFields.includes(field.id) && numValue > 100) {
            percentageOverLimitFields.push(field.name);
            input.classList.add("border-red-500");
        } else {
            input.classList.remove("border-red-500");
            // Clear dropdown errors
            clearDropdownErrorIfNeeded(field.id);
        }
    }
}

/**
 * Highlight dropdown if needed based on field ID
 * @param {string} fieldId - The field ID
 */
function highlightDropdownIfNeeded(fieldId) {
    if (fieldId === "cell_type") {
        const dd = document.querySelector("#cell_type_dropdown");
        if (dd) dd.classList.add("error");
    } else if (fieldId === "culture_vessel") {
        const dd = document.querySelector("#culture_vessel_dropdown");
        if (dd) dd.classList.add("error");
    }
}

/**
 * Clear dropdown error if needed based on field ID
 * @param {string} fieldId - The field ID
 */
function clearDropdownErrorIfNeeded(fieldId) {
    if (fieldId === "cell_type") {
        const dd = document.querySelector("#cell_type_dropdown");
        if (dd) dd.classList.remove("error");
    } else if (fieldId === "culture_vessel") {
        const dd = document.querySelector("#culture_vessel_dropdown");
        if (dd) dd.classList.remove("error");
    }
}

/**
 * Shows a validation error message
 * @param {string} message - The error message to display
 */
function showValidationError(message) {
    const validationErrors = document.getElementById("validationErrors");
    if (!validationErrors) return;

    const errorsList = validationErrors.querySelector("ul");
    if (!errorsList) return;

    // Clear existing errors
    errorsList.innerHTML = "";

    // Add the error message
    const errorItem = document.createElement("li");
    errorItem.textContent = message;
    errorsList.appendChild(errorItem);

    // Show the validation errors section
    validationErrors.classList.remove("hidden");
}

/**
 * Helper function to parse numeric inputs that may contain either commas or periods as decimal separators
 * @param {string} value - The input value to parse
 * @returns {number} The parsed decimal value
 */
function parseDecimalInput(value) {
    if (!value || value.trim() === "") return NaN; // return NaN so empty is handled upstream

    // First handle the case where comma is used as decimal separator (e.g., "1,1")
    if (value.includes(",") && !value.includes(".")) {
        // If there's only one comma and it's used as decimal separator
        const commaCount = (value.match(/,/g) || []).length;
        if (commaCount === 1) {
            // Replace the comma with a period for parsing
            return parseFloat(value.replace(",", "."));
        }
    }

    // For values with proper thousand separators (e.g., "1,000.5" or "1,000")
    const normalized = String(value).replace(/,/g, "");
    const result = parseFloat(normalized);
    return isNaN(result) ? NaN : result;
}

/**
 * Enhanced function to clear field errors - now handles programmatic changes
 * @param {HTMLElement} input - The input element to clear errors from
 */
function clearFieldError(input) {
    if (!input) return;

    input.classList.remove("border-red-500");
    clearDropdownErrorIfNeeded(input.id);
}

/**
 * Validates a single field and clears errors if valid
 * @param {HTMLElement} input - The input element to validate
 * @returns {boolean} True if field is valid, false otherwise
 */
function validateAndClearField(input) {
    if (!input) return false;

    let rawValue = input.value;
    const numValue = parseDecimalInput(rawValue);

    // Field is valid if it's not empty, not NaN, and not zero
    const isValid =
        rawValue.trim() !== "" && !isNaN(numValue) && numValue !== 0;

    if (isValid) {
        clearFieldError(input);
    }

    return isValid;
}

/**
 * Validates a single field and returns whether it's valid
 * @param {HTMLElement} input - The input element to validate
 * @returns {boolean} True if field is valid, false otherwise
 */
function isFieldValid(input) {
    if (!input) return false;

    const rawValue = input.value;
    const numValue = parseDecimalInput(rawValue);

    // Field is valid if it's not empty, not NaN, and not zero
    return rawValue.trim() !== "" && !isNaN(numValue) && numValue !== 0;
}

/**
 * Adds input validation to restrict keystrokes to numbers, dots, and commas
 * @param {HTMLElement} input - The input element to add validation to
 */
function addNumericInputValidation(input) {
    if (!input) return;

    // Ensure all numeric inputs have a step attribute
    if (!input.hasAttribute("step")) {
        input.setAttribute("step", "0.1");
    }

    // Handle keydown for input validation and arrow key increment/decrement
    input.addEventListener("keydown", handleNumericKeydown);

    // Handle input event for content validation
    input.addEventListener("input", handleNumericInput);

    // Handle blur event for proper formatting
    input.addEventListener("blur", handleNumericBlur);
}

/**
 * Handles keydown events for numeric inputs
 * @param {Event} e - The keydown event
 */
function handleNumericKeydown(e) {
    // Skip if this is a programmatic change
    if (this._programmaticSet) return;

    // Handle arrow key increment/decrement
    if (
        e.key === "ArrowUp" ||
        e.key === "ArrowDown" ||
        e.keyCode === 38 ||
        e.keyCode === 40
    ) {
        e.preventDefault(); // Prevent default scroll behavior

        // Check if user is using comma as decimal separator before parsing
        const useCommaAsDecimal =
            this.value.includes(",") &&
            !this.value.includes(".") &&
            (this.value.match(/,/g) || []).length === 1;

        // Get current value and step size
        let currentValue = parseDecimalInput(this.value) || 0;
        const step = parseFloat(this.getAttribute("step") || "0.1");

        // Calculate new value based on arrow key
        if (e.key === "ArrowUp" || e.keyCode === 38) {
            currentValue += step;
        } else {
            currentValue = Math.max(0, currentValue - step);
        }

        // Apply min/max constraints
        const minAttr = this.getAttribute("min");
        const maxAttr = this.getAttribute("max");

        if (minAttr !== null && currentValue < parseFloat(minAttr)) {
            currentValue = parseFloat(minAttr);
        }

        if (maxAttr !== null && currentValue > parseFloat(maxAttr)) {
            currentValue = parseFloat(maxAttr);
        }

        // Ensure viability fields never exceed 100
        const isViabilityField = [
            "viability1",
            "viability2",
            "viability3",
        ].includes(this.id);
        if (isViabilityField && currentValue > 100) {
            currentValue = 100;
        }

        // Format based on field type and value
        const isCountField = ["count1", "count2", "count3"].includes(this.id);

        if (isCountField) {
            // For count fields, format with one decimal place
            if (Number.isInteger(currentValue)) {
                this.value = useCommaAsDecimal
                    ? currentValue.toString()
                    : currentValue.toString();
            } else {
                // Preserve comma as decimal separator if that's what user entered
                if (useCommaAsDecimal) {
                    this.value = currentValue.toFixed(1).replace(".", ",");
                } else {
                    this.value = currentValue.toFixed(1);
                }
            }
        } else if (Number.isInteger(currentValue) && step >= 1) {
            // For whole numbers with step >= 1
            this.value = currentValue.toString();
        } else {
            // For decimal values, use appropriate precision
            const decimals = step.toString().includes(".")
                ? step.toString().split(".")[1].length
                : 1;

            // Preserve comma as decimal separator if that's what user entered
            if (useCommaAsDecimal) {
                this.value = currentValue.toFixed(decimals).replace(".", ",");
            } else {
                this.value = currentValue.toFixed(decimals);
            }
        }

        // Trigger events
        this.dispatchEvent(new Event("change", { bubbles: true }));
        this.dispatchEvent(new Event("input", { bubbles: true }));
        return;
    }

    // Allow special keys: backspace, delete, tab, escape, enter, etc.
    if (
        [46, 8, 9, 27, 13, 110, 36, 35, 37, 39].indexOf(e.keyCode) !== -1 ||
        // Allow: Ctrl+A, Ctrl+C, Ctrl+V, Ctrl+X
        (e.keyCode === 65 && (e.ctrlKey || e.metaKey)) ||
        (e.keyCode === 67 && (e.ctrlKey || e.metaKey)) ||
        (e.keyCode === 86 && (e.ctrlKey || e.metaKey)) ||
        (e.keyCode === 88 && (e.ctrlKey || e.metaKey)) ||
        // Allow: home, end, left, right
        (e.keyCode >= 35 && e.keyCode <= 39)
    ) {
        return;
    }

    // Allow decimal separator
    if (e.key === "." || e.key === ",") {
        // Only allow one decimal separator
        if (this.value.indexOf(".") !== -1 || this.value.indexOf(",") !== -1) {
            e.preventDefault();
        }
        return;
    }

    // Prevent non-numeric input
    if (
        (e.shiftKey || e.keyCode < 48 || e.keyCode > 57) &&
        (e.keyCode < 96 || e.keyCode > 105)
    ) {
        e.preventDefault();
    }
}

/**
 * Handles input events for numeric inputs
 * @param {Event} e - The input event
 */
function handleNumericInput(e) {
    // Skip if this was a programmatic change
    if (this._programmaticSet) return;

    const value = this.value;
    const isCountField = ["count1", "count2", "count3"].includes(this.id);
    const isViabilityField = [
        "viability1",
        "viability2",
        "viability3",
    ].includes(this.id);

    // For count fields with comma, preserve as decimal separator during typing
    if (isCountField && value.includes(",")) {
        return;
    }

    // Remove invalid characters
    const cleanedValue = value.replace(/[^0-9.,]/g, "");

    if (value !== cleanedValue) {
        this.value = cleanedValue;
    }

    // Immediately cap viability fields at 100 during typing
    if (isViabilityField && cleanedValue !== "") {
        const numValue = parseDecimalInput(cleanedValue);
        if (!isNaN(numValue) && numValue > 100) {
            this.value = "100";
        }
    }
}

/**
 * Handles blur events for numeric inputs
 * @param {Event} e - The blur event
 */
function handleNumericBlur(e) {
    if (this._programmaticSet) return;

    const isCountField = ["count1", "count2", "count3"].includes(this.id);
    const isViabilityField = [
        "viability1",
        "viability2",
        "viability3",
    ].includes(this.id);
    const value = this.value;

    if (value && value.trim() !== "") {
        const numValue = parseDecimalInput(value);
        if (!isNaN(numValue)) {
            // Apply min/max constraints
            const minAttr = this.getAttribute("min");
            const maxAttr = this.getAttribute("max");

            if (minAttr !== null && numValue < parseFloat(minAttr)) {
                this.value = minAttr;
            } else if (maxAttr !== null && numValue > parseFloat(maxAttr)) {
                this.value = maxAttr;
            } else if (isViabilityField && numValue > 100) {
                // Ensure viability fields never exceed 100
                this.value = "100";
            } else if (isCountField) {
                // Format count fields with one decimal place
                if (value.includes(",") && !value.includes(".")) {
                    const parts = value.split(",");
                    const intPart = parts[0];
                    let decPart = parts[1] || "0";
                    decPart = decPart.substring(0, 1).padEnd(1, "0");

                    this.value = intPart + "," + decPart;
                } else {
                    // Check if it's a whole number before adding decimal
                    if (Number.isInteger(numValue)) {
                        this.value = numValue.toString();
                    } else {
                        this.value = numValue.toFixed(1);
                    }
                }
            }
        }
    }
}

/**
 * Initialize validation for all numeric inputs
 */
function initializeNumericInputValidation() {
    const numericInputs = document.querySelectorAll(
        'input[inputmode="decimal"], input[type="number"]'
    );

    numericInputs.forEach((input) => {
        // Ensure all numeric inputs have a step attribute
        if (!input.hasAttribute("step")) {
            input.setAttribute("step", "0.1");
        }

        // Ensure viability fields have max attribute set to 100
        if (
            ["viability1", "viability2", "viability3"].includes(input.id) &&
            !input.hasAttribute("max")
        ) {
            input.setAttribute("max", "100");
        }

        // Remove any existing event listeners to prevent duplicates
        input.removeEventListener("keydown", handleNumericKeydown);
        input.removeEventListener("input", handleNumericInput);
        input.removeEventListener("blur", handleNumericBlur);

        // Add the event listeners again
        input.addEventListener("keydown", handleNumericKeydown);
        input.addEventListener("input", handleNumericInput);
        input.addEventListener("blur", handleNumericBlur);
    });
}

/**
 * Explicitly ensure arrow key handling is added to all numeric inputs
 */
function ensureArrowKeyHandling() {
    const numericInputs = document.querySelectorAll(
        'input[inputmode="decimal"], input[type="number"]'
    );

    numericInputs.forEach((input) => {
        // Make sure all inputs have the step attribute
        if (!input.hasAttribute("step")) {
            input.setAttribute("step", "0.1");
        }

        // Explicitly add keydown handler for arrow keys
        input.removeEventListener("keydown", handleNumericKeydown);
        input.addEventListener("keydown", handleNumericKeydown);
    });
}

/**
 * Initialize real-time validation for all required fields
 */
function initializeFieldValidation() {
    const requiredFieldIds = [
        "suspension_volume",
        "seeding_density",
        "surface_area",
        "media_volume",
        "num_wells",
        "count1",
        "viability1",
    ];

    requiredFieldIds.forEach((fieldId) => {
        const input = document.getElementById(fieldId);
        if (!input) return;

        // Add event listeners for real-time validation
        ["input", "change", "keyup"].forEach((eventType) => {
            input.addEventListener(eventType, function () {
                if (this._programmaticSet) return;

                if (this.classList.contains("border-red-500")) {
                    validateAndClearField(this);
                }
            });
        });

        // Handle blur event
        input.addEventListener("blur", function () {
            if (this._programmaticSet) return;

            if (this.classList.contains("border-red-500")) {
                validateAndClearField(this);
            }
        });
    });

    // Initialize numeric input validation
    initializeNumericInputValidation();

    // Explicitly ensure arrow key handling
    ensureArrowKeyHandling();

    // Initialize Semantic UI dropdown handling
    initializeDropdowns();
}

/**
 * Initialize Semantic UI dropdowns with validation support
 */
function initializeDropdowns() {
    if (typeof $ !== "undefined" && $.fn.dropdown) {
        $("#cell_type_dropdown").dropdown({
            onChange: function (value) {
                if (value && value.trim() !== "") {
                    const dd = document.querySelector("#cell_type_dropdown");
                    if (dd) dd.classList.remove("error");
                }
            },
        });

        $("#culture_vessel_dropdown").dropdown({
            onChange: function (value) {
                if (value && value.trim() !== "") {
                    const dd = document.querySelector(
                        "#culture_vessel_dropdown"
                    );
                    if (dd) dd.classList.remove("error");
                }
            },
        });
    }
}

// Initialize validation when DOM is loaded
document.addEventListener("DOMContentLoaded", function () {
    initializeFieldValidation();

    // Extra call to ensure arrow keys work after everything is loaded
    setTimeout(ensureArrowKeyHandling, 500);
});

/**
 * Handle wheel events for numeric inputs (for ui-handlers.js compatibility)
 * @param {Event} e - The wheel event
 */
function handleInputWheelEvent(e) {
    if (document.activeElement !== this) return;

    e.preventDefault();

    // Check if user is using comma as decimal separator
    const useCommaAsDecimal =
        this.value.includes(",") &&
        !this.value.includes(".") &&
        (this.value.match(/,/g) || []).length === 1;

    const step = parseFloat(this.getAttribute("step") || "0.1");
    const currentValue = parseDecimalInput(this.value) || 0;

    let newValue;
    if (e.deltaY < 0) {
        // Scroll up - increment
        newValue = currentValue + step;
    } else {
        // Scroll down - decrement
        newValue = Math.max(0, currentValue - step);
    }

    // Apply min/max constraints
    const minAttr = this.getAttribute("min");
    const maxAttr = this.getAttribute("max");

    if (minAttr !== null && newValue < parseFloat(minAttr)) {
        newValue = parseFloat(minAttr);
    }

    if (maxAttr !== null && newValue > parseFloat(maxAttr)) {
        newValue = parseFloat(maxAttr);
    }

    // Format the value appropriately
    const isCountField = ["count1", "count2", "count3"].includes(this.id);

    if (isCountField) {
        // For count fields, check if it's a whole number
        if (Number.isInteger(newValue)) {
            this.value = newValue.toString();
        } else {
            // Preserve comma as decimal separator if that's what user entered
            if (useCommaAsDecimal) {
                this.value = newValue.toFixed(1).replace(".", ",");
            } else {
                this.value = newValue.toFixed(1);
            }
        }
    } else if (Number.isInteger(newValue) && step >= 1) {
        // For whole numbers with step >= 1
        this.value = newValue.toString();
    } else {
        // For decimal values, use appropriate precision
        const decimals = step.toString().includes(".")
            ? step.toString().split(".")[1].length
            : 1;

        // Preserve comma as decimal separator if that's what user entered
        if (useCommaAsDecimal) {
            this.value = newValue.toFixed(decimals).replace(".", ",");
        } else {
            this.value = newValue.toFixed(decimals);
        }
    }

    // Trigger change events
    this.dispatchEvent(new Event("change", { bubbles: true }));
    this.dispatchEvent(new Event("input", { bubbles: true }));
}
