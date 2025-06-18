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
        // add other required fields as needed
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

    requiredFields.forEach((field) => {
        const input = document.getElementById(field.id);
        if (!input) return;
        const rawValue = input.value;
        const numValue = parseDecimalInput(rawValue);

        // Treat empty or NaN or zero as missing/invalid
        if (rawValue.trim() === "" || isNaN(numValue) || numValue === 0) {
            missingFields.push(field.name);
            input.classList.add("border-red-500");
            // Highlight dropdowns if needed
            if (field.id === "cell_type") {
                const dd = document.querySelector("#cell_type_dropdown");
                if (dd) dd.classList.add("error");
            } else if (field.id === "culture_vessel") {
                const dd = document.querySelector("#culture_vessel_dropdown");
                if (dd) dd.classList.add("error");
            }
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
                if (field.id === "cell_type") {
                    const dd = document.querySelector("#cell_type_dropdown");
                    if (dd) dd.classList.remove("error");
                } else if (field.id === "culture_vessel") {
                    const dd = document.querySelector(
                        "#culture_vessel_dropdown"
                    );
                    if (dd) dd.classList.remove("error");
                }
            }
        }
    });

    // Check non-required fields as well for negative values and percentage limits
    const allInputs = document.querySelectorAll(
        'input[type="number"], input[type="text"][inputmode="decimal"]'
    );
    allInputs.forEach((input) => {
        if (requiredFields.some((field) => field.id === input.id)) return; // Skip required fields, already checked

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
    // Normalize: replace comma with period, but also handle multiple commas? For simplicity: replace ALL commas.
    const normalized = value.replace(/,/g, ".");
    const result = parseFloat(normalized);
    return isNaN(result) ? NaN : result;
}

/**
 * Removes error styling from an input field
 * @param {HTMLElement} input - The input element to clear errors from
 */
function clearFieldError(input) {
    if (!input) return;

    input.classList.remove("border-red-500");

    // Handle dropdown errors based on input ID
    const inputId = input.id;
    if (inputId === "cell_type") {
        const dd = document.querySelector("#cell_type_dropdown");
        if (dd) dd.classList.remove("error");
    } else if (inputId === "culture_vessel") {
        const dd = document.querySelector("#culture_vessel_dropdown");
        if (dd) dd.classList.remove("error");
    }
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
 * Initialize real-time validation for all required fields
 * Call this function when the page loads
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
                // If the field currently has an error and user is typing
                if (this.classList.contains("border-red-500")) {
                    // Check if the field is now valid
                    if (isFieldValid(this)) {
                        clearFieldError(this);
                    }
                }
            });
        });

        // Special handling for blur event to re-validate
        input.addEventListener("blur", function () {
            if (this.classList.contains("border-red-500")) {
                if (isFieldValid(this)) {
                    clearFieldError(this);
                }
            }
        });
    });

    // Handle dropdown changes for Semantic UI dropdowns
    // This assumes you're using Semantic UI dropdowns
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

// Call this when the DOM is loaded
document.addEventListener("DOMContentLoaded", function () {
    initializeFieldValidation();
});
