# Caminho da requisição

# DNS e TTL
Antes da conexão, o cliente transforma o DNS em um endereço de IP.
Consultei o DNS e temos o seguinte resultado abaixo.

    ❯ dig github.com

    ; <<>> DiG 9.18.39-0ubuntu0.24.04.9-Ubuntu <<>> github.com
    ;; global options: +cmd
    ;; Got answer:
    ;; ->>HEADER<<- opcode: QUERY, status: NOERROR, id: 11120
    ;; flags: qr rd ra; QUERY: 1, ANSWER: 1, AUTHORITY: 0, ADDITIONAL: 1

    ;; OPT PSEUDOSECTION:
    ; EDNS: version: 0, flags:; udp: 65494
    ;; QUESTION SECTION:
    ;github.com.			IN	A

    ;; ANSWER SECTION:
  -->   github.com.		69	IN	A	4.228.31.150


* A linha da resposta possui as colunas github.com que é o endereço consultado, a coluna 69 é o TTL ele diz por quanto
tempo a resposta pode ficar em cache, nesse caso é por 69 segundos, IN é a classe, que é praticamente sempre essa, a 
coluna A é o tipo do registro, um endereço IPv4 e a coluna que é o IP do GitHub 4.228.31.150 onde o navegador conecta.

# Conexão segura com TLS

Quando já tem o IP, o cliente abre a conexão TCP com o TLS que esta na versão 1.3

    ❯ openssl s_client -connect github.com:443

    CONNECTED(00000003)
    depth=2 C = GB, O = Sectigo Limited, CN = Sectigo Public Server Authentication Root E46
    verify return:1
    depth=1 C = GB, O = Sectigo Limited, CN = Sectigo Public Server Authentication CA DV E36
    verify return:1
    depth=0 CN = github.com
    verify return:1
    ---
    Certificate chain
    0 s:CN = github.com
    i:C = GB, O = Sectigo Limited, CN = Sectigo Public Server Authentication CA DV E36
    a:PKEY: id-ecPublicKey, 256 (bit); sigalg: ecdsa-with-SHA256
    v:NotBefore: Oct 30 00:00:00 2026 GMT; NotAfter: Jan 27 23:59:59 2027 GMT
    1 s:C = GB, O = Sectigo Limited, CN = Sectigo Public Server Authentication CA DV E36
    i:C = GB, O = Sectigo Limited, CN = Sectigo Public Server Authentication Root E46
    a:PKEY: id-ecPublicKey, 256 (bit); sigalg: ecdsa-with-SHA384
    v:NotBefore: Mar 22 00:00:00 2021 GMT; NotAfter: Mar 21 23:59:59 2036 GMT
    2 s:C = GB, O = Sectigo Limited, CN = Sectigo Public Server Authentication Root E46
    i:C = US, ST = New Jersey, L = Jersey City, O = The USERTRUST Network, CN = USERTrust ECC Certification Authority
    a:PKEY: id-ecPublicKey, 384 (bit); sigalg: ecdsa-with-SHA384
    v:NotBefore: Mar 22 00:00:00 2021 GMT; NotAfter: Jan 18 23:59:59 2038 GMT
    ---
    Server certificate
    -----BEGIN CERTIFICATE-----
    MIID9DCCA5ugAwIBAgIQPh1gJrSwrqJ53KLvu87YKzAKBggqhkjOPQQDAjBgMQsw
    CQYDVQQGEwJHQjEYMBYGA1UEChMPU2VjdGlnbyBMaW1pdGVkMTcwNQYDVQQDEy5T
    ZWN0aWdvIFB1YmxpYyBTZXJ2ZXIgQXV0aGVudGljYXRpb24gQ0EgRFYgRTM2MB4X
    DTI2MTAzMDAwMDAwMFoXDTI3MDEyNzIzNTk1OVowFTETMBEGA1UEAxMKZ2l0aHVi
    LmNvbTBZMBMGByqGSM49AgEGCCqGSM49AwEHA0IABDfKd4nH+v687AH/LbUBuI5o
    XVsDbbLwRkLBCDbDmYWcrpxd8+9O0uPHpIgjAQ0gBToGy66v4d70x/jgDoosK3ej
    ggKAMIICfDAfBgNVHSMEGDAWgBQXmagEwW/kLXCoChA9A9PpGrgmYzAdBgNVHQ4E
    FgQUjLAqHq7uhl0AATWx5YtpI6U+PHEwDgYDVR0PAQH/BAQDAgeAMAwGA1UdEwEB
    /wQCMAAwEwYDVR0lBAwwCgYIKwYBBQUHAwEwSQYDVR0gBEIwQDA0BgsrBgEEAbIx
    AQICBzAlMCMGCCsGAQUFBwIBFhdodHRwczovL3NlY3RpZ28uY29tL0NQUzAIBgZn
    gQwBAgEwgYQGCCsGAQUFBwEBBHgwdjBPBggrBgEFBQcwAoZDaHR0cDovL2NydC5z
    ZWN0aWdvLmNvbS9TZWN0aWdvUHVibGljU2VydmVyQXV0aGVudGljYXRpb25DQURW
    RTM2LmNydDAjBggrBgEFBQcwAYYXaHR0cDovL29jc3Auc2VjdGlnby5jb20wJQYD
    VR0RBB4wHIIKZ2l0aHViLmNvbYIOd3d3LmdpdGh1Yi5jb20wggEMBgorBgEEAdZ5
    AgQCBIH9BIH6APgAdQBGojlnxg22RofGbz35mZR2k6amESCEV9VV5+PQodm2RgAA
    AaGKLocgAAAEAwBGMEQCICIQbbpOkqdkpMHlEO4IaqjUE51GdnAX8lTdfJqayeUy
    AiBW+rfEnQghzD2sljP8DmiE364OeNXjRLnoS4/+EDmBMQB/AKKBABhzThduHUfg
    lUDzgbpUZpfNY6hDUHFuuAlO2vENAAABoYouiCYACAAABQAyHujyBAMASDBGAiEA
    qR77xK7WOstHFrsyltQlPHqO5UAlaD5EUGgfV+SyHngCIQCTdXIrVaNFlwq2jVoU
    6eq3LTDtgBbBB8AS6pKHuIF94DAKBggqhkjOPQQDAgNHADBEAiAiIVULRbVeXo16
    6wK3Vp15eud/nlbNTa+j4FUnKD6GYAIgBcK3WmeV05N87KRIoaIV/h97FykBOCul
    KBsCT9qemhg=
    -----END CERTIFICATE-----
    subject=CN = github.com
    issuer=C = GB, O = Sectigo Limited, CN = Sectigo Public Server Authentication CA DV E36
    ---
    No client certificate CA names sent
    Peer signing digest: SHA256
    Peer signature type: ECDSA
    Server Temp Key: X25519, 253 bits
    ---
    SSL handshake has read 3093 bytes and written 376 bytes
    Verification: OK
    ---
    New, TLSv1.3, Cipher is TLS_AES_128_GCM_SHA256
    Server public key is 256 bit
    Secure Renegotiation IS NOT supported
    Compression: NONE
    Expansion: NONE
    No ALPN negotiated
    Early data was not sent
    Verify return code: 0 (ok)

