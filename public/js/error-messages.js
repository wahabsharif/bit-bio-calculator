/**
 * error-messages.js - Handles displaying error messages in the calculator
 */

/**
 * Shows a validation error message
 * @param {string} message - The error message to display
 */
function showValidationError(message) {
    const validationErrors = document.getElementById("validationErrors");
    if (!validationErrors) {
        console.error("Validation errors element not found");
        return;
    }

    const errorsList = validationErrors.querySelector("ul");
    if (!errorsList) {
        console.error("Errors list element not found");
        return;
    }

    // Clear existing errors
    errorsList.innerHTML = "";

    // Add the error message
    const errorItem = document.createElement("li");
    errorItem.textContent = message;
    errorsList.appendChild(errorItem);

    // Show the validation errors section
    validationErrors.classList.remove("hidden");

    // Auto-hide after 5 seconds
    setTimeout(() => {
        validationErrors.classList.add("hidden");
    }, 5000);
}

/**
 * Clears all validation errors
 */
function clearValidationErrors() {
    const validationErrors = document.getElementById("validationErrors");
    if (validationErrors) {
        validationErrors.classList.add("hidden");
        const errorsList = validationErrors.querySelector("ul");
        if (errorsList) {
            errorsList.innerHTML = "";
        }
    }
}

/**
 * Shows a warning message
 * @param {string} message - The warning message to display
 */
function showWarning(message) {
    const warnings = document.getElementById("warnings");
    if (!warnings) {
        console.error("Warnings element not found");
        return;
    }

    const warningsList = warnings.querySelector("ul");
    if (!warningsList) {
        console.error("Warnings list element not found");
        return;
    }

    // Add the warning message
    const warningItem = document.createElement("li");
    warningItem.textContent = message;
    warningsList.appendChild(warningItem);

    // Show the warnings section
    warnings.classList.remove("hidden");
}

/**
 * Clears all warnings
 */
function clearWarnings() {
    const warnings = document.getElementById("warnings");
    if (warnings) {
        warnings.classList.add("hidden");
        const warningsList = warnings.querySelector("ul");
        if (warningsList) {
            warningsList.innerHTML = "";
        }
    }
}
