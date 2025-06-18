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

        // Add generation timestamp
        $sheet->setCellValue('A3', 'Generated on: ' . $formattedDate);
        $sheet->mergeCells('A3:C3');
        $sheet->getStyle('A3')->getFont()->setSize(9);


        // Set up section headings and columns
        // INPUT DATA SECTION
        $sheet->setCellValue('A5', 'Input data');
        $sheet->setCellValue('B5', 'Value');
        $sheet->setCellValue('C5', 'Unit');
        $sheet->getStyle('A5:C5')->getFont()->setBold(true)->setSize(14);

        // Input Data headers
        $sheet->setCellValue('A6', 'Cell stock volume');
        $sheet->setCellValue('B6', $validated['suspensionVolume'] ?? '');
        $sheet->setCellValue('C6', 'mL');

        // Live cell counts
        $sheet->setCellValue('A7', 'Live cell count - 1');
        $sheet->setCellValue('B7', $this->formatCellCount($validated['liveCellCount'] ?? ''));
        $sheet->setCellValue('C7', 'cells/mL');

        $sheet->setCellValue('A8', 'Live cell count - 2');
        $sheet->setCellValue('B8', '');  // This would be empty if count2 is not provided
        $sheet->setCellValue('C8', 'cells/mL');

        $sheet->setCellValue('A9', 'Live cell count - 3');
        $sheet->setCellValue('B9', '');  // This would be empty if count3 is not provided
        $sheet->setCellValue('C9', 'cells/mL');

        // Cell viability
        $sheet->setCellValue('A10', 'Cell viability - 1');
        $sheet->setCellValue('B10', $validated['cellViability'] ?? '');
        $sheet->setCellValue('C10', '%');

        $sheet->setCellValue('A11', 'Cell viability - 2');
        $sheet->setCellValue('B11', '');  // This would be empty if viability2 is not provided
        $sheet->setCellValue('C11', '%');

        $sheet->setCellValue('A12', 'Cell viability - 3');
        $sheet->setCellValue('B12', '');  // This would be empty if viability3 is not provided
        $sheet->setCellValue('C12', '%');

        // Other inputs
        $sheet->setCellValue('A13', 'Cell type');
        $sheet->setCellValue('B13', $validated['cellType'] ?? '');
        $sheet->setCellValue('C13', '');

        $sheet->setCellValue('A14', 'Seeding density');
        $sheet->setCellValue('B14', $validated['seedingDensity'] ?? '');
        $sheet->setCellValue('C14', 'cells/cm²');

        $sheet->setCellValue('A15', 'Culture vessel');
        $sheet->setCellValue('B15', $validated['cultureVessel'] ?? '');
        $sheet->setCellValue('C15', '');

        $sheet->setCellValue('A16', 'Surface area');
        $sheet->setCellValue('B16', $validated['surfaceArea'] ?? '');
        $sheet->setCellValue('C16', 'cm²/well');

        $sheet->setCellValue('A17', 'Volume');
        $sheet->setCellValue('B17', $validated['mediaVolume'] ?? '');
        $sheet->setCellValue('C17', 'mL/well');

        $sheet->setCellValue('A18', 'Number of wells to seed');
        $sheet->setCellValue('B18', $validated['wellCount'] ?? '');
        $sheet->setCellValue('C18', 'wells');

        $sheet->setCellValue('A19', 'Dead volume allowance');
        $sheet->setCellValue('B19', $validated['buffer'] ?? '');
        $sheet->setCellValue('C19', '%');

        // RESULTS SECTION
        $sheet->setCellValue('A21', 'Results');
        $sheet->setCellValue('B21', 'Value');
        $sheet->setCellValue('C21', 'Unit');
        $sheet->getStyle('A21:C21')->getFont()->setBold(true)->setSize(14);

        // Results data
        $sheet->setCellValue('A22', 'Volume of media for final seeding solution');
        $sheet->setCellValue('B22', $validated['volumeToDilute'] ?? '');
        $sheet->setCellValue('C22', 'mL');

        $sheet->setCellValue('A23', 'Cell stock volume for final seeding solution');
        $sheet->setCellValue('B23', $validated['volumeToSeed'] ?? '');
        $sheet->setCellValue('C23', 'mL');

        $sheet->setCellValue('A24', 'Cell density');
        $sheet->setCellValue('B24', $this->cleanScientificNotation($validated['cellDensity'] ?? ''));
        $sheet->setCellValue('C24', 'cells/mL');

        $sheet->setCellValue('A25', 'Required number of cells (total)');
        $sheet->setCellValue('B25', $this->cleanScientificNotation($validated['requiredCells'] ?? ''));
        $sheet->setCellValue('C25', 'cells');

        $sheet->setCellValue('A26', 'Required number of cells (per well)');
        $sheet->setCellValue('B26', $this->cleanHtml($validated['cellsPerWell'] ?? ''));
        $sheet->setCellValue('C26', 'cells');

        // Adjust column widths
        $sheet->getColumnDimension('A')->setWidth(40);
        $sheet->getColumnDimension('B')->setWidth(15);
        $sheet->getColumnDimension('C')->setWidth(12);

        // Add borders
        $borderRange = 'A6:C19';
        $sheet->getStyle($borderRange)->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);

        $resultBorderRange = 'A22:C26';
        $sheet->getStyle($resultBorderRange)->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);

        // Right-align all values in column B (except headers)
        $sheet->getStyle('B6:B19')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);
        $sheet->getStyle('B22:B26')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);

        // Set font size for data cells to 11
        $sheet->getStyle('A6:C19')->getFont()->setSize(11);
        $sheet->getStyle('A22:C26')->getFont()->setSize(11);

        // Add copyright footer
        $sheet->setCellValue('A28', 'By using this tool, you agree to bit.bio\'s Cell seeding calculator - Terms and Conditions.');
        $sheet->setCellValue('A29', 'bit.bio © ' . date('Y'));
        $sheet->getStyle('A28:A29')->getFont()->setSize(9);

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
     * Format cell count to match expected format
     *
     * @param string $value
     * @return string
     */
    private function formatCellCount($value)
    {
        // If value contains scientific notation like 1.2E6, convert to 1,200,000
        if (is_numeric($value)) {
            return number_format((float)$value);
        }

        return $value;
    }

    /**
     * Clean scientific notation with HTML superscripts to proper format
     *
     * @param string $value
     * @return string
     */
    private function cleanScientificNotation($value)
    {
        // Match pattern like "6.17 x 10<sup>0</sup>" or "6.02 x 10<sup>6</sup>"
        if (preg_match('/([0-9.]+)\s*x\s*10\<sup\>([+-]?[0-9]+)\<\/sup\>/', $value, $matches)) {
            $base = $matches[1];    // e.g., 6.17
            $exponent = $matches[2]; // e.g., 0 or 6

            // Format in scientific notation that Excel can understand
            return $base . 'E' . $exponent;
        }

        // If no match, just remove HTML tags
        return strip_tags($value);
    }
}
