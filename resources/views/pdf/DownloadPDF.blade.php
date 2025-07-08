<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Cell Seeding Calculator - Results</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');

        body,
        * {
            font-family: "Inter", sans-serif !important;
            font-size: 8px;
            line-height: 1.2;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Force everything to stay on one page */
        * {
            page-break-inside: avoid !important;
            page-break-before: avoid !important;
            page-break-after: avoid !important;
        }

        /* Additional page break prevention */
        html,
        body,
        .page-content,
        .main-table,
        .input-section,
        .results-section,
        .results-box,
        .footer {
            page-break-inside: avoid !important;
            page-break-before: avoid !important;
            page-break-after: avoid !important;
        }

        /* Force single page layout */
        @page {
            margin: 5mm;
            size: A4 landscape;
        }

        body {
            overflow: visible;
            height: auto;
            width: 100%;
            color: #000 !important
        }

        .info-icon {
            margin-left: 6px;
            vertical-align: text-bottom;
            display: inline-block;
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background-color: #6d7e93;
            color: white;
            font-size: 7px;
            text-align: center;
            line-height: 10px;
            font-weight: bold;
        }

        /* Container around the two‐column table */
        .page-content {
            margin: 10px auto;
            max-width: 1000px;
            padding: 30px;

        }

        /* Main two‐column layout */
        .main-table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
        }

        /* Prevent the row splitting across pages */
        .main-table tr {
            page-break-inside: avoid;
        }

        /* Left panel: input */
        .input-section {
            width: 75%;
            vertical-align: top;
            padding-right: 8px;
            height: 350px;
        }

        /* Right panel: results */
        .results-section {
            width: 25%;
            vertical-align: top;
            height: 350px;
        }

        /* Compact table styles */
        table {
            margin-bottom: 2px !important;
        }

        input[type="text"] {
            font-size: 8px !important;
            padding: 3px 4px !important;
            height: 14px !important;
        }

        label {
            font-size: 8px !important;
            vertical-align: baseline;
            display: inline;
        }

        /* Font weight helpers */
        .font-normal {
            font-weight: 400;
        }

        .font-medium {
            font-weight: 500;
        }

        .font-semibold {
            font-weight: 600;
        }

        .font-bold {
            font-weight: 700;
        }

        /* Text size helpers */
        .text-sm {
            font-size: 10px;
        }

        .text-base {
            font-size: 8px;
        }

        .text-lg {
            font-size: 12px;
        }

        .text-xl {
            font-size: 14px;
        }

        .text-2xl {
            font-size: 16px;
        }

        .text-3xl {
            font-size: 18px;
        }

        /* Results box styling */
        .results-box {
            padding: 8px;
            background-color: #fdffff;
            border: 1px solid #d3dbe6;
            width: 100%;
            height: 350px;
            box-sizing: border-box;
            overflow: hidden;
        }

        .results-box h2 {
            font-family: "Inter", sans-serif;
            font-size: 12px;
            margin-bottom: 3px;
            font-weight: 600;
        }

        .results-box .summary {
            font-family: "Inter", sans-serif;
            font-size: 8px;
            line-height: 1.2;
            margin-bottom: 8px;
        }

        .results-box .result-item {
            font-family: "Inter", sans-serif;
            margin-bottom: 8px;
        }

        .results-box .result-item label {
            font-family: "Inter", sans-serif;
            display: block;
            margin-bottom: 3px;
            font-weight: 500;
            font-size: 8px;
        }

        .results-box .result-value {
            font-family: "Inter", sans-serif;
            font-size: 8px;
            padding: 3px 4px;
            border: 1px solid #3FD4FF;
            width: 70px;
            text-align: right;
            background-color: #ffffff;
        }

        /* Footer styling */
        .footer {
            font-family: "Inter", sans-serif;
            font-size: 8px;
            margin-top: 6px;
            line-height: 1.0;
        }
    </style>
</head>

