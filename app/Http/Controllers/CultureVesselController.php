<?php

namespace App\Http\Controllers;

use App\Models\CultureVessel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CultureVesselController extends Controller
{
    // Get all culture vessels
    public function index(Request $request)
    {
        $vessels = CultureVessel::orderBy('updated_at', 'desc')->get();

        // return JSON if this is an AJAX request
        if ($request->ajax() || $request->wantsJson()) {
            return response()->json($vessels);
        }

        return view('culture-vessels', compact('vessels'));
    }



    // Dashboard index method, ordered by updated_at desc
    public function dashboardIndex()
    {
        $vessels = CultureVessel::orderBy('updated_at', 'desc')->get();
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

            // Bulk update or insert culture-vessels
            foreach ($importedData as $cultureVesselData) {
                CultureVessel::updateOrCreate(
                    ['plate_format' => $cultureVesselData['plate_format']],
                    $cultureVesselData
                );
            }

            return redirect()->route('dashboard.culture-vessels')
                ->with('success', count($importedData) . ' Culture Vessels imported successfully!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error importing culture-vessels: ' . $e->getMessage());
        }
    }

    // Helper method to process imported data
    private function processImportedData($file)
    {
        $importedData = [];

        // Validate file and extract data
        $validator = Validator::make(
            ['file' => $file],
            ['file' => 'required|file|mimes:xlsx,xls,csv']
        );

        if ($validator->fails()) {
            throw new \Exception('Invalid file type');
        }

        // Read the file
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($file);
        $worksheet = $spreadsheet->getActiveSheet();
        $highestRow = $worksheet->getHighestRow();
        $highestColumn = $worksheet->getHighestColumn();

        // Skip header row
        for ($row = 2; $row <= $highestRow; $row++) {
            $rowData = $worksheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, NULL, TRUE, FALSE)[0];

            // Map columns - adjust these based on your Excel file structure
            $cultureVesselData = [
                'plate_format' => $rowData[0] ?? null,
                'surface_area_cm2' => $rowData[1] ?? null,
                'media_volume_per_well_ml' => $rowData[2] ?? null
            ];

            // Validate each row
            $rowValidator = Validator::make($cultureVesselData, [
                'plate_format'             => 'required|string|max:255',
                'surface_area_cm2'         => 'required|numeric|min:0',
                'media_volume_per_well_ml' => 'required|numeric|min:0',
            ]);


            if (!$rowValidator->fails()) {
                $importedData[] = $cultureVesselData;
            }
        }

        return $importedData;
    }

    // New method for Excel export
    public function export()
    {
        $cultureVessels = CultureVessel::orderBy('created_at', 'desc')->get();

        // Prepare spreadsheet
        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set headers
        $sheet->setCellValue('A1', 'Plate Format');
        $sheet->setCellValue('B1', 'Surface Area cm2');
        $sheet->setCellValue('C1', 'Media Volume Per Well ml');

        // Add data rows
        $row = 2;
        foreach ($cultureVessels as $cultureVessel) {
            $sheet->setCellValue('A' . $row, $cultureVessel->plate_format);
            $sheet->setCellValue('B' . $row, $cultureVessel->surface_area_cm2);
            $sheet->setCellValue('C' . $row, $cultureVessel->media_volume_per_well_ml);
            $row++;
        }

        // Create Excel file
        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');

        // Generate a unique filename
        $filename = 'culture_vessel_export_' . date('Y-m-d_H-i-s') . '.xlsx';

        // Save to output
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
        $writer->save('php://output');
        exit;
    }
}
