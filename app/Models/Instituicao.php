<?php

namespace App\Models;

class Instituicao
{
    public static function all()
    {
        $path = base_path('resources/json/instituicoes.json');

        if (!file_exists($path)) {
            return [];
        }

        $json = file_get_contents($path);
        return json_decode($json, true);
    }
}
