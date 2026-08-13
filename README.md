# Marketplace — Recupere a sua Masculinidade

Duas páginas em **PHP**, com formulário processado em PHP e um front-end
próprio (dark mode, acentos azul + dourado, tipografia Oswald/Manrope/JetBrains Mono).

## Estrutura

```
marketplace/
├── index.php              → Página 1: catálogo de produtos (landing)
├── checkout.php            → Página 2: finalização do pedido
├── process_order.php       → Processa o POST do formulário (PHP)
├── confirmado.php          → Página de confirmação, encaminha ao WhatsApp
├── includes/
│   ├── config.php          → NÚMERO DE WHATSAPP + catálogo de produtos
│   └── icons.php           → Ícones SVG usados nas páginas
├── assets/
│   ├── css/style.css
│   ├── js/main.js          → Temporizador de 30 min + validação do formulário
│   └── img/produtos/       → Coloque aqui as imagens dos produtos
└── pedidos.csv              → Criado automaticamente com o histórico de pedidos
```

## O que precisa de configurar

### 1. Número de WhatsApp
Abra `includes/config.php` e edite a linha:

```php
define('WHATSAPP_NUMBER', ''); // <-- COLOQUE AQUI O NÚMERO
```

Use o formato internacional, só dígitos (ex.: `258841234567`). Esse número
recebe automaticamente:
- o clique em **"Atendimento via WhatsApp"** (index.php e checkout.php);
- o formulário preenchido, depois de o cliente clicar em **"Receber em casa"**.

### 2. Imagens dos produtos
Cada produto já tem um espaço de imagem com proporção fixa (4:3) que se
adapta a qualquer imagem mantendo qualidade máxima (`object-fit: cover`).
Basta guardar o ficheiro em `assets/img/produtos/` com o nome indicado em
`includes/config.php` (ex.: `sabonete.jpg`). Enquanto não houver imagem,
aparece um placeholder discreto indicando qual ficheiro é esperado.

### 3. Produtos, preços e benefícios
Tudo isto está no array `$PRODUTOS` em `includes/config.php` — adicionar,
remover ou editar um produto ali reflete automaticamente nas duas páginas
(catálogo + select do checkout).

## Como funciona o formulário

1. O cliente escolhe um produto → é levado a `checkout.php?produto=<id>`.
2. Preenche nome, cidade, bairro e **pelo menos um** dos dois contactos
   (telefone ou WhatsApp) — a validação (JS + PHP) só exige que um dos dois
   esteja preenchido.
3. Ao submeter, `process_order.php`:
   - valida os dados no servidor;
   - regista o pedido em `pedidos.csv` (histórico simples, pode ser trocado
     por gravação em base de dados);
   - monta a mensagem do pedido e redireciona para `confirmado.php`.
4. `confirmado.php` mostra a confirmação e encaminha automaticamente (2s)
   para o WhatsApp configurado, já com a mensagem do pedido preenchida.

## Temporizador de oferta

O contador no topo das duas páginas começa sempre em **30:00** e reinicia
a cada carregamento/recarregamento da página (não usa cookies nem
armazenamento — é só um efeito de urgência/exclusividade, controlado em
`assets/js/main.js`).

## Requisitos para executar

Qualquer servidor com PHP 7.4+ (ex.: `php -S localhost:8000` dentro da
pasta `marketplace/`, ou hospedagem partilhada comum com suporte a PHP).