<body>
    <div class="page-content">
        <!-- Header -->
        <div style="text-align: left; margin-bottom: 5px;">
            @php
                $logoPath = public_path('assets/images/bitbio-logo.png');
                $logoBase64 = null;
                if (file_exists($logoPath)) {
                    $logoData = file_get_contents($logoPath);
                    $logoBase64 = 'data:image/png;base64,' . base64_encode($logoData);
                }
            @endphp

            @if ($logoBase64)
                <img src="{{ $logoBase64 }}" alt="bit.bio Logo"
                    style="width: 120px; height: 36px; margin-bottom: 6px; display: block;">
            @else
                <div
                    style="font-family: 'Inter', sans-serif; font-size: 16px; font-weight: 600; color: #2c3e50; margin-bottom: 3px;">
                    bit.bio
                </div>
            @endif

            <div style="font-family: 'Inter', sans-serif; font-size: 14px; font-weight: 600; color: #000;">
                Cell seeding calculator
            </div>
        </div>

        <!-- Two‐column table -->
        <table class="main-table">
            <tr>
                <!-- Input Section -->
                <td class="input-section">
                    <div
                        style="padding: 8px; background-color: #F3F5F9; box-sizing: border-box; height: 350px; overflow: hidden;">
                        <!-- Cell stock volume -->
                        <table
                            style="width: 100%; border-bottom: 1px solid white; border-collapse: collapse; margin-bottom: 2px;">
                            <tr>
                                <td style="width: 180px; vertical-align: top; padding: 2px 0;">
                                    <label style="font-size: 8px; font-weight: 400; color: #000000;">Cell stock
                                        volume* </label><span class="info-icon">i</span>
                                </td>
                                <td style="text-align: right; width: 70px; padding: 2px 0;">
                                    <input type="text"
                                        style="padding: 2px 4px; width: 70px; border: 1px solid #D4DBE6; background-color: #FEFFFF; font-size: 8px; font-weight: normal; text-align: right; font-family: 'Inter', sans-serif; height: 14px; box-sizing: border-box;"
                                        value="{{ $suspensionVolume ?? '' }}" readonly>
                                </td>
                                <td style="padding-left: 6px; padding: 2px 0;">
                                    <span
                                        style="font-size: 8px; color: #000000; font-weight: normal; margin-left: 4px;">mL</span>
                                </td>
                            </tr>
                        </table>

                        <!-- Live cell count -->
                        <table
                            style="width: 100%; border-bottom: 1px solid white; border-collapse: collapse; margin-bottom: 2px;">
                            <tr>
                                <td style="width: 180px; vertical-align: top; padding: 2px 0;">
                                    <label style="font-size: 8px; font-weight: 400; color: #000000;">Live cell
                                        count</label><span class="info-icon">i</span>
                                </td>
                                <td style="text-align: left; padding: 2px 0;">
                                    <table style="width: 100%; border-collapse: collapse;">
                                        <tr>
                                            <td style="width: 60px; padding-right: 4px;">
                                                <label style="font-size:9px; text-align: left;">Count 1*</label>
                                                <input type="text" value="{{ $count1 ?? '' }}" readonly
                                                    style="padding: 2px 4px; width: 70px; border: 1px solid #D4DBE6; background-color: #FEFFFF; font-size: 8px; font-weight: normal; text-align: right; font-family: 'Inter', sans-serif; height: 14px; box-sizing: border-box;">
                                            </td>
                                            <td style="width: 60px; padding: 0 4px;">
                                                <label style="font-size:9px; text-align: left;">Count 2</label>
                                                <input type="text" value="{{ $count2 ?? '' }}" readonly
                                                    style="padding: 2px 4px; width: 70px; border: 1px solid #D4DBE6; background-color: #FEFFFF; font-size: 8px; font-weight: normal; text-align: right; font-family: 'Inter', sans-serif; height: 14px; box-sizing: border-box;">
                                            </td>
                                            <td style="width: 60px; padding-left: 4px;">
                                                <label style="font-size:9px; text-align: left;">Count 3</label>
                                                <input type="text" value="{{ $count3 ?? '' }}" readonly
                                                    style="padding: 2px 4px; width: 70px; border: 1px solid #D4DBE6; background-color: #FEFFFF; font-size: 8px; font-weight: normal; text-align: right; font-family: 'Inter', sans-serif; height: 14px; box-sizing: border-box;">
                                            </td>
                                            <td style="vertical-align: bottom; padding-left: 8px;">
                                                <span style="font-size:9px;">× 10<sup>6</sup> cells/mL</span>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>

                        <!-- Cell viability -->
                        <table
                            style="width: 100%; border-bottom: 1px solid white; border-collapse: collapse; margin-bottom: 2px;">
                            <tr>
                                <td style="width: 180px; vertical-align: top; padding: 2px 0;">
                                    <label style="font-size: 8px; font-weight: 400; color: #000000;">Cell
                                        viability</label>
                                </td>
                                <td style="text-align: left; padding: 2px 0;">
                                    <table style="width: 100%; border-collapse: collapse;">
                                        <tr>
                                            <td style="width: 60px; padding-right: 4px;">
                                                <label style="font-size:9px; text-align: left;">Count 1*</label>
                                                <input type="text" value="{{ $viability1 ?? '' }}" readonly
                                                    style="padding: 2px 4px; width: 70px; border: 1px solid #D4DBE6; background-color: #FEFFFF; font-size: 8px; font-weight: normal; text-align: right; font-family: 'Inter', sans-serif; height: 14px; box-sizing: border-box;">
                                            </td>
                                            <td style="width: 60px; padding: 0 4px;">
                                                <label style="font-size:9px; text-align: left;">Count 2</label>
                                                <input type="text" value="{{ $viability2 ?? '' }}" readonly
                                                    style="padding: 2px 4px; width: 70px; border: 1px solid #D4DBE6; background-color: #FEFFFF; font-size: 8px; font-weight: normal; text-align: right; font-family: 'Inter', sans-serif; height: 14px; box-sizing: border-box;">
                                            </td>
                                            <td style="width: 60px; padding-left: 4px;">
                                                <label style="font-size:9px; text-align: left;">Count 3</label>
                                                <input type="text" value="{{ $viability3 ?? '' }}" readonly
                                                    style="padding: 2px 4px; width: 70px; border: 1px solid #D4DBE6; background-color: #FEFFFF; font-size: 8px; font-weight: normal; text-align: right; font-family: 'Inter', sans-serif; height: 14px; box-sizing: border-box;">
                                            </td>
                                            <td style="vertical-align: bottom; padding-left: 8px;">
                                                <span style="font-size:9px;">%</span>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>

                        <!-- Cell type -->
                        <table
                            style="width: 100%; border-bottom: 1px solid white; border-collapse: collapse; margin-bottom: 2px;">
                            <tr>
                                <td style="width: 180px; vertical-align: top; padding: 2px 0;">
                                    <label style="font-size: 8px; font-weight: 400; color: #000000;">Cell type</label>
                                </td>
                                <td style="text-align: left; padding: 2px 0;">
                                    <input type="text" value="{{ $cellType ?? '' }}" readonly
                                        style="padding: 2px 4px; width: 95%; border: 1px solid #D4DBE6; background-color: #FEFFFF; font-size: 8px; font-weight: normal; text-align: left; font-family: 'Inter', sans-serif; height: 14px; box-sizing: border-box;" />
                                </td>
                            </tr>
                        </table>

                        <!-- Seeding density -->
                        <table
                            style="width: 100%; border-bottom: 1px solid white; border-collapse: collapse; margin-bottom: 2px;">
                            <tr>
                                <td style="width: 180px; vertical-align: top; padding: 2px 0;">
                                    <label style="font-size: 8px; font-weight: 400; color: #000000;">Seeding
                                        density*</label><span class="info-icon">i</span>
                                </td>
                                <td style="text-align: right; width: 70px; padding: 2px 0;">
                                    <input type="text" value="{{ $seedingDensity ?? '' }}" readonly
                                        style="padding: 2px 4px; width: 70px; border: 1px solid #D4DBE6; background-color: #FEFFFF; font-size: 8px; font-weight: normal; text-align: right; font-family: 'Inter', sans-serif; height: 14px; box-sizing: border-box;">
                                </td>
                                <td style="padding-left: 6px; padding: 2px 0;">
                                    <span
                                        style="font-size: 8px; color: #000000; font-weight: normal; margin-left: 4px;">cells/cm²</span>
                                </td>
                            </tr>
                        </table>

                        <!-- Culture vessel -->
                        <table
                            style="width: 100%; border-bottom: 1px solid white; border-collapse: collapse; margin-bottom: 2px;">
                            <tr>
                                <td style="width: 180px; vertical-align: top; padding: 2px 0;">
                                    <label style="font-size: 8px; font-weight: 400; color: #000000;">Culture
                                        vessel</label><span class="info-icon">i</span>
                                </td>
                                <td style="text-align: left; padding: 2px 0;">
                                    <input type="text" value="{{ $cultureVessel ?? '' }}" readonly
                                        style="padding: 2px 4px; width: 95%; border: 1px solid #D4DBE6; background-color: #FEFFFF; font-size: 8px; font-weight: normal; text-align: left; font-family: 'Inter', sans-serif; height: 14px; box-sizing: border-box;" />
                                </td>
                            </tr>
                        </table>

                        <!-- Surface area -->
                        <table
                            style="width: 100%; border-bottom: 1px solid white; border-collapse: collapse; margin-bottom: 3px;">
                            <tr>
                                <td style="width: 180px; vertical-align: top; padding: 2px 0;">
                                    <label style="font-size: 8px; font-weight: 400; color: #000000;">Surface
                                        area*</label>
                                </td>
                                <td style="text-align: right; width: 70px; padding: 2px 0;">
                                    <input type="text" value="{{ $surfaceArea ?? '' }}" readonly
                                        style="padding: 2px 4px; width: 70px; border: 1px solid #D4DBE6; background-color: #FEFFFF; font-size: 8px; font-weight: normal; text-align: right; font-family: 'Inter', sans-serif; height: 14px; box-sizing: border-box;">
                                </td>
                                <td style="padding-left: 6px; padding: 2px 0;">
                                    <span
                                        style="font-size: 8px; color: #000000; font-weight: normal; margin-left: 4px;">cm²/well</span>
                                </td>
                            </tr>
                        </table>

                        <!-- Volume -->
                        <table
                            style="width: 100%; border-bottom: 1px solid white; border-collapse: collapse; margin-bottom: 2px;">
                            <tr>
                                <td style="width: 180px; vertical-align: top; padding: 2px 0;">
                                    <label style="font-size: 8px; font-weight: 400; color: #000000;">Volume*</label>
                                </td>
                                <td style="text-align: right; width: 70px; padding: 2px 0;">
                                    <input type="text" value="{{ $mediaVolume ?? '' }}" readonly
                                        style="padding: 2px 4px; width: 70px; border: 1px solid #D4DBE6; background-color: #FEFFFF; font-size: 8px; font-weight: normal; text-align: right; font-family: 'Inter', sans-serif; height: 14px; box-sizing: border-box;">
                                </td>
                                <td style="padding-left: 6px; padding: 2px 0;">
                                    <span
                                        style="font-size: 8px; color: #000000; font-weight: normal; margin-left: 4px;">mL/well</span>
                                </td>
                            </tr>
                        </table>

                        <!-- Number of wells to seed -->
                        <table
                            style="width: 100%; border-bottom: 1px solid white; border-collapse: collapse; margin-bottom: 2px;">
                            <tr>
                                <td style="width: 180px; vertical-align: top; padding: 2px 0;">
                                    <label style="font-size: 8px; font-weight: 400; color: #000000;">Number of wells to
                                        seed*</label>
                                </td>
                                <td style="text-align: right; width: 70px; padding: 2px 0;">
                                    <input type="text" value="{{ $wellCount ?? '' }}" readonly
                                        style="padding: 2px 4px; width: 70px; border: 1px solid #D4DBE6; background-color: #FEFFFF; font-size: 8px; font-weight: normal; text-align: right; font-family: 'Inter', sans-serif; height: 14px; box-sizing: border-box;">
                                </td>
                                <td style="padding-left: 6px; padding: 2px 0;">
                                    <span
                                        style="font-size: 8px; color: #000000; font-weight: normal; margin-left: 4px;">wells</span>
                                </td>
                            </tr>
                        </table>

                        <!-- Dead volume allowance -->
                        <table
                            style="width: 100%; border-bottom: 1px solid white; border-collapse: collapse; margin-bottom: 2px;">
                            <tr>
                                <td style="width: 180px; vertical-align: top; padding: 2px 0;">
                                    <label style="font-size: 8px; font-weight: 400; color: #000000;">Dead volume
                                        allowance</label><span class="info-icon">i</span>
                                </td>
                                <td style="text-align: right; width: 70px; padding: 2px 0;">
                                    <input type="text" value="{{ $buffer ?? '' }}" readonly
                                        style="padding: 2px 4px; width: 70px; border: 1px solid #D4DBE6; background-color: #FEFFFF; font-size: 8px; font-weight: normal; text-align: right; font-family: 'Inter', sans-serif; height: 14px; box-sizing: border-box;">
                                </td>
                                <td style="padding-left: 6px; padding: 2px 0;">
                                    <span
                                        style="font-size: 8px; color: #000000; font-weight: normal; margin-left: 4px;">%</span>
                                </td>
                            </tr>
                        </table>

                        <!-- Required field note -->
                        <div style="padding: 2px 0;">
                            <label style="font-size: 8px; font-weight: 400; color: #000000;">* Required field</label>
                        </div>
                    </div>
                </td>

                <!-- Results Section -->
                <td class="results-section">
                    <div class="results-box" style="height: 350px;">
                        <h2>Results</h2>

                        <!-- Narrative text section -->
                        <p
                            style="font-family: 'Inter', sans-serif; font-size: 8px; margin-bottom: 8px; line-height: 1.2;">
                            Your results for seeding <span>{{ $wellCount ?? '' }}</span> wells, prepare a dilution
                            by
                            combining <span>{{ $volumeToSeed ?? '' }}</span> mL of cell stock with
                            <span>{{ $volumeToDilute ?? '' }}</span> mL of media. Add
                            <span>{{ $volumePerWell ?? '' }}</span>
                            &micro;L of the final dilution to each well for a density of
                            <span>{!! $cellDensity ?? '' !!}</span>
                            cells/mL, resulting in <span>{{ $cellsPerWell ?? '' }}</span> cells per well.
                        </p>

                        <div class="result-item" style="font-family: 'Inter', sans-serif;">
                            <label>Volume of media for dilution</label>
                            <div class="result-value">
                                <span>{{ $volumeToDilute ?? '' }}</span> mL
                            </div>
                        </div>

                        <div class="result-item" style="font-family: 'Inter', sans-serif;">
                            <label>From your initial cell stock volume, pipette</label>
                            <div class="result-value">
                                <span>{{ $volumeToSeed ?? '' }}</span> mL
                            </div>
                        </div>

                        <div class="result-item" style="margin-bottom: 6px; font-family: 'Inter', sans-serif;">
                            <label>
                                Add <span>{{ $volumePerWell ?? '' }}</span> &micro;L of the final dilution to each well
                            </label>
                            <p
                                style="font-family: 'Inter', sans-serif; font-size:7px;color:#000;margin:3px 0 0;padding-top:3px;">
                                Review the values below and adjust if needed for your experiment
                            </p>
                        </div>

                        <div class="result-item" style="font-family: 'Inter', sans-serif;">
                            <label>Cell density</label>
                            <div
                                style="font-family: 'Inter', sans-serif; padding:3px 4px;border:1px solid #E4EAF0;width:100px;text-align:right;white-space:nowrap;font-size:8px;">
                                <span>{!! $cellDensity ?? '' !!}</span> cells/mL
                            </div>
                        </div>

                        <div class="result-item" style="font-family: 'Inter', sans-serif;">
                            <label>Required number of cells</label>
                            <table
                                style="width: 100%; border-collapse: separate; margin: auto; font-family: 'Inter', sans-serif;">
                                <tr>
                                    <td
                                        style="padding: 4px; border: 1px solid #E4EAF0; width: 50%; font-family: 'Inter', sans-serif;">
                                        <p
                                            style="margin: 0 0 2px; font-size: 7px; color: #000; font-family: 'Inter', sans-serif;">
                                            Total</p>
                                        <div style="font-size: 8px; font-family: 'Inter', sans-serif;">
                                            <span>{!! $requiredCells ?? '' !!}</span> cells
                                        </div>
                                    </td>
                                    <td
                                        style="padding: 4px; border: 1px solid #E4EAF0; width: 50%; font-family: 'Inter', sans-serif;">
                                        <p
                                            style="margin: 0 0 2px; font-size: 7px; color: #000; font-family: 'Inter', sans-serif;">
                                            Per well</p>
                                        <div style="font-size: 8px; font-family: 'Inter', sans-serif;">
                                            <span>{{ $cellsPerWell ?? '' }}</span> cells
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </td>
            </tr>
        </table>

        <!-- Footer -->
        <div class="footer">
            <p>If you have any questions, please contact us at technical@bit.bio.</p>
            <p>If you have any issues, please feedback to our team at technical@bit.bio.</p>
            <p style="margin-top: 5px">Please note that this calculator has been developed by bit.bio and provides
                standard guidance.</p>
            <p>bit.bio © {{ date('Y') }} | All rights reserved</p>
        </div>
    </div>
</body>

</html>
