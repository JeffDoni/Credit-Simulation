<?php

namespace App\Models;

class Convenio
{
    public static function all()
    {
        $path = base_path('resources/json/convenios.json');

        if (!file_exists($path)) {
            return [];
        }

        $json = file_get_contents($path);
        return json_decode($json, true);
    }
}
