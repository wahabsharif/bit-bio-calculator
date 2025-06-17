/**
 * Checks cell count variability and shows warning if necessary
 */
function checkCellCountVariability() {
    const count1El = document.getElementById("count1");
    const count2El = document.getElementById("count2");
    const count3El = document.getElementById("count3");
    const cellCountWarning = document.getElementById("cellCountWarning");

    if (!count1El || !count2El || !count3El || !cellCountWarning) return;

    const counts = [
        parseDecimalInput(count1El.value),
        parseDecimalInput(count2El.value),
        parseDecimalInput(count3El.value),
    ].filter((count) => count > 0); // Only consider non-zero values

    // Need at least 2 counts to compare
    if (counts.length < 2) {
        cellCountWarning.classList.add("hidden");
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
        cellCountWarning.classList.remove("hidden");
    } else {
        cellCountWarning.classList.add("hidden");
    }
}

/**
 * Checks viability values and shows warning if necessary
 */
function checkViabilityValues() {
    const viabilityWarning = document.getElementById("viabilityWarning");
    if (!viabilityWarning) return;

    const viabilities = [
        parseFloat(document.getElementById("viability1")?.value) || 0,
        parseFloat(document.getElementById("viability2")?.value) || 0,
        parseFloat(document.getElementById("viability3")?.value) || 0,
    ].filter((v) => v > 0); // Only consider non-zero values

    // Check if any viability value is below 80%
    const lowViability = viabilities.some((v) => v < 80);

    if (lowViability && viabilities.length > 0) {
        viabilityWarning.classList.remove("hidden");
    } else {
        viabilityWarning.classList.add("hidden");
    }
}