* Na conexão é enviado alguns certificados que prova que aquele IP é do Github nesse caso. Funciona como um documento 
de identidade. O certificado tambem traz uma chave publica do servidor que é  a:PKEY: id-ecPublicKey , com ela o 
cliente e servidor combinam uma chave secreta que só os dois conhecem, dai o que passa pela rede vai criptografado.

* O certificado do github foi assinado por Sectigo Public Server Authentication CA DV E36 que foi assinada por
Sectigo Public Server Authentication Root E46 que foi assinada por CN = USERTrust ECC Certification Authority.


# Resposta HTTP

    ❯ curl -sv -o /dev/null https://github.com/ 2>&1 | grep -E '^(\*|<|>)'
    * Host github.com:443 was resolved.
    * IPv6: (none)
    * IPv4: 4.228.31.150
    *   Trying 4.228.31.150:443...
    * Connected to github.com (4.228.31.150) port 443
    * ALPN: curl offers h2,http/1.1
    * TLSv1.3 (OUT), TLS handshake, Client hello (1):
    *  CAfile: /etc/ssl/certs/ca-certificates.crt
    *  CApath: /etc/ssl/certs
    * TLSv1.3 (IN), TLS handshake, Server hello (2):
    * TLSv1.3 (IN), TLS handshake, Encrypted Extensions (8):
    * TLSv1.3 (IN), TLS handshake, Certificate (11):
    * TLSv1.3 (IN), TLS handshake, CERT verify (15):
    * TLSv1.3 (IN), TLS handshake, Finished (20):
    * TLSv1.3 (OUT), TLS change cipher, Change cipher spec (1):
    * TLSv1.3 (OUT), TLS handshake, Finished (20):
    * SSL connection using TLSv1.3 / TLS_AES_128_GCM_SHA256 / X25519 / id-ecPublicKey
    * ALPN: server accepted h2
    * Server certificate:
    *  subject: CN=github.com
    *  start date: Oct 30 00:00:00 2026 GMT
    *  expire date: Jan 27 23:59:59 2027 GMT
    *  subjectAltName: host "github.com" matched cert's "github.com"
    *  issuer: C=GB; O=Sectigo Limited; CN=Sectigo Public Server Authentication CA DV E36
    *  SSL certificate verify ok.
    *   Certificate level 0: Public key type EC/prime256v1 (256/128 Bits/secBits), signed using ecdsa-with-SHA256
    *   Certificate level 1: Public key type EC/prime256v1 (256/128 Bits/secBits), signed using ecdsa-with-SHA384
    *   Certificate level 2: Public key type EC/secp384r1 (384/192 Bits/secBits), signed using ecdsa-with-SHA384
    * using HTTP/2
    * [HTTP/2] [1] OPENED stream for https://github.com/
    * [HTTP/2] [1] [:method: GET]
    * [HTTP/2] [1] [:scheme: https]
    * [HTTP/2] [1] [:authority: github.com]
    * [HTTP/2] [1] [:path: /]
    * [HTTP/2] [1] [user-agent: curl/8.5.0]
    * [HTTP/2] [1] [accept: */*]
    > GET / HTTP/2
    > Host: github.com
    > User-Agent: curl/8.5.0
    > Accept: */*
    > 
    * TLSv1.3 (IN), TLS handshake, Newsession Ticket (4):
    * TLSv1.3 (IN), TLS handshake, Newsession Ticket (4):
    * old SSL session ID is stale, removing
    < HTTP/2 200
    < date: Thu, 26 Nov 2026 01:20:42 GMT
    < content-type: text/html; charset=utf-8
    < vary: X-PJAX, X-PJAX-Container, Turbo-Visit, Turbo-Frame, X-Requested-With, X-GitHub-Client-Version, Accept-Language, Sec-Fetch-Site,Accept-Encoding, Accept, X-Requested-With
    < content-language: en-US
    < etag: W/"563f8be32857583bed1d7c7fcf6c476e"
    < cache-control: max-age=0, private, must-revalidate
    < strict-transport-security: max-age=31536000; includeSubdomains; preload
    < x-frame-options: deny
    < x-content-type-options: nosniff
    < x-xss-protection: 0
    < referrer-policy: origin-when-cross-origin, strict-origin-when-cross-origin
    < content-security-policy ....

* Na resposta HTTP as linhas > são os dados que foram enviados pelo curl, e < é a resposta, na resposta o content-type
diz como deve interpretar a pagina, strict-transport-security faz com que o navegador use HTTPS e cache-control diz por
quanto tempo a resposta deve ficar em cache.

# No ambiente local

    ❯ curl -sv http://localhost:8081/saude
    * Host localhost:8081 was resolved.
    * IPv6: ::1
    * IPv4: 127.0.0.1
    *   Trying [::1]:8081...
    * Connected to localhost (::1) port 8081
    > GET /saude HTTP/1.1
    > Host: localhost:8081
    > User-Agent: curl/8.5.0
    > Accept: */*
    > 
    < HTTP/1.1 200 OK
    < Server: nginx/1.29.8
    < Date: Thu, 26 Nov 2026 01:32:17 GMT
    < Content-Type: application/json
    < Transfer-Encoding: chunked
    < Connection: keep-alive
    < X-Powered-By: PHP/8.5.13
    < 
    * Connection #0 to host localhost left intact
    {"status":"ok","versao":"526c100"}%

* A requisição realizada no ambiente local aqui a versão é HTTP/1.1 nesse caso nao há TLS. O retorno que são as linhas 
 com < veio com status 200 OK, diz que o corpo é Json Content-Type, quem atendeu a conexão foi o 
 Nginx (Server: nginx/1.29.8) e o X-Powered-By: PHP/8.5.13 indica que a resposta passou pelo PHP-FPM.


# nginx > FastCGI > PHP-FPM > index.php

server {
    listen 80;
    server_name _;

    root /var/www/html/public;
    index index.php index.html;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location = /index.php {
        include fastcgi_params;
        fastcgi_pass php:9000;
        fastcgi_index index.php;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
    }


    location ~ \.php$ {
        return 404;
    }
    
    location ~ /\. {
        deny all;
    }
}

Em location a / atende o caminho do try_files para o redirecionamento interno e  location = /index.php passa pelo index 
e o fastcgi_pass_app  abre uma conexão TCP com o container na porta 9000, onde o PHP-FPM escuta. O fastcgi_param 
SCRIPT_FILENAME é a linha que aponta o index correto, aponta o caminho do index para o FPM e o resultado é 
/var/www/html/public/index.php. Em resumo o location escolhe o caminho, o fastcgi_pass escolhe o destino, o 
SCRIPT_FILENAME escolhe o arquivo.

