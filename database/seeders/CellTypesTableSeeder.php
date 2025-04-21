<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CellTypesTableSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['product_name_sku' => 'not ioCells', 'recommended_seeding_density' => null],
            ['product_name_sku' => 'CRISPRa-Ready ioGlutamatergic Neurons, io1099S', 'recommended_seeding_density' => 30000],
            ['product_name_sku' => 'CRISPRi-Ready ioGlutamatergic Neurons, io1098S', 'recommended_seeding_density' => 30000],
            ['product_name_sku' => 'CRISPRko-Ready ioGlutamatergic Neurons, io1090S', 'recommended_seeding_density' => 30000],
            ['product_name_sku' => 'CRISPRko-Ready ioMicroglia | Male, io1094S', 'recommended_seeding_density' => 30000],
            ['product_name_sku' => 'GFP ioMicroglia | Male, io1096S', 'recommended_seeding_density' => 30000],
            ['product_name_sku' => 'ioAstrocytes, ioEA1093', 'recommended_seeding_density' => 30000],
            ['product_name_sku' => 'ioGABAergic Neurons, io1003S', 'recommended_seeding_density' => 30000],
            ['product_name_sku' => 'ioGABAergic Neurons APP V717I/V717I, io1081S', 'recommended_seeding_density' => 30000],
            ['product_name_sku' => 'ioGABAergic Neurons APP V717I/WT, io1085S', 'recommended_seeding_density' => 30000],
            ['product_name_sku' => 'ioGlutamatergic Neurons, io1001S', 'recommended_seeding_density' => 30000],
            ['product_name_sku' => 'ioGlutamatergic Neurons APP KM670/671NL / KM670/671NL, io1059S', 'recommended_seeding_density' => 30000],
            ['product_name_sku' => 'ioGlutamatergic Neurons APP KM670/671NL/WT, io1061S', 'recommended_seeding_density' => 30000],
            ['product_name_sku' => 'ioGlutamatergic Neurons APP V717I/V717I, io1063S', 'recommended_seeding_density' => 30000],
            ['product_name_sku' => 'ioGlutamatergic Neurons APP V717I/WT, io1067S', 'recommended_seeding_density' => 30000],
            ['product_name_sku' => 'ioGlutamatergic Neurons GBA null/R159W, io1007S', 'recommended_seeding_density' => 30000],
            ['product_name_sku' => 'ioGlutamatergic Neurons GBA null/WT, io1007S', 'recommended_seeding_density' => 30000],
            ['product_name_sku' => 'ioGlutamatergic Neurons HTT 50CAG/WT, ioEA1004S', 'recommended_seeding_density' => 30000],
            ['product_name_sku' => 'ioGlutamatergic Neurons MAPT N279K/N279K, io1014S', 'recommended_seeding_density' => 30000],
            ['product_name_sku' => 'ioGlutamatergic Neurons MAPT N279K/WT, io1009S', 'recommended_seeding_density' => 30000],
            ['product_name_sku' => 'ioGlutamatergic Neurons MAPT P301S/P301S, io1008S', 'recommended_seeding_density' => 30000],
            ['product_name_sku' => 'ioGlutamatergic Neurons MAPT P301S/WT, io1015S', 'recommended_seeding_density' => 30000],
            ['product_name_sku' => 'ioGlutamatergic Neurons PINK1 Q456X/Q456X, io1076S', 'recommended_seeding_density' => 30000],
            ['product_name_sku' => 'ioGlutamatergic Neurons PINK1 Q456X/WT, io1079S', 'recommended_seeding_density' => 30000],
            ['product_name_sku' => 'ioGlutamatergic Neurons PRKN R275W/R275W, io1020S', 'recommended_seeding_density' => 30000],
            ['product_name_sku' => 'ioGlutamatergic Neurons PRKN R275W/WT, io1013S', 'recommended_seeding_density' => 30000],
            ['product_name_sku' => 'ioGlutamatergic Neurons PSEN1 M146L/M146L, io1069S', 'recommended_seeding_density' => 30000],
            ['product_name_sku' => 'ioGlutamatergic Neurons PSEN1 M146L/WT, io1072S', 'recommended_seeding_density' => 30000],
            ['product_name_sku' => 'ioGlutamatergic Neurons SNCA A53T/A53T, io1088S', 'recommended_seeding_density' => 30000],
            ['product_name_sku' => 'ioGlutamatergic Neurons SNCA A53T/WT, io6005S', 'recommended_seeding_density' => 30000],
            ['product_name_sku' => 'ioGlutamatergic Neurons TDP-43 M337V/M337V, ioEA1005S', 'recommended_seeding_density' => 30000],
            ['product_name_sku' => 'ioGlutamatergic Neurons TDP-43 M337V/WT, ioEA1006S', 'recommended_seeding_density' => 30000],
            ['product_name_sku' => 'ioMicroglia | Female, io1029S', 'recommended_seeding_density' => 30000],
            ['product_name_sku' => 'ioMicroglia | Male, io1021S', 'recommended_seeding_density' => 30000],
            ['product_name_sku' => 'ioMicroglia APOE 4/3 C112R/WT, io1033S', 'recommended_seeding_density' => 30000],
            ['product_name_sku' => 'ioMicroglia APOE 4/4 C112R/C112R, io1032S', 'recommended_seeding_density' => 30000],
            ['product_name_sku' => 'ioMicroglia TREM2 R47H/R47H, io1035S', 'recommended_seeding_density' => 30000],
            ['product_name_sku' => 'ioMicroglia TREM2 R47H/WT, io1038S', 'recommended_seeding_density' => 30000],
            ['product_name_sku' => 'ioMotor Neurons, io1027S', 'recommended_seeding_density' => 30000],
            ['product_name_sku' => 'ioMotor Neurons FUS P525L/P525L, io1052S', 'recommended_seeding_density' => 30000],
            ['product_name_sku' => 'ioMotor Neurons FUS P525L/WT, io1055S', 'recommended_seeding_density' => 30000],
            ['product_name_sku' => 'ioMotor Neurons SOD-1 G93A/G93A, io1041S', 'recommended_seeding_density' => 30000],
            ['product_name_sku' => 'ioMotor Neurons SOD-1 G93A/WT, io1042S', 'recommended_seeding_density' => 30000],
            ['product_name_sku' => 'ioMotor Neurons TDP-43 M337V/M337V, io1046S', 'recommended_seeding_density' => 30000],
            ['product_name_sku' => 'ioMotor Neurons TDP-43 M337V/WT, io1050S', 'recommended_seeding_density' => 30000],
            ['product_name_sku' => 'ioOligodendrocyte-like cells, io1028S', 'recommended_seeding_density' => 27000],
            ['product_name_sku' => 'ioSensory Neurons, io1024S', 'recommended_seeding_density' => 30000],
            ['product_name_sku' => 'ioSkeletal Myocytes, io1002S', 'recommended_seeding_density' => 30000],
            ['product_name_sku' => 'ioSkeletal Myocytes DMD Exon 44 Deletion, io1018S', 'recommended_seeding_density' => 30000],
            ['product_name_sku' => 'ioSkeletal Myocytes DMD Exon 52 Deletion, io1019S', 'recommended_seeding_density' => 30000],
        ];

        DB::table('cell_types')->insert($data);
    }
}
