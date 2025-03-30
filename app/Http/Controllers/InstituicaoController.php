<?php

namespace App\Http\Controllers;

use App\Models\Instituicao;
use Illuminate\Http\JsonResponse;
use Throwable;

class InstituicaoController extends Controller
{
    public function index(): JsonResponse
    {
        try {
            $instituicoes = Instituicao::all();

            if (empty($instituicoes)) {
                return response()->json([
                    'message' => 'Nenhuma instituição encontrada.'
                ], 200);
            }

            return response()->json($instituicoes, 200);

        } catch (Throwable $e) {
            return response()->json([
                'error'   => 'Erro ao carregar as instituições.',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
