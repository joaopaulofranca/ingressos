# Diario de dores

Problemas encontrados ao montar o ambiente (Docker, Nginx e PHP-FPM).

* Porta 8080 ocupada

    Sintoma: o container não subia.
    Causa: a porta 8080 do host já estava em uso.
    Solução: mapeamento trocado de 8080:80 para 8081:80. O acesso local passou a ser http://localhost:8081.

* Build sem composer.json / composer.lock

    Sintoma: o build do Docker falhava.
    Causa: o Dockerfile copiava e exigia arquivos do Composer que ainda não existiam.
    Solução: instruções removidas. O próprio Dockerfile instala o Composer.

* Algumas extensões PHP ausentes

    Sintoma: faltavam pdo_pgsql, zip e gd no container.
    Causa: o Dockerfile instalava só Redis.
    Solução: extensões adicionadas ao Dockerfile e imagem reconstruída.

* Nginx executava qualquer  .php

    Sintoma: /joaopaulo.php respondia 200.
    Causa: o location / não encaminhava para o /index.php, e qualquer script era executado.
    Solução: try_files apontando para /index.php, location = /index.php como único bloco que fala com o PHP e location ~ \.php$ retornando 404.

* Rota inexistente retornando 200

    Sintoma: /caminho-inexistente respondia 200 em vez de 404.
    Causa: o Nginx estava certo, porque manda toda URL para o index.php. O problema é que o index.php responde a tudo.
    Solução proposta: um roteador no index.php com a lista de rotas válidas, respondendo 404 para o resto.