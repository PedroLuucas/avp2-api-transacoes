<?php

namespace App\Services;

use App\Models\Transacao;
use PDO;

class EstatisticaService
{
    private Transacao $transacaoModel;

    public function __construct(PDO $db)
    {
        $this->transacaoModel = new Transacao($db);
    }

    public function calcular(): array
    {
        $transacoes = $this->transacaoModel->transacoesUltimoMinuto();

        $valores = array_column($transacoes, 'valor');

        if (empty($valores)) {
            return [
                'sum' => 0,
                'avg' => 0,
                'min' => 0,
                'max' => 0,
                'count' => 0
            ];
        }

        return [
            'sum' => array_sum($valores),
            'avg' => round(array_sum($valores) / count($valores), 2),
            'min' => min($valores),
            'max' => max($valores),
            'count' => count($valores)
        ];
    }
}
