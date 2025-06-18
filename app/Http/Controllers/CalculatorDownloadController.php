<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use Carbon\Carbon;
use DateTimeZone;

class CalculatorDownloadController extends Controller
{
    /**
     * Download calculator results as Excel file
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function downloadExcel(Request $request)
    {
        // Validate the incoming data
        $validated = $request->validate([
            'cellDensity'    => 'required|string',
            'cellsPerWell'   => 'required|string',
            'requiredCells'  => 'required|string',
            'volumeToDilute' => 'required|string',
            'volumeToSeed'   => 'required|string',
            'volumePerWell'  => 'required|string',
            'wellCount'      => 'required|string',
            'suspensionVolume' => 'nullable|string',
            'liveCellCount'    => 'nullable|string',
            'cellViability'    => 'nullable|string',
            'cellType'         => 'nullable|string',
            'seedingDensity'   => 'nullable|string',
            'cultureVessel'    => 'nullable|string',
            'surfaceArea'      => 'nullable|string',
            'mediaVolume'      => 'nullable|string',
            'buffer'           => 'nullable|string',
            'timezone'         => 'nullable|string',
            'count1'           => 'nullable|string',
            'count2'           => 'nullable|string',
            'count3'           => 'nullable|string',
            'viability1'       => 'nullable|string',
            'viability2'       => 'nullable|string',
            'viability3'       => 'nullable|string',
        ]);

        // Determine timezone: validate against PHP supported timezones
        $tzInput = $validated['timezone'] ?? null;
        $timezone = config('app.timezone', 'UTC'); // fallback default
        if (!empty($tzInput)) {
            try {
                // Validate timezone by attempting to create DateTimeZone
                new DateTimeZone($tzInput);
                $timezone = $tzInput;
            } catch (\Exception $e) {
                // Invalid timezone, use default
            }
        }

        // Create new spreadsheet
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $spreadsheet->getDefaultStyle()->getFont()->setName('Arial');


        // Add logo image instead of text
        $drawing = new Drawing();
        $drawing->setName('Logo');
        $drawing->setDescription('bit.bio Logo');
        $drawing->setPath(public_path('assets/images/bitbio-logo.png'));
        $drawing->setCoordinates('A1');
        $drawing->setHeight(25);
        $drawing->setOffsetX(10);
        $drawing->setOffsetY(10);
        $drawing->setWorksheet($spreadsheet->getActiveSheet());
        $sheet->getRowDimension(1)->setRowHeight(35);

        // Center Cell seeding calculator title
        $sheet->setCellValue('A2', 'Cell seeding calculator');
        $sheet->mergeCells('A2:C2');
        $sheet->getStyle('A2')->getFont()->setBold(true)->setSize(14);
        $sheet->getStyle('A2')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);


        // Generate now timestamp in user's timezone
        $now = Carbon::now($timezone);
        // Format e.g. "17-06-2025 - 2:28 PM"
        // Note: to avoid invalid filename characters (":"), replace ":" with "-" in time.
        $datePart = $now->format('d-m-Y');
        $timePart = $now->format('g:i A'); // e.g. "2:28 PM"
        // Replace colon for filename safety:
        $safeTimePart = str_replace(':', '-', $timePart); // yields "2-28 PM"
        $formattedTimestamp = "{$datePart} - {$safeTimePart}";
        $formattedDate = $now->format('Y-m-d H:i:s');

        // Add generation timestamp (moved from A3 to A4)
        $sheet->setCellValue('A4', 'Generated on: ' . $formattedDate);
        $sheet->mergeCells('A4:C4');
        $sheet->getStyle('A4')->getFont()->setSize(9);

        // Two blank rows added after the timestamp (A5 and A6)

        // Set up section headings and columns
        // INPUT DATA SECTION (shifted from A5 to A8)
        $sheet->setCellValue('A8', 'Input data');
        $sheet->setCellValue('B8', 'Value');
        $sheet->setCellValue('C8', 'Unit');
        $sheet->getStyle('A8:C8')->getFont()->setBold(true)->setSize(14);

        // Input Data headers (all shifted by 3 rows)
        $sheet->setCellValue('A9', 'Cell stock volume');
        $sheet->setCellValue('B9', $validated['suspensionVolume'] ?? '');
        $sheet->setCellValue('C9', 'mL');

        // Live cell counts - now correctly handling all three counts
        $sheet->setCellValue('A10', 'Live cell count - 1');
        $sheet->setCellValue('B10', $this->formatCellCount($validated['count1'] ?? ''));
        $sheet->setCellValue('C10', 'cells/mL');

        $sheet->setCellValue('A11', 'Live cell count - 2');
        $sheet->setCellValue('B11', $this->formatCellCount($validated['count2'] ?? ''));
        $sheet->setCellValue('C11', 'cells/mL');

        $sheet->setCellValue('A12', 'Live cell count - 3');
        $sheet->setCellValue('B12', $this->formatCellCount($validated['count3'] ?? ''));
        $sheet->setCellValue('C12', 'cells/mL');

        // Cell viability - now correctly handling all three viability values
        $sheet->setCellValue('A13', 'Cell viability - 1');
        $sheet->setCellValue('B13', $validated['viability1'] ?? '');
        $sheet->setCellValue('C13', '%');

        $sheet->setCellValue('A14', 'Cell viability - 2');
        $sheet->setCellValue('B14', $validated['viability2'] ?? '');
        $sheet->setCellValue('C14', '%');

        $sheet->setCellValue('A15', 'Cell viability - 3');
        $sheet->setCellValue('B15', $validated['viability3'] ?? '');
        $sheet->setCellValue('C15', '%');

        // Other inputs
        $sheet->setCellValue('A16', 'Cell type');
        $sheet->setCellValue('B16', $validated['cellType'] ?? '');
        $sheet->setCellValue('C16', '');

        $sheet->setCellValue('A17', 'Seeding density');
        $sheet->setCellValue('B17', $validated['seedingDensity'] ?? '');
        $sheet->setCellValue('C17', 'cells/cm²');

        $sheet->setCellValue('A18', 'Culture vessel');
        $sheet->setCellValue('B18', $validated['cultureVessel'] ?? '');
        $sheet->setCellValue('C18', '');

        $sheet->setCellValue('A19', 'Surface area');
        $sheet->setCellValue('B19', $validated['surfaceArea'] ?? '');
        $sheet->setCellValue('C19', 'cm²/well');

        $sheet->setCellValue('A20', 'Volume');
        $sheet->setCellValue('B20', $validated['mediaVolume'] ?? '');
        $sheet->setCellValue('C20', 'mL/well');

        $sheet->setCellValue('A21', 'Number of wells to seed');
        $sheet->setCellValue('B21', $validated['wellCount'] ?? '');
        $sheet->setCellValue('C21', 'wells');

        $sheet->setCellValue('A22', 'Dead volume allowance');
        $sheet->setCellValue('B22', $validated['buffer'] ?? '');
        $sheet->setCellValue('C22', '%');

        // RESULTS SECTION (shifted from A21 to A24)
        $sheet->setCellValue('A24', 'Results');
        $sheet->setCellValue('B24', 'Value');
        $sheet->setCellValue('C24', 'Unit');
        $sheet->getStyle('A24:C24')->getFont()->setBold(true)->setSize(14);

        // Results data (shifted by 3 rows)
        $sheet->setCellValue('A25', 'Volume of media for final seeding solution');
        $sheet->setCellValue('B25', $validated['volumeToDilute'] ?? '');
        $sheet->setCellValue('C25', 'mL');

        $sheet->setCellValue('A26', 'Cell stock volume for final seeding solution');
        $sheet->setCellValue('B26', $validated['volumeToSeed'] ?? '');
        $sheet->setCellValue('C26', 'mL');

        $sheet->setCellValue('A27', 'Cell density');
        $sheet->setCellValue('B27', $this->cleanScientificNotation($validated['cellDensity'] ?? ''));
        $sheet->setCellValue('C27', 'cells/mL');

        $sheet->setCellValue('A28', 'Required number of cells (total)');
        $sheet->setCellValue('B28', $this->cleanScientificNotation($validated['requiredCells'] ?? ''));
        $sheet->setCellValue('C28', 'cells');

        $sheet->setCellValue('A29', 'Required number of cells (per well)');
        $sheet->setCellValue('B29', $this->cleanHtml($validated['cellsPerWell'] ?? ''));
        $sheet->setCellValue('C29', 'cells');

        // Adjust column widths
        $sheet->getColumnDimension('A')->setWidth(40);
        $sheet->getColumnDimension('B')->setWidth(15);
        $sheet->getColumnDimension('C')->setWidth(12);

        // Add borders (updated ranges)
        $borderRange = 'A9:C22';
        $sheet->getStyle($borderRange)->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);

        $resultBorderRange = 'A25:C29';
        $sheet->getStyle($resultBorderRange)->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);

        // Right-align all values in column B (except headers) (updated ranges)
        $sheet->getStyle('B9:B22')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);
        $sheet->getStyle('B25:B29')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);

        // Set font size for data cells to 11 (updated ranges)
        $sheet->getStyle('A9:C22')->getFont()->setSize(11);
        $sheet->getStyle('A25:C29')->getFont()->setSize(11);

        // Add 2 blank rows before the copyright footer

        // Add copyright footer (shifted by 5 rows from original position)
        $sheet->setCellValue('A33', 'By using this tool, you agree to bit.bio\'s Cell seeding calculator - Terms and Conditions.');
        $sheet->setCellValue('A34', 'bit.bio © ' . date('Y'));
        $sheet->getStyle('A33:A34')->getFont()->setSize(9);

        // Generate a filename with the requested format
        // e.g. "bit.bio - Cell Seeding Calculation - 17-06-2025 - 2-28 PM.xlsx"
        $filename = 'bit.bio - Cell Seeding Calculation - ' . $formattedTimestamp . '.xlsx';

        // Create a temporary file
        $tempFilePath = tempnam(sys_get_temp_dir(), 'excel_');
        $writer = new Xlsx($spreadsheet);
        $writer->save($tempFilePath);

        // Return the file as a download
        return response()->download($tempFilePath, $filename, [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        ])->deleteFileAfterSend();
    }

    /**
     * Clean HTML tags from a string
     *
     * @param string $value
     * @return string
     */
    private function cleanHtml($value)
    {
        return strip_tags($value);
    }

