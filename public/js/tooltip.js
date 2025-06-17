/**
 * Tooltip functionality for bit.bio calculator
 * Handles showing/hiding tooltips on click
 */

document.addEventListener("DOMContentLoaded", function () {
    // Get all tooltip triggers
    const tooltipTriggers = document.querySelectorAll(".tooltip-container");

    // Track currently open tooltip
    let openTooltip = null;

    // Add click event to each tooltip trigger
    tooltipTriggers.forEach((trigger) => {
        trigger.addEventListener("click", function (e) {
            e.stopPropagation();

            const tooltip = this.querySelector(".custom-tooltip");

            // If there's an open tooltip and it's not the current one, close it
            if (openTooltip && openTooltip !== tooltip) {
                openTooltip.style.display = "none";
            }

            // Toggle the current tooltip
            if (tooltip.style.display === "block") {
                tooltip.style.display = "none";
                openTooltip = null;
            } else {
                tooltip.style.display = "block";
                openTooltip = tooltip;
            }
        });
    });

    // Close tooltip when clicking close button
    document.querySelectorAll(".tooltip-close").forEach((closeBtn) => {
        closeBtn.addEventListener("click", function (e) {
            e.stopPropagation();
            const tooltip = this.closest(".custom-tooltip");
            if (tooltip) {
                tooltip.style.display = "none";
                if (openTooltip === tooltip) {
                    openTooltip = null;
                }
            }
        });
    });

    // Close tooltip when clicking outside
    document.addEventListener("click", function () {
        if (openTooltip) {
            openTooltip.style.display = "none";
            openTooltip = null;
        }
    });
});
