<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../src/decidir.php';

final class DecidirTest extends TestCase
{
    public function testPaginaInicialRetorna200(): void
    {
        self::assertSame(200, decidir('/', '1.0.0')['status']);
    }

    public function testCaminhoDesconhecidoRetorna404(): void
    {
        self::assertSame(404, decidir('/nao-existe', '1.0.0')['status']);
    }

    public function testSaudeRetornaStatusVersao(): void
    {
        $resposta = decidir('/saude', '1.2.3');

        self::assertSame(200, $resposta['status']);
        self::assertSame('application/json', $resposta['cabecalhos']['Content-Type']);
        self::assertSame(
            ['status' => 'ok', 'versao' => '1.2.3'],
            json_decode($resposta['corpo'], true, flags: JSON_THROW_ON_ERROR),
        );
    }

    public function testIndexPhpDiretoRetorna404(): void
    {
        self::assertSame(404, decidir('/index.php', '1.0.0')['status']);
    }

    public function testIgnoraQueryString(): void
    {
        self::assertSame(200, decidir('/saude?x=1', '1.0.0')['status']);
    }
}
