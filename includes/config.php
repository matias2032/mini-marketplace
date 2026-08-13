<?php
/**
 * ============================================================
 *  CONFIGURAÇÃO GERAL DO MARKETPLACE
 * ============================================================
 *  Edite apenas esta secção para colocar o número de WhatsApp
 *  e gerir o catálogo de produtos. Nada mais precisa ser tocado.
 * ============================================================
 */

// --------------------------------------------------------------
// 1) NÚMERO DE WHATSAPP (formato internacional, só dígitos)
//    Ex.: Moçambique -> "258841234567"
//    Deixe "" em branco enquanto não tiver o número definitivo.
// --------------------------------------------------------------
define('WHATSAPP_NUMBER', ''); // <-- COLOQUE AQUI O NÚMERO

// --------------------------------------------------------------
// 2) CATÁLOGO DE PRODUTOS
//    "imagem" aponta para assets/img/produtos/ — troque o
//    ficheiro mantendo o mesmo nome, o layout ajusta-se sozinho.
// --------------------------------------------------------------
$PRODUTOS = [
    'sabonete-masculino' => [
        'id'          => 'sabonete-masculino',
        'nome'        => 'Sabonete Masculino Premium',
        'imagem'      => 'assets/img/produtos/sabonete.jpg',
        'preco'       => 900,
        'preco_de'    => 1300,
        'moeda'       => 'MZN',
        'resumo'      => 'Higiene íntima e reforço da confiança em cada uso.',
        'beneficios'  => [
            'Higiene íntima masculina',
            'Sensação de frescura duradoura',
            'Fórmula para cuidados diários',
            'Fácil de utilizar',
        ],
    ],
    'cha-potencia' => [
        'id'          => 'cha-potencia',
        'nome'        => 'Chá Potência Masculina',
        'imagem'      => 'assets/img/produtos/cha.jpg',
        'preco'       => 900,
        'preco_de'    => 1300,
        'moeda'       => 'MZN',
        'resumo'      => 'Blend 100% natural para energia e vitalidade.',
        'beneficios'  => [
            'Suplemento natural para o bem-estar',
            'Ajuda na disposição e energia',
            'Ingredientes selecionados',
            'Fácil preparo',
        ],
    ],
    'gel-masculino' => [
        'id'          => 'gel-masculino',
        'nome'        => 'Gel Masculino Premium',
        'imagem'      => 'assets/img/produtos/gel.jpg',
        'preco'       => 1000,
        'preco_de'    => 1500,
        'moeda'       => 'MZN',
        'resumo'      => 'Textura suave desenvolvida para o cuidado íntimo.',
        'beneficios'  => [
            'Desenvolvido para cuidados íntimos',
            'Fácil aplicação',
            'Uso externo',
            'Sensação refrescante',
        ],
    ],

        'sabonete-masculino' => [
        'id'          => 'sabonete-masculino',
        'nome'        => 'Sabonete Masculino Premium',
        'imagem'      => 'assets/img/produtos/sabonete.jpg',
        'preco'       => 900,
        'preco_de'    => 1300,
        'moeda'       => 'MZN',
        'resumo'      => 'Higiene íntima e reforço da confiança em cada uso.',
        'beneficios'  => [
            'Higiene íntima masculina',
            'Sensação de frescura duradoura',
            'Fórmula para cuidados diários',
            'Fácil de utilizar',
        ],
    ],
];

// --------------------------------------------------------------
// 3) Utilitário: formata preço no padrão "900 MZN"
// --------------------------------------------------------------
function formatar_preco($valor, $moeda) {
    return number_format($valor, 0, ',', '.') . ' ' . $moeda;
}

// --------------------------------------------------------------
// 4) Utilitário: gera o link wa.me já com o número + mensagem
// --------------------------------------------------------------
function link_whatsapp($mensagem = '') {
    $numero = WHATSAPP_NUMBER;
    $base   = $numero !== '' ? "https://wa.me/{$numero}" : "https://wa.me/";
    if ($mensagem !== '') {
        $base .= '?text=' . rawurlencode($mensagem);
    }
    return $base;
}
