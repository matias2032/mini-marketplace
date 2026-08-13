<?php
session_start();
require_once __DIR__ . '/includes/config.php';

// Só aceita submissões via POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit;
}

function campo($nome){
    return isset($_POST[$nome]) ? trim($_POST[$nome]) : '';
}

$produto_id       = campo('produto');
$nome             = campo('nome');
$cidade           = campo('cidade');
$bairro           = campo('bairro');
$telefone         = campo('telefone');
$whatsapp_cliente = campo('whatsapp_cliente');

$erros = [];

if ($produto_id === '' || !isset($PRODUTOS[$produto_id])) {
    $erros['geral'] = 'Selecione um produto válido antes de continuar.';
}
if ($nome === '')   { $erros['nome']   = true; }
if ($cidade === '') { $erros['cidade'] = true; }
if ($bairro === '') { $erros['bairro'] = true; }
if ($telefone === '' && $whatsapp_cliente === '') {
    $erros['telefone']         = true;
    $erros['whatsapp_cliente'] = true;
    $erros['contacto']         = true;
}

// --------------------------------------------------------------
// Se houver erros, volta para o checkout mantendo o produto e os
// dados já preenchidos.
// --------------------------------------------------------------
if (!empty($erros)) {
    $_SESSION['checkout_erros'] = $erros;
    $_SESSION['checkout_old'] = [
        'nome'             => $nome,
        'cidade'           => $cidade,
        'bairro'           => $bairro,
        'telefone'         => $telefone,
        'whatsapp_cliente' => $whatsapp_cliente,
    ];
    $destino = 'checkout.php?produto=' . urlencode($produto_id !== '' ? $produto_id : array_key_first($PRODUTOS));
    header('Location: ' . $destino);
    exit;
}

$produto = $PRODUTOS[$produto_id];

// --------------------------------------------------------------
// Regista o pedido num CSV local (histórico simples de pedidos).
// Ajuste ou substitua por gravação em base de dados / e-mail se
// preferir outra forma de armazenamento.
// --------------------------------------------------------------
$linha_csv = [
    date('Y-m-d H:i:s'),
    $produto['nome'],
    formatar_preco($produto['preco'], $produto['moeda']),
    $nome,
    $cidade,
    $bairro,
    $telefone,
    $whatsapp_cliente,
];
$arquivo_csv = __DIR__ . '/pedidos.csv';
$novo = !file_exists($arquivo_csv);
if ($handle = @fopen($arquivo_csv, 'a')) {
    if ($novo) {
        fputcsv($handle, ['Data', 'Produto', 'Preço', 'Nome', 'Cidade', 'Bairro', 'Telefone', 'WhatsApp']);
    }
    fputcsv($handle, $linha_csv);
    fclose($handle);
}

// --------------------------------------------------------------
// Monta a mensagem que vai preenchida para o WhatsApp.
// --------------------------------------------------------------
$contacto_txt = $whatsapp_cliente !== '' ? $whatsapp_cliente : $telefone;
$mensagem = "Olá! Quero finalizar o meu pedido:\n"
          . "Produto: {$produto['nome']}\n"
          . "Preço: " . formatar_preco($produto['preco'], $produto['moeda']) . "\n"
          . "Nome: {$nome}\n"
          . "Cidade: {$cidade}\n"
          . "Bairro: {$bairro}\n"
          . "Contacto: {$contacto_txt}";

$_SESSION['pedido_confirmado'] = [
    'produto'  => $produto['nome'],
    'preco'    => formatar_preco($produto['preco'], $produto['moeda']),
    'nome'     => $nome,
    'whatsapp' => link_whatsapp($mensagem),
];

header('Location: confirmado.php');
exit;
