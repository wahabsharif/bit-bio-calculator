<?php

namespace App\Http\Controllers;

use App\Models\CultureVessel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use Illuminate\Database\QueryException;

class CultureVesselController extends Controller
{
    // Get all culture vessels, sorted alphabetically by plate_format (case-insensitive)
    public function index(Request $request)
    {
        // Use LOWER to ensure case-insensitive sort
        $vessels = CultureVessel::orderByRaw('LOWER(plate_format)')->get();

        // return JSON if this is an AJAX request
        if ($request->ajax() || $request->wantsJson()) {
            return response()->json($vessels);
        }

        return view('culture-vessels', compact('vessels'));
    }

    // Dashboard index method, sorted alphabetically by plate_format (case-insensitive)
    public function dashboardIndex()
    {
        $vessels = CultureVessel::orderByRaw('LOWER(plate_format)')->get();
        return view('dashboard.culture-vessels', compact('vessels'));
    }

    // Get a single culture vessel by ID
    public function show($id)
    {
        $vessel = CultureVessel::find($id);

        if (!$vessel) {
            return response()->json(['message' => 'Culture vessel not found'], 404);
        }

        return response()->json($vessel);
    }

    // Store a new culture vessel
    public function store(Request $request)
    {
        $validated = $request->validate([
            'plate_format' => 'required|string|max:50',
            'surface_area_cm2' => 'required|numeric|min:0',
            'media_volume_per_well_ml' => 'required|numeric|min:0',
        ]);

        CultureVessel::create($validated);

        return redirect()->route('dashboard.culture-vessels')
            ->with('success', 'Culture vessel created successfully!');
    }

    // Update the specified culture vessel
    public function update(Request $request, $id)
    {
        $vessel = CultureVessel::findOrFail($id);

        $validated = $request->validate([
            'plate_format' => 'required|string|max:50',
            'surface_area_cm2' => 'required|numeric|min:0',
            'media_volume_per_well_ml' => 'required|numeric|min:0',
        ]);

        $vessel->update($validated);

        // Check if request came from dashboard and redirect accordingly
        if (str_contains(url()->previous(), 'dashboard')) {
            return redirect()->route('dashboard.culture-vessels')
                ->with('success', 'Culture vessel updated successfully!');
        }

        return redirect()->route('culture-vessels.index')
            ->with('success', 'Culture vessel updated successfully!');
    }

    // Delete the specified culture vessel
    public function destroy($id)
    {
        $vessel = CultureVessel::findOrFail($id);
        $vessel->delete();

        return redirect()->route('dashboard.culture-vessels')
            ->with('success', 'Culture vessel deleted successfully!');
    }

    public function import(Request $request)
    {
        $request->validate([
            'import_file' => 'required|file|mimes:xlsx,xls,csv'
        ]);

        $file = $request->file('import_file');

        try {
            // Validate and process the imported data
            $importedData = $this->processImportedData($file);

            if (empty($importedData)) {
                return redirect()->back()
                    ->with('error', 'No valid data found in the imported file.');
            }

            // Bulk update or insert culture-vessels
            $importedCount = 0;
            $updatedCount = 0;

            foreach ($importedData as $cultureVesselData) {
                $vessel = CultureVessel::updateOrCreate(
                    ['plate_format' => $cultureVesselData['plate_format']],
                    $cultureVesselData
                );

                if ($vessel->wasRecentlyCreated) {
                    $importedCount++;
                } else {
                    $updatedCount++;
                }
            }

            $message = "Import completed! Created: {$importedCount}, Updated: {$updatedCount}";

            return redirect()->route('dashboard.culture-vessels')
                ->with('success', $message);
        } catch (QueryException $e) {
            // Format database errors in a user-friendly way
            $errorMessage = $this->formatDatabaseError($e);
            return redirect()->back()
                ->with('error', $errorMessage);
        } catch (\Exception $e) {
            // Handle other errors
            return redirect()->back()
                ->with('error', 'Error importing culture vessels: ' . $this->simplifyErrorMessage($e->getMessage()));
        }
    }

