# ADR 0001: Stack em PHP 8.5, PostgreSQL e Redis no docker

- **Status:** Aceito

#Contexto

O sistema de ingressos precisa lidar com acesso simultâneo (mais de uma pessoa tentando comprar um ingresso no mesmo tempo).
Foi montado a imagem do PHP-FPM já com  pdo_pgsql, redis, intl, zip, gd e Composer para ter o ambiente pronto.

#Decisão

Vamos usar PHP 8.5 (PHP-FPM) pois é a versão mais recente com pdo_pgsql para o banco PostgreSQL e a extensão redis para cache e controle de concorrência na compra de ingressos, junto com intl, zip e gd para formatação, compactação e imagens.
As dependências serão instaladas via Composer, e o container expõe a porta 9000 rodando php-fpm -F.

#Alternativas consideradas

- **Fazer tudo só no PostgreSQL sem usar Redis:** até dá para usar lock no banco, mas em disputa por ingresso o Redis ajuda a filtrar e cachear consultas quentes sem sobrecarregar tanto o banco.

#Consequências

- **O lado bom:** evita disputa por ingresso na hora de comprar ingresso, mantém o ambiente padronizado via Docker.