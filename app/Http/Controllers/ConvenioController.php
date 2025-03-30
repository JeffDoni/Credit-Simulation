<?php

namespace App\Http\Controllers;

use App\Models\Convenio;
use Illuminate\Http\JsonResponse;
use Throwable;

class ConvenioController extends Controller
{
    public function index(): JsonResponse
    {
        try {
            $convenios = Convenio::all();
            if (empty($convenios)) {
                return response()->json([
                    'message' => 'Nenhum convênio encontrado.'
                ], 200); 
            }
            return response()->json($convenios, 200);

        } catch (Throwable $e) {
            return response()->json([
                'error'   => 'Erro ao carregar os convênios.',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
