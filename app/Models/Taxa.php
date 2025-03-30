<?php

namespace App\Models;

use Illuminate\Support\Facades\Storage;

class Taxa
{
    public static function all()
    {
        $path = 'json/taxas_instituicoes.json';
        $json = Storage::get($path);
        return json_decode($json, true);
    }
}
