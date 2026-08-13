# ============================================================
#  Dockerfile — Marketplace PHP (Apache + PHP 8.3)
#  Pronto para o Render (Web Service, plano Hobby)
# ============================================================
FROM php:8.3-apache

# Módulos Apache úteis (rewrite para URLs limpos no futuro, headers p/ cache)
RUN a2enmod rewrite headers

# Diretório de trabalho do Apache
WORKDIR /var/www/html

# Copia todo o projeto para dentro da imagem.
# As imagens colocadas em assets/img/produtos/ ANTES do build
# ficam "cozidas" na imagem e sobrevivem a qualquer redeploy/restart,
# mesmo numa instância Free (não precisam de disco persistente).
COPY . /var/www/html/

# Garante permissões corretas e que o pedidos.csv pode ser criado/escrito
# pelo processo do Apache (www-data). Isto é escrita em runtime, portanto
# é efémera em instâncias Free — ver README para alternativas.
RUN chown -R www-data:www-data /var/www/html \
    && find /var/www/html -type d -exec chmod 755 {} \; \
    && find /var/www/html -type f -exec chmod 644 {} \;

# Script que liga a porta do Apache à variável $PORT do Render
COPY docker/entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

# Porta padrão (o Render sobrepõe via $PORT em runtime)
ENV PORT=10000
EXPOSE 10000

ENTRYPOINT ["/entrypoint.sh"]
