/**
 * Validates required fields and highlights missing fields
 * @returns {Array} Array of missing field names
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

    requiredFields.forEach((field) => {
        const input = document.getElementById(field.id);
        // Check if value is empty, zero, or NaN
        const value = input.value;
        const numValue = parseFloat(value);

        if (value === "" || isNaN(numValue) || numValue === 0) {
            missingFields.push(field.name);
            // Highlight the empty field
            input.classList.add("border-red-500");

            // If it's a hidden input for a dropdown, highlight the dropdown
            if (field.id === "cell_type") {
                document
                    .querySelector("#cell_type_dropdown")
                    .classList.add("error");
            } else if (field.id === "culture_vessel") {
                document
                    .querySelector("#culture_vessel_dropdown")
                    .classList.add("error");
            }
        } else {
            // Remove highlighting if field is filled
            input.classList.remove("border-red-500");

            // Remove error class from dropdowns if applicable
            if (field.id === "cell_type") {
                document
                    .querySelector("#cell_type_dropdown")
                    .classList.remove("error");
            } else if (field.id === "culture_vessel") {
                document
                    .querySelector("#culture_vessel_dropdown")
                    .classList.remove("error");
            }
        }
    });

    return missingFields;
}

/**
 * Helper function to parse numeric inputs that may contain either commas or periods as decimal separators
 * @param {string} value - The input value to parse
 * @returns {number} The parsed decimal value
 */
function parseDecimalInput(value) {
    if (!value || value.trim() === "") return 0;
    try {
        // Replace commas with periods for consistent parsing
        const normalized = value.replace(",", ".");
        const result = parseFloat(normalized);
        return isNaN(result) ? 0 : result;
    } catch (error) {
        console.error("Error parsing decimal input:", value, error);
        return 0;
    }
}
