<?php

namespace App\Http\Controllers;

use App\Models\Products;
use App\Http\Requests\ProductRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use Illuminate\Database\QueryException;

class ProductsController extends Controller
{
    // GET /products (JSON), sorted alphabetically by product_name (case-insensitive)
    public function index(): JsonResponse
    {
        $products = Products::orderByRaw('LOWER(product_name)')->get();
        return response()->json($products);
    }

    // GET /products/{product}
    public function show(Products $product): JsonResponse
    {
        return response()->json($product);
    }

    // POST /products
    public function store(ProductRequest $request)
    {
        $product = Products::create($request->validated());

        if ($request->wantsJson()) {
            return response()->json($product, 201);
        }

        return redirect()->route('dashboard.products')
            ->with('success', 'Product created successfully!');
    }

    // PUT/PATCH /products/{product}
    public function update(ProductRequest $request, Products $product)
    {
        $product->update($request->validated());

        if ($request->wantsJson()) {
            return response()->json($product);
        }

        return redirect()->route('dashboard.products')
            ->with('success', 'Product updated successfully!');
    }

    // DELETE /products/{product}
    public function destroy(Products $product)
    {
        $product->delete();

        if (request()->wantsJson()) {
            return response()->json(null, 204);
        }

        return redirect()->route('dashboard.products')
            ->with('success', 'Product deleted successfully!');
    }

    // Dashboard index, sorted alphabetically by product_name (case-insensitive)
    public function dashboardIndex()
    {
        $products = Products::orderByRaw('LOWER(product_name)')->get();
        return view('dashboard.products', compact('products'));
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

            // Bulk update or insert products
            foreach ($importedData as $productData) {
                Products::updateOrCreate(
                    ['sku' => $productData['sku']],
                    $productData
                );
            }

            return redirect()->route('dashboard.products')
                ->with('success', count($importedData) . ' Products imported successfully!');
        } catch (QueryException $e) {
            // Format database errors in a user-friendly way
            $errorMessage = $this->formatDatabaseError($e);
            return redirect()->back()
                ->with('error', $errorMessage);
        } catch (\Exception $e) {
            // Handle other errors
            return redirect()->back()
                ->with('error', 'Error importing products: ' . $this->simplifyErrorMessage($e->getMessage()));
        }
    }

    /**
     * Format database errors in a user-friendly way
     */
    private function formatDatabaseError(QueryException $e): string
    {
        $message = $e->getMessage();

        // Handle numeric value out of range error
        if (
            strpos($message, 'Numeric value out of range') !== false &&
            strpos($message, 'seeding_density') !== false
        ) {
            return 'One or more seeding density values are too large. Please use smaller numbers.';
        }

        // Handle duplicate entry error
        if (strpos($message, 'Duplicate entry') !== false) {
            return 'One or more products have duplicate SKUs. Each product must have a unique SKU.';
        }

        // Generic database error
        return 'Database error while importing products. Please check your data and try again.';
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
        $spreadsheet = IOFactory::load($file->getPathname());
        $worksheet = $spreadsheet->getActiveSheet();
        $highestRow = $worksheet->getHighestRow();
        $highestColumn = $worksheet->getHighestColumn();

        // Skip header row
        for ($row = 2; $row <= $highestRow; $row++) {
            $rowData = $worksheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, NULL, TRUE, FALSE)[0];

            // Map columns - adjust these based on your Excel file structure
            $productData = [
                'product_name' => $rowData[0] ?? null,
                'sku' => $rowData[1] ?? null,
                'seeding_density' => $rowData[2] ?? null
            ];

            // Validate each row
            $rowValidator = Validator::make($productData, [
                'product_name' => 'required|string|max:255',
                'sku' => 'required|string|max:255',
                'seeding_density' => 'nullable|numeric'
            ]);

            if (!$rowValidator->fails()) {
                $importedData[] = $productData;
            }
        }

        return $importedData;
    }

    // New method for Excel export, sorted alphabetically by product_name (case-insensitive)
    public function export()
    {
        $products = Products::orderByRaw('LOWER(product_name)')->get();

        // Prepare spreadsheet
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set headers
        $sheet->setCellValue('A1', 'Product Name');
        $sheet->setCellValue('B1', 'SKU');
        $sheet->setCellValue('C1', 'Recommended seeding density (cells/cm2)');

        // Format headers - make them bold with font size 12
        $sheet->getStyle('A1:C1')->getFont()->setBold(true)->setSize(12);

        // Add data rows
        $row = 2;
        foreach ($products as $product) {
            $sheet->setCellValue('A' . $row, $product->product_name);
            $sheet->setCellValue('B' . $row, $product->sku);
            $sheet->setCellValue('C' . $row, $product->seeding_density);
            $row++;
        }

        // Format numbers in column C with thousands separator (xxx,xxx)
        $lastRow = $row - 1;
        if ($lastRow >= 2) {
            $sheet->getStyle('C2:C' . $lastRow)->getNumberFormat()->setFormatCode('#,##0');
        }

        // Auto-size columns to fit content
        foreach (range('A', 'C') as $column) {
            $sheet->getColumnDimension($column)->setAutoSize(true);
        }

        // Create Excel file
        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');

        // Generate a unique filename
        $filename = 'products_export_' . date('Y-m-d_H-i-s') . '.xlsx';

        // Send headers and output
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
        $writer->save('php://output');
        exit;
    }
}
