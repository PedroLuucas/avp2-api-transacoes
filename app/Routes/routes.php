<?php

use Slim\App;
use App\Controllers\TransacaoController;

return function (App $app) {
    $app->post('/transacao', [TransacaoController::class, 'criar']);
    $app->get('/transacao/{id}', [TransacaoController::class, 'buscar']);
    $app->delete('/transacao', [TransacaoController::class, 'apagarTudo']);
    $app->delete('/transacao/{id}', [TransacaoController::class, 'apagar']);
    $app->get('/estatistica', [TransacaoController::class, 'estatisticas']);
};
