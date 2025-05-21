<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

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
            'cellDensity' => 'required|string',
            'cellsPerWell' => 'required|string',
            'requiredCells' => 'required|string',
            'volumeToDilute' => 'required|string',
            'volumeToSeed' => 'required|string',
            'volumePerWell' => 'required|string',
            'wellCount' => 'required|string',
            'suspensionVolume' => 'nullable|string',
            'liveCellCount' => 'nullable|string',
            'cellViability' => 'nullable|string',
            'cellType' => 'nullable|string',
            'seedingDensity' => 'nullable|string',
            'cultureVessel' => 'nullable|string',
            'surfaceArea' => 'nullable|string',
            'mediaVolume' => 'nullable|string',
            'buffer' => 'nullable|string',
        ]);

        // Create new spreadsheet
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set title and styling
        $sheet->setCellValue('A1', 'bit.bio Cell Seeding Calculator Results');
        $sheet->mergeCells('A1:C1');
        $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(14);
        $sheet->getStyle('A1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        // Add generation timestamp
        $sheet->setCellValue('A2', 'Generated on: ' . now()->toDateTimeString());
        $sheet->mergeCells('A2:C2');
        $sheet->getStyle('A2')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);

        // Add experiment info
        $sheet->setCellValue('A4', 'Results for seeding of ' . $validated['wellCount'] . ' wells');
        $sheet->mergeCells('A4:C4');
        $sheet->getStyle('A4')->getFont()->setBold(true);

        // Set column headers
        $sheet->setCellValue('A6', 'Metric');
        $sheet->setCellValue('B6', 'Value');
        $sheet->setCellValue('C6', 'Unit');
        $sheet->getStyle('A6:C6')->getFont()->setBold(true);
        $sheet->getStyle('A6:C6')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('E9EFFD');

        // Clean HTML tags from values
        $cellDensity = $this->cleanScientificNotation($validated['cellDensity']);
        $requiredCells = $this->cleanScientificNotation($validated['requiredCells']);
        $cellsPerWell = $this->cleanHtml($validated['cellsPerWell']);
        $volumeToDilute = $this->cleanHtml($validated['volumeToDilute']);
        $volumeToSeed = $this->cleanHtml($validated['volumeToSeed']);
        $volumePerWell = $this->cleanHtml($validated['volumePerWell']);

        // Add data rows
        $sheet->setCellValue('A7', 'Volume of media for dilution');
        $sheet->setCellValue('B7', $volumeToDilute);
        $sheet->setCellValue('C7', 'mL');

        $sheet->setCellValue('A8', 'From your initial cell stock volume, pipette');
        $sheet->setCellValue('B8', $volumeToSeed);
        $sheet->setCellValue('C8', 'mL');

        $sheet->setCellValue('A9', 'Add to each well');
        $sheet->setCellValue('B9', $volumePerWell);
        $sheet->setCellValue('C9', 'μL of the final dilution');

        $sheet->setCellValue('A10', 'Cell density');
        $sheet->setCellValue('B10', $cellDensity);
        $sheet->setCellValue('C10', 'cells/mL');

        $sheet->setCellValue('A11', 'Required number of cells (total)');
        $sheet->setCellValue('B11', $requiredCells);
        $sheet->setCellValue('C11', 'cells');

        $sheet->setCellValue('A12', 'Cells per well');
        $sheet->setCellValue('B12', $cellsPerWell);
        $sheet->setCellValue('C12', 'cells');

        // Add styling
        $sheet->getStyle('A6:C12')->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);

        // Add blue background to specific cells
        $sheet->getStyle('B7:B9')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('EBF3FF');
        $sheet->getStyle('B10:B12')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('EBF3FF');

        // Auto-size columns
        $sheet->getColumnDimension('A')->setAutoSize(true);
        $sheet->getColumnDimension('B')->setAutoSize(true);
        $sheet->getColumnDimension('C')->setAutoSize(true);

        // Create Excel file
        $writer = new Xlsx($spreadsheet);

        // Generate a unique filename
        $filename = 'bit_bio_seeding_calculator_' . date('Y-m-d_H-i-s') . '.xlsx';

        // Create a temporary file
        $tempFilePath = tempnam(sys_get_temp_dir(), 'excel_');
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
     * Clean scientific notation with HTML superscripts to proper format
     *
     * @param string $value
     * @return string
     */
    private function cleanScientificNotation($value)
    {
        // Match pattern like "6.17 x 10<sup>0</sup>" or "6.02 x 10<sup>6</sup>"
        if (preg_match('/([0-9.]+)\s*x\s*10\<sup\>([+-]?[0-9]+)\<\/sup\>/', $value, $matches)) {
            $base = $matches[1]; // e.g., 6.17
            $exponent = $matches[2]; // e.g., 0 or 6

            // Format in scientific notation that Excel can understand
            return $base . 'E' . $exponent;
        }

        // If no match, just remove HTML tags
        return strip_tags($value);
    }
}
