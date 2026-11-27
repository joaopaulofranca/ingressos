<?php

declare(strict_types=1);

require_once __DIR__ . '/../src/decidir.php';

try {
    $caminho = $_SERVER['REQUEST_URI'] ?? '/';
    $versao = getenv('APP_VERSAO');

    $resposta = decidir(
        is_string($caminho) ? $caminho : '/',
        is_string($versao) ? $versao : 'desconhecida',
    );
} catch (Throwable $erro) {
    error_log((string) $erro);

    $resposta = [
        'status' => 500,
        'cabecalhos' => ['Content-Type' => 'text/plain; charset=utf-8'],
        'corpo' => 'Erro interno. Tente novamente mais tarde.',
    ];
}

http_response_code($resposta['status']);

foreach ($resposta['cabecalhos'] as $nome => $valor) {
    header($nome . ': ' . $valor);
}

print $resposta['corpo'];
