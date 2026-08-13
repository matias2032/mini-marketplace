#!/bin/sh
set -e

# O Render define a variável de ambiente PORT em runtime (não existe no build).
# Este script ajusta o Apache para escutar nessa porta antes de arrancar.
: "${PORT:=10000}"

sed -i "s/Listen 80/Listen ${PORT}/" /etc/apache2/ports.conf
sed -i "s/:80>/:${PORT}>/" /etc/apache2/sites-available/000-default.conf

exec apache2-foreground