<?php

declare(strict_types=1);

function decidir(string $caminho, string $versao): array
{
    $caminho = parse_url($caminho, PHP_URL_PATH);

    return match ($caminho) {
        '/' => [
            'status' => 200,
            'cabecalhos' => ['Content-Type' => 'text/plain; charset=utf-8'],
            'corpo' => 'Ingressos',
        ],
        '/saude' => [
            'status' => 200,
            'cabecalhos' => ['Content-Type' => 'application/json'],
            'corpo' => json_encode(['status' => 'ok', 'versao' => $versao], JSON_THROW_ON_ERROR),
        ],
        default => [
            'status' => 404,
            'cabecalhos' => ['Content-Type' => 'text/plain; charset=utf-8'],
            'corpo' => 'Pagina nao encontrada',
        ],
    };
}
