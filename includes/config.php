<?php
// config.php
/**
 * ============================================================
 *  CONFIGURAÇÃO GERAL DO MARKETPLACE
 * ============================================================
 */

if (!defined('WHATSAPP_NUMBER')) {
    define('WHATSAPP_NUMBER', '258876821594');
}

$PRODUTOS = [
    'sabonete-masculino' => [
        'id'          => 'sabonete-masculino',
        'nome'        => 'Sabonete Masculino Premium',
        'imagem'      => 'assets/img/produtos/sabao1.jpg',
        'preco'       => 900,
        'preco_de'    => 1300,
        'moeda'       => 'MZN',
        'disponivel'  => true,
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
        'imagem'      => 'assets/img/produtos/cha1.jpg',
        'preco'       => 900,
        'preco_de'    => 1300,
        'moeda'       => 'MZN',
        'disponivel'  => true,
        'resumo'      => 'Blend 100% natural para energia e vitalidade.',
        'beneficios'  => [
            'Suplemento natural para o bem-estar',
            'Ajuda na disposição e energia',
            'Ingredientes selecionados',
            'Fácil preparo',
        ],
    ],
    'creme-masculino' => [
        'id'          => 'creme-masculino',
        'nome'        => 'Creme Masculino Premium',
        'imagem'      => 'assets/img/produtos/creme1.jpg',
        'preco'       => 1000,
        'preco_de'    => 1500,
        'moeda'       => 'MZN',
        'disponivel'  => true,
        'resumo'      => 'Textura suave desenvolvida para o cuidado íntimo.',
        'beneficios'  => [
            'Desenvolvido para cuidados íntimos',
            'Fácil aplicação',
            'Uso externo',
            'Sensação refrescante',
        ],
    ],
    'sabonete-masculino2' => [
        'id'          => 'sabonete-masculino2',
        'nome'        => 'Sabonete Masculino Premium — Edição Intensa',
        'imagem'      => 'assets/img/produtos/sabao2.jpg',
        'preco'       => 900,
        'preco_de'    => 1300,
        'moeda'       => 'MZN',
        'disponivel'  => true,
        'resumo'      => 'Fórmula reforçada para uma sensação de poder redobrada.',
        'beneficios'  => [
            'Ação antibacteriana reforçada',
            'Perfume amadeirado marcante',
            'Textura cremosa de alta espuma',
            'Ideal para uso diário intenso',
        ],
    ],
    // 'creme-masculino2' => [
    //     'id'          => 'creme-masculino2',
    //     'nome'        => 'Creme Masculino Premium — Toque Sedoso',
    //     'imagem'      => 'assets/img/produtos/creme2.jpg',
    //     'preco'       => 1000,
    //     'preco_de'    => 1500,
    //     'moeda'       => 'MZN',
    //     'disponivel'  => false,
    //     'resumo'      => 'Hidratação profunda com absorção rápida.',
    //     'beneficios'  => [
    //         'Hidratação profunda e duradoura',
    //         'Absorção rápida sem deixar oleosidade',
    //         'Toque sedoso ao aplicar',
    //         'Perfeito para a rotina noturna',
    //     ],
    // ],
    'cha-potencia2' => [
        'id'          => 'cha-potencia2',
        'nome'        => 'Chá Potência Masculina — Blend Especial',
        'imagem'      => 'assets/img/produtos/cha2.jpg',
        'preco'       => 900,
        'preco_de'    => 1300,
        'moeda'       => 'MZN',
        'disponivel'  => true,
        'resumo'      => 'Seleção especial de ervas para um efeito ainda mais notável.',
        'beneficios'  => [
            'Mistura exclusiva de ervas selecionadas',
            'Preparado tradicional intensificado',
            'Sabor suave e aromático',
            'Resultados sentidos já nos primeiros dias',
        ],
    ],
];

if (!function_exists('formatar_preco')) {
    function formatar_preco($valor, $moeda) {
        return number_format($valor, 0, ',', '.') . ' ' . $moeda;
    }
}

if (!function_exists('link_whatsapp')) {
    function link_whatsapp($mensagem = '') {
        $numero = WHATSAPP_NUMBER;
        $base   = "https://wa.me/{$numero}";
        if ($mensagem !== '') {
            $base .= '?text=' . rawurlencode($mensagem);
        }
        return $base;
    }
}