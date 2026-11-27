<?php

namespace Ingressos\Tests;

use Ingressos\Router;
use PHPUnit\Framework\TestCase;

class RouterTest extends TestCase
{
    public function testPaginaInicial()
    {
        $resposta = (new Router())->decidir('GET', '/');
        self::assertSame(200, $resposta->status);
    }

    public function testSaude()
    {
        $resposta = (new Router())->decidir('GET', '/saude');
        self::assertSame(200, $resposta->status);
        self::assertSame('{"status":"ok"}', $resposta->corpo);
    }

    public function testCaminhoDesconhecido()
    {
        $resposta = (new Router())->decidir('GET', '/nao-existe');
        self::assertSame(404, $resposta->status);
    }

    public function testIgnoraQueryString()
    {
        $resposta = (new Router())->decidir('GET', '/saude?x=1');
        self::assertSame(200, $resposta->status);
    }
}