    /**
     * Format cell count to match expected format with comma separators
     *
     * @param string $value
     * @return string
     */
    private function formatCellCount($value)
    {
        // If empty or not set, return empty string
        if (empty($value)) {
            return '';
        }

        // Remove any existing commas first
        $cleanValue = str_replace(',', '', $value);

        // Handle scientific notation like 1.2E6 or 1.2e6
        if (preg_match('/([0-9.]+)[eE]([+-]?[0-9]+)/', $cleanValue, $matches)) {
            $base = (float)$matches[1];
            $exponent = (int)$matches[2];
            $fullNumber = $base * pow(10, $exponent);
            return number_format((float)$fullNumber);
        }

        // Handle "x 10^n" format
        if (preg_match('/([0-9.]+)\s*x\s*10\^?([0-9]+)/', $cleanValue, $matches)) {
            $base = (float)$matches[1];
            $exponent = (int)$matches[2];
            $fullNumber = $base * pow(10, $exponent);
            return number_format((float)$fullNumber);
        }

        // If it's a plain number in string form, multiply by 1,000,000 since UI shows "x 10^6"
        if (is_numeric($cleanValue)) {
            // Multiply by 10^6 since the UI shows cell counts in millions
            $fullNumber = (float)$cleanValue * 1000000;
            return number_format($fullNumber);
        }

        // If we can't parse it, just return as is
        return $value;
    }

