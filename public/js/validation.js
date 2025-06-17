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
            input.classList.remove("border-red-500");
            if (field.id === "cell_type") {
                const dd = document.querySelector("#cell_type_dropdown");
                if (dd) dd.classList.remove("error");
            } else if (field.id === "culture_vessel") {
                const dd = document.querySelector("#culture_vessel_dropdown");
                if (dd) dd.classList.remove("error");
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
    if (!value || value.trim() === "") return NaN; // return NaN so empty is handled upstream
    // Normalize: replace comma with period, but also handle multiple commas? For simplicity: replace ALL commas.
    const normalized = value.replace(/,/g, ".");
    const result = parseFloat(normalized);
    return isNaN(result) ? NaN : result;
}
