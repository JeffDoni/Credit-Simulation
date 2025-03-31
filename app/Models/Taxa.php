<?php

namespace App\Models;

class Taxa
{
    public static function all()
    {
        $path = base_path('resources/json/taxas_instituicoes.json');

        if (!file_exists($path)) {
            return [];
        }

        $json = file_get_contents($path);
        return json_decode($json, true);
    }
}