    /**
     * Clean scientific notation with HTML superscripts or Unicode superscripts to proper format with comma separators
     *
     * @param string $value
     * @return string
     */
    private function cleanScientificNotation($value)
    {
        // First, handle HTML superscript format like "6.17 x 10<sup>6</sup>"
        if (preg_match('/([0-9.]+)\s*x\s*10\<sup\>([+-]?[0-9]+)\<\/sup\>/', $value, $matches)) {
            $base = (float)$matches[1];    // e.g., 6.17
            $exponent = (int)$matches[2];  // e.g., 6

            // Convert to a full number (base * 10^exponent)
            $fullNumber = $base * pow(10, $exponent);

            // Format with comma separators, no decimals for whole numbers
            return number_format($fullNumber, 0);
        }

        // Handle Unicode superscript format like "1.23 x 10⁶"
        if (preg_match('/([0-9.]+)\s*x\s*10([⁰¹²³⁴⁵⁶⁷⁸⁹]+)/', $value, $matches)) {
            $base = (float)$matches[1];
            $superscriptExp = $matches[2];

            // Map Unicode superscript characters back to regular numbers
            $superscriptMap = [
                '⁰' => '0',
                '¹' => '1',
                '²' => '2',
                '³' => '3',
                '⁴' => '4',
                '⁵' => '5',
                '⁶' => '6',
                '⁷' => '7',
                '⁸' => '8',
                '⁹' => '9'
            ];

            // Convert superscript exponent to regular number
            $exponent = '';
            for ($i = 0; $i < mb_strlen($superscriptExp); $i++) {
                $char = mb_substr($superscriptExp, $i, 1);
                $exponent .= $superscriptMap[$char] ?? '';
            }
            $exponent = (int)$exponent;

            // Convert to a full number (base * 10^exponent)
            $fullNumber = $base * pow(10, $exponent);

            // Format with comma separators, no decimals for whole numbers
            return number_format($fullNumber, 0);
        }

        // Handle regular scientific notation like "1.23E+06" or "1.23e+06"
        if (preg_match('/([0-9.]+)[eE]([+-]?[0-9]+)/', $value, $matches)) {
            $base = (float)$matches[1];
            $exponent = (int)$matches[2];

            $fullNumber = $base * pow(10, $exponent);
            return number_format($fullNumber, 0);
        }

        // If it's just a plain number, format it with commas
        if (is_numeric($value)) {
            return number_format((float)$value, 0);
        }

        // If no match, just remove HTML tags and return as-is
        return strip_tags($value);
    }
}
