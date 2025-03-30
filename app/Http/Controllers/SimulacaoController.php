<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Taxa;
use Illuminate\Validation\ValidationException;
use Throwable;

class SimulacaoController extends Controller
{
    public function simular(Request $request)
    {
        try {
            if(!$request->filled('valor_emprestimo')) {
                return response()->json([
                    'message' => 'O campo valor_emprestimo é obrigatório.'
                ], 400);
            }
            $validated = $request->validate([
                'valor_emprestimo' => 'required|numeric',
                'instituicoes'     => 'array',
                'convenios'        => 'array',
                'parcela'          => 'numeric'
            ]);
            
            $valorEmprestimo    = $validated['valor_emprestimo'];
            $instituicoesFiltro = $validated['instituicoes'] ?? null;
            $conveniosFiltro    = $validated['convenios'] ?? null;
            $parcelaFiltro      = $validated['parcela'] ?? null;
            
            $taxas = collect(Taxa::all());

            $resultados = $taxas->filter(function ($item) use (
                $instituicoesFiltro,
                $conveniosFiltro,
                $parcelaFiltro
            ) {
                if (!empty($instituicoesFiltro) && !in_array($item['instituicao'], $instituicoesFiltro)) {
                    return false;
                }
                if (!empty($conveniosFiltro) && !in_array($item['convenio'], $conveniosFiltro)) {
                    return false;
                }
                if (!empty($parcelaFiltro) && $item['parcelas'] != $parcelaFiltro) {
                    return false;
                }
                return true;
            })
            ->map(function ($item) use ($valorEmprestimo) {
                $valorParcela = $valorEmprestimo * $item['coeficiente'];

                return [
                    'parcelas'     => $item['parcelas'],
                    'taxaJuros'    => $item['taxaJuros'],
                    'coeficiente'  => $item['coeficiente'],
                    'instituicao'  => $item['instituicao'],
                    'convenio'     => $item['convenio'],
                    'valorParcela' => round($valorParcela, 2),
                ];
            })
            ->values();

            if ($resultados->isEmpty()) {
                return response()->json([
                    'message' => 'Nenhum resultado encontrado para os filtros informados.'
                ], 200);
            }

            return response()->json($resultados, 200);

        } catch (ValidationException $e) {
            return response()->json([
                'error'   => 'Dados inválidos',
                'details' => $e->errors(),
            ], 422);

        } catch (Throwable $e) {
            return response()->json([
                'error'   => 'Ocorreu um erro interno. Tente novamente mais tarde.',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
