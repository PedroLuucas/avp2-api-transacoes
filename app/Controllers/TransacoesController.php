<?php

namespace App\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Models\Transacao;
use App\Utils\Validator;
use App\Services\EstatisticaService;
use PDO;
use Exception;

class TransacaoController
{
    private PDO $db;

    public function __construct()
    {
        $this->db = \Slim\Factory\AppFactory::getContainer()->get('db');
    }

    public function criar(Request $request, Response $response): Response
    {
        $data = $request->getParsedBody();

        if (!Validator::validarTransacao($data)) {
            return $response->withStatus(422);
        }

        try {
            $transacao = new Transacao($this->db);
            $transacao->criar($data);
            return $response->withStatus(201);
        } catch (Exception $e) {
            return $response->withStatus(400); // JSON inválido ou erro de inserção
        }
    }

    public function buscar(Request $request, Response $response, array $args): Response
    {
        $id = $args['id'];

        $transacao = new Transacao($this->db);
        $dados = $transacao->buscarPorId($id);

        if ($dados) {
            $response->getBody()->write(json_encode($dados));
            return $response->withHeader('Content-Type', 'application/json');
        }

        return $response->withStatus(404);
    }

    public function apagarTudo(Request $request, Response $response): Response
    {
        $transacao = new Transacao($this->db);
        $transacao->apagarTudo();
        return $response->withStatus(200);
    }

    public function apagar(Request $request, Response $response, array $args): Response
    {
        $id = $args['id'];
        $transacao = new Transacao($this->db);

        if ($transacao->apagarPorId($id)) {
            return $response->withStatus(200);
        }

        return $response->withStatus(404);
    }

    public function estatisticas(Request $request, Response $response): Response
    {
        $estatisticaService = new EstatisticaService($this->db);
        $resultado = $estatisticaService->calcular();

        $response->getBody()->write(json_encode($resultado));
        return $response->withHeader('Content-Type', 'application/json');
    }
}
