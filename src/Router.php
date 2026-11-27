<?php

declare(strict_types=1);

namespace Ingressos;

use Ingressos\Http\Response;

final class Router
{
    public function decidir(string $metodo, string $caminho): Response
    {
        $caminho = parse_url($caminho, PHP_URL_PATH);

        return match ($caminho) {
            '/' => new Response(
                200,
                'Ingressos',
                ['Content-Type' => 'text/plain; charset=utf-8'],
            ),
            '/saude' => new Response(
                200,
                json_encode(['status' => 'ok'], JSON_THROW_ON_ERROR),
                ['Content-Type' => 'application/json'],
            ),
            default => new Response(
                404,
                'Pagina nao encontrada',
                ['Content-Type' => 'text/plain; charset=utf-8'],
            ),
        };
    }
}
