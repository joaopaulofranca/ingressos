# Projeto PHP com Docker e Nginx - (ingressos)

Plataforma de venda de ingressos em PHP, front controller, TDD com PHPUnit, Nginx e PHP-FPM no Docker.

A aplicação PHP 8.5 rodando em container. O nginx recebe as requisições e repassa para o PHP-FPM. O public/index.php é 
o único ponto de entrada.

# Requisitos
    Docker
    Docker Compose

# Subir o ambiente

    docker compose up -d --build

A aplicação fica em http://localhost:8081/.

# Para conferir se está no ar:
    curl http://localhost:8081/saude

# Resposta esperada:
    {"status":"ok","versao":"dev"}

# Rodar os testes

    docker compose exec php vendor/bin/phpunit

# Observações
    Só o public/index.php é executado. Qualquer outro .php passado na URL retorna 404.
    Adicionar uma extensão PHP nova, exige mudar o Dockerfile e reconstruir a imagem com docker compose up -d --build.