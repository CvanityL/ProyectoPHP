<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Indicador;
use File;

class IndicadoresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Indicador::truncate();
  
        $json = File::get("database/data/dataIndicadores.json");
        $indicadores = json_decode($json);
  
        foreach ($indicadores as $key => $value) {
            if ($value->codigoIndicador == 'UF') {
                Indicador::create([
                    "nombreIndicador" => $value->nombreIndicador,
                    "codigoIndicador" => $value->codigoIndicador,
                    "unidadMedidaIndicador" => $value->unidadMedidaIndicador,
                    "valorIndicador" => $value->valorIndicador,
                    "tiempoIndicador" => $value->tiempoIndicador,
                    "origenIndicador" => $value->origenIndicador,
                    "fechaIndicador" => $value->fechaIndicador,
                ]);
            }
            
        }
    }
}
