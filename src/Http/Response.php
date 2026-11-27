<?php

declare(strict_types=1);

namespace Ingressos\Http;

final class Response
{
    /**
     * @param array<string, string> $cabecalhos
     */
    public function __construct(
        public readonly int $status,
        public readonly string $corpo,
        public readonly array $cabecalhos = [],
    ) {
    }
}
