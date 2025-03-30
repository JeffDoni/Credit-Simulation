<?php

namespace App\Models;

use Illuminate\Support\Facades\Storage;

class Convenio
{
    public static function all()
    {
        $path = 'json/convenios.json';
        $json = Storage::get($path);
        return json_decode($json, true);
    }
}
