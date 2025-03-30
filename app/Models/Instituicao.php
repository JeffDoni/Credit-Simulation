<?php

namespace App\Models;

use Illuminate\Support\Facades\Storage;

class Instituicao
{
    public static function all()
{
    $json = Storage::get('json/instituicoes.json');
    return json_decode($json, true);
}
}