    /**
     * Format database errors in a user-friendly way
     */
    private function formatDatabaseError(QueryException $e): string
    {
        $message = $e->getMessage();

        // Handle numeric value out of range error
        if (strpos($message, 'Numeric value out of range') !== false) {
            if (strpos($message, 'surface_area_cm2') !== false) {
                return 'One or more surface area values are too large. Please use smaller numbers.';
            }
            if (strpos($message, 'media_volume_per_well_ml') !== false) {
                return 'One or more media volume values are too large. Please use smaller numbers.';
            }
            return 'One or more numeric values are too large. Please use smaller numbers.';
        }

        // Handle duplicate entry error
        if (strpos($message, 'Duplicate entry') !== false) {
            return 'One or more vessels have duplicate plate formats. Each vessel must have a unique format.';
        }

        // Generic database error
        return 'Database error while importing vessels. Please check your data and try again.';
    }

    /**
     * Simplify error messages by removing technical details
     */
    private function simplifyErrorMessage(string $message): string
    {
        // Remove HTML entities
        $message = html_entity_decode($message);

        // Remove SQL query details if present
        if (strpos($message, 'SQL:') !== false) {
            $message = substr($message, 0, strpos($message, 'SQL:'));
        }

        return trim($message);
    }

    // Fixed helper method to process imported data
    private function processImportedData($file)
    {
        $importedData = [];

        try {
            // Read the file using PhpSpreadsheet
            $spreadsheet = IOFactory::load($file->getPathname());
            $worksheet = $spreadsheet->getActiveSheet();
            $highestRow = $worksheet->getHighestRow();

            // Skip header row and process data
            for ($row = 2; $row <= $highestRow; $row++) {
                // Get row data - adjust column letters based on your Excel structure
                $plateFormat = $worksheet->getCell('A' . $row)->getCalculatedValue();
                $surfaceArea = $worksheet->getCell('B' . $row)->getCalculatedValue();
                $mediaVolume = $worksheet->getCell('C' . $row)->getCalculatedValue();

                // Skip empty rows
                if (empty($plateFormat) && empty($surfaceArea) && empty($mediaVolume)) {
                    continue;
                }

                // Clean and prepare data
                $cultureVesselData = [
                    'plate_format' => trim($plateFormat),
                    'surface_area_cm2' => is_numeric($surfaceArea) ? (float)$surfaceArea : null,
                    'media_volume_per_well_ml' => is_numeric($mediaVolume) ? (float)$mediaVolume : null
                ];

                // Validate each row
                $rowValidator = Validator::make($cultureVesselData, [
                    'plate_format' => 'required|string|max:50',
                    'surface_area_cm2' => 'required|numeric|min:0',
                    'media_volume_per_well_ml' => 'required|numeric|min:0',
                ]);

                if (!$rowValidator->fails()) {
                    $importedData[] = $cultureVesselData;
                } else {
                    // Log validation errors for debugging
                    Log::warning("Row {$row} validation failed", [
                        'data' => $cultureVesselData,
                        'errors' => $rowValidator->errors()->toArray()
                    ]);
                }
            }
        } catch (\Exception $e) {
            Log::error('Error processing imported file: ' . $e->getMessage());
            throw new \Exception('Error reading the imported file. Please check the file format.');
        }

        return $importedData;
    }

    // New method for Excel export, sorted alphabetically by plate_format (case-insensitive)
    public function export()
    {
        // Sort by plate_format case-insensitive
        $cultureVessels = CultureVessel::orderByRaw('LOWER(plate_format)')->get();

        // Prepare spreadsheet
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set headers
        $sheet->setCellValue('A1', 'Plate Format');
        $sheet->setCellValue('B1', 'Surface area (cm2)');
        $sheet->setCellValue('C1', 'Media volume/well (mL)');

        // Format headers - make them bold with font size 12
        $sheet->getStyle('A1:C1')->getFont()->setBold(true)->setSize(12);

        // Add data rows
        $row = 2;
        foreach ($cultureVessels as $cultureVessel) {
            $sheet->setCellValue('A' . $row, $cultureVessel->plate_format);
            $sheet->setCellValue('B' . $row, $cultureVessel->surface_area_cm2);
            $sheet->setCellValue('C' . $row, $cultureVessel->media_volume_per_well_ml);
            $row++;
        }

        // Auto-size columns to fit content
        foreach (range('A', 'C') as $column) {
            $sheet->getColumnDimension($column)->setAutoSize(true);
        }

        // Create Excel file
        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');

        // Generate a unique filename
        $filename = 'culture_vessel_export_' . date('Y-m-d_H-i-s') . '.xlsx';

        // Send headers and output
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
        $writer->save('php://output');
        exit;
    }
}
