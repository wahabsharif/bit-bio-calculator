<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsTableSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['product_name' => 'not ioCells', 'sku' => null, 'seeding_density' => null],
            ['product_name' => 'CRISPRa-Ready ioGlutamatergic Neurons', 'sku' => 'io1099S', 'seeding_density' => 30000],
            ['product_name' => 'CRISPRi-Ready ioGlutamatergic Neurons', 'sku' => 'io1098S', 'seeding_density' => 30000],
            ['product_name' => 'CRISPRko-Ready ioGlutamatergic Neurons', 'sku' => 'io1090S', 'seeding_density' => 30000],
            ['product_name' => 'CRISPRko-Ready ioMicroglia | Male', 'sku' => 'io1094S', 'seeding_density' => 30000],
            ['product_name' => 'GFP ioMicroglia | Male', 'sku' => 'io1096S', 'seeding_density' => 30000],
            ['product_name' => 'ioAstrocytes', 'sku' => 'ioEA1093', 'seeding_density' => 30000],
            ['product_name' => 'ioGABAergic Neurons', 'sku' => 'io1003S', 'seeding_density' => 30000],
            ['product_name' => 'ioGABAergic Neurons APP V717I/V717I', 'sku' => 'io1081S', 'seeding_density' => 30000],
            ['product_name' => 'ioGABAergic Neurons APP V717I/WT', 'sku' => 'io1085S', 'seeding_density' => 30000],
            ['product_name' => 'ioGlutamatergic Neurons', 'sku' => 'io1001S', 'seeding_density' => 30000],
            ['product_name' => 'ioGlutamatergic Neurons APP KM670/671NL / KM670/671NL', 'sku' => 'io1059S', 'seeding_density' => 30000],
            ['product_name' => 'ioGlutamatergic Neurons APP KM670/671NL/WT', 'sku' => 'io1061S', 'seeding_density' => 30000],
            ['product_name' => 'ioGlutamatergic Neurons APP V717I/V717I', 'sku' => 'io1063S', 'seeding_density' => 30000],
            ['product_name' => 'ioGlutamatergic Neurons APP V717I/WT', 'sku' => 'io1067S', 'seeding_density' => 30000],
            ['product_name' => 'ioGlutamatergic Neurons GBA null/R159W', 'sku' => 'io1007S', 'seeding_density' => 30000],
            ['product_name' => 'ioGlutamatergic Neurons GBA null/WT', 'sku' => 'io1007S', 'seeding_density' => 30000],
            ['product_name' => 'ioGlutamatergic Neurons HTT 50CAG/WT', 'sku' => 'ioEA1004S', 'seeding_density' => 30000],
            ['product_name' => 'ioGlutamatergic Neurons MAPT N279K/N279K', 'sku' => 'io1014S', 'seeding_density' => 30000],
            ['product_name' => 'ioGlutamatergic Neurons MAPT N279K/WT', 'sku' => 'io1009S', 'seeding_density' => 30000],
            ['product_name' => 'ioGlutamatergic Neurons MAPT P301S/P301S', 'sku' => 'io1008S', 'seeding_density' => 30000],
            ['product_name' => 'ioGlutamatergic Neurons MAPT P301S/WT', 'sku' => 'io1015S', 'seeding_density' => 30000],
            ['product_name' => 'ioGlutamatergic Neurons PINK1 Q456X/Q456X', 'sku' => 'io1076S', 'seeding_density' => 30000],
            ['product_name' => 'ioGlutamatergic Neurons PINK1 Q456X/WT', 'sku' => 'io1079S', 'seeding_density' => 30000],
            ['product_name' => 'ioGlutamatergic Neurons PRKN R275W/R275W', 'sku' => 'io1020S', 'seeding_density' => 30000],
            ['product_name' => 'ioGlutamatergic Neurons PRKN R275W/WT', 'sku' => 'io1013S', 'seeding_density' => 30000],
            ['product_name' => 'ioGlutamatergic Neurons PSEN1 M146L/M146L', 'sku' => 'io1069S', 'seeding_density' => 30000],
            ['product_name' => 'ioGlutamatergic Neurons PSEN1 M146L/WT', 'sku' => 'io1072S', 'seeding_density' => 30000],
            ['product_name' => 'ioGlutamatergic Neurons SNCA A53T/A53T', 'sku' => 'io1088S', 'seeding_density' => 30000],
            ['product_name' => 'ioGlutamatergic Neurons SNCA A53T/WT', 'sku' => 'io6005S', 'seeding_density' => 30000],
            ['product_name' => 'ioGlutamatergic Neurons TDP-43 M337V/M337V', 'sku' => 'ioEA1005S', 'seeding_density' => 30000],
            ['product_name' => 'ioGlutamatergic Neurons TDP-43 M337V/WT', 'sku' => 'ioEA1006S', 'seeding_density' => 30000],
            ['product_name' => 'ioMicroglia | Female', 'sku' => 'io1029S', 'seeding_density' => 30000],
            ['product_name' => 'ioMicroglia | Male', 'sku' => 'io1021S', 'seeding_density' => 30000],
            ['product_name' => 'ioMicroglia APOE 4/3 C112R/WT', 'sku' => 'io1033S', 'seeding_density' => 30000],
            ['product_name' => 'ioMicroglia APOE 4/4 C112R/C112R', 'sku' => 'io1032S', 'seeding_density' => 30000],
            ['product_name' => 'ioMicroglia TREM2 R47H/R47H', 'sku' => 'io1035S', 'seeding_density' => 30000],
            ['product_name' => 'ioMicroglia TREM2 R47H/WT', 'sku' => 'io1038S', 'seeding_density' => 30000],
            ['product_name' => 'ioMotor Neurons', 'sku' => 'io1027S', 'seeding_density' => 30000],
            ['product_name' => 'ioMotor Neurons FUS P525L/P525L', 'sku' => 'io1052S', 'seeding_density' => 30000],
            ['product_name' => 'ioMotor Neurons FUS P525L/WT', 'sku' => 'io1055S', 'seeding_density' => 30000],
            ['product_name' => 'ioMotor Neurons SOD-1 G93A/G93A', 'sku' => 'io1041S', 'seeding_density' => 30000],
            ['product_name' => 'ioMotor Neurons SOD-1 G93A/WT', 'sku' => 'io1042S', 'seeding_density' => 30000],
            ['product_name' => 'ioMotor Neurons TDP-43 M337V/M337V', 'sku' => 'io1046S', 'seeding_density' => 30000],
            ['product_name' => 'ioMotor Neurons TDP-43 M337V/WT', 'sku' => 'io1050S', 'seeding_density' => 30000],
            ['product_name' => 'ioOligodendrocyte-like cells', 'sku' => 'io1028S', 'seeding_density' => 27000],
            ['product_name' => 'ioSensory Neurons', 'sku' => 'io1024S', 'seeding_density' => 30000],
            ['product_name' => 'ioSkeletal Myocytes', 'sku' => 'io1002S', 'seeding_density' => 30000],
            ['product_name' => 'ioSkeletal Myocytes DMD Exon 44 Deletion', 'sku' => 'io1018S', 'seeding_density' => 30000],
            ['product_name' => 'ioSkeletal Myocytes DMD Exon 52 Deletion', 'sku' => 'io1019S', 'seeding_density' => 30000],
        ];

        DB::table('products')->insert($data);
    }
}
