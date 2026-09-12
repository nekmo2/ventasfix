<?php

namespace App\Services;

class SoftlandService
{
    // esta funcion simula el consumo de un servicio externo (Softland)
    // que entrega el estado de disponibilidad de un producto segun su sku
    // en un caso real, aca se haria una peticion http al api de softland
    public static function consultarDisponibilidad(string $sku): array
    {
        // simulamos una respuesta variable segun el sku, para que no siempre sea igual
        $suma = array_sum(array_map('ord', str_split($sku)));
        $disponible = $suma % 2 === 0;

        return [
            'sku' => $sku,
            'sistema' => 'Softland ERP',
            'disponible' => $disponible,
            'unidades_bodega_central' => $disponible ? ($suma % 50) + 10 : 0,
            'consultado_en' => now()->toDateTimeString(),
        ];
    }
}