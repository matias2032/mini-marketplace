<?php
session_start();
require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/includes/icons.php';

// --------------------------------------------------------------
// Produto selecionado (via ?produto=slug). Cai no primeiro do
// catálogo se o parâmetro vier vazio ou inválido.
// --------------------------------------------------------------
$slug = isset($_GET['produto']) ? $_GET['produto'] : '';
if (!isset($PRODUTOS[$slug])) {
    $slug = array_key_first($PRODUTOS);
}
$produto_atual = $PRODUTOS[$slug];

// --------------------------------------------------------------
// Mensagens de erro / valores antigos vindos do process_order.php
// (guardados em sessão para repopular o formulário sem perder o
// que o cliente já tinha escrito).
// --------------------------------------------------------------
$erros    = $_SESSION['checkout_erros'] ?? [];
$old      = $_SESSION['checkout_old'] ?? [];
unset($_SESSION['checkout_erros'], $_SESSION['checkout_old']);

function old_val($old, $campo){
    return isset($old[$campo]) ? htmlspecialchars($old[$campo]) : '';
}
function tem_erro($erros, $campo){
    return isset($erros[$campo]) ? ' has-error' : '';
}
?>
<!DOCTYPE html>
<html lang="pt-MZ">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Finalize o seu pedido — <?= htmlspecialchars($produto_atual['nome']) ?></title>
<link rel="stylesheet" href="assets/css/style.css">
<link rel="icon" type="image/svg+xml" href="assets/img/favicon.svg">
</head>
<body>

<!-- ================= BARRA DE OFERTA / TEMPORIZADOR ================= -->
<div class="offer-bar">
  <div class="offer-bar__inner" data-offer-timer>
    <span class="offer-bar__label"><?= icon('lock') ?><span class="full">Oferta especial por tempo limitado</span></span>
    <span class="offer-timer">
      <span class="offer-timer__seg" data-min>30</span>
      <span class="offer-timer__sep">:</span>
      <span class="offer-timer__seg" data-sec>00</span>
    </span>
  </div>
</div>

<main>
  <div class="container">

    <div class="top-nav">
      <a href="index.php" class="top-nav__back"><?= icon('arrow-left') ?> Voltar aos produtos</a>
    </div>

    <div class="checkout-head">
      <h1>Finalize o seu pedido</h1>
      <p>Pague somente após receber o produto em sua casa.</p>
    </div>

    <div class="checkout-panel">

      <?php if (!empty($erros['geral'])): ?>
      <div class="form-alert">
        <?= icon('alert') ?>
        <span><?= htmlspecialchars($erros['geral']) ?></span>
      </div>
      <?php endif; ?>

      <div class="selected-product">
        <div class="selected-product__media">
          <div class="product-media__placeholder"><?= icon('image') ?><span>Imagem</span></div>
          <img src="<?= htmlspecialchars($produto_atual['imagem']) ?>"
               alt="<?= htmlspecialchars($produto_atual['nome']) ?>"
               onerror="this.style.display='none'">
        </div>
        <div class="selected-product__info">
          <strong><?= htmlspecialchars($produto_atual['nome']) ?></strong>
          <div class="selected-product__price">
            <span class="price-old"><?= formatar_preco($produto_atual['preco_de'], $produto_atual['moeda']) ?></span>
            <span class="price-now"><?= formatar_preco($produto_atual['preco'], $produto_atual['moeda']) ?></span>
          </div>
        </div>
      </div>

      <form id="form-checkout" action="process_order.php" method="POST" novalidate>

        <div class="form-field">
          <label for="produto_select">Produto escolhido</label>
          <select id="produto_select" name="produto">
            <?php foreach ($PRODUTOS as $p): ?>
            <option value="<?= htmlspecialchars($p['id']) ?>" <?= $p['id'] === $produto_atual['id'] ? 'selected' : '' ?>>
              <?= htmlspecialchars($p['nome']) ?> — <?= formatar_preco($p['preco'], $p['moeda']) ?>
            </option>
            <?php endforeach; ?>
          </select>
        </div>

        <div class="form-field<?= tem_erro($erros, 'nome') ?>">
          <label for="nome">Nome completo</label>
          <input type="text" id="nome" name="nome" placeholder="Seu nome completo" required value="<?= old_val($old, 'nome') ?>">
          <span class="error-msg">Indique o seu nome completo.</span>
        </div>

        <div class="form-field<?= tem_erro($erros, 'cidade') ?>">
          <label for="cidade">Cidade</label>
          <input type="text" id="cidade" name="cidade" placeholder="Ex.: Maputo" required value="<?= old_val($old, 'cidade') ?>">
          <span class="error-msg">Indique a sua cidade.</span>
        </div>

        <div class="form-field<?= tem_erro($erros, 'bairro') ?>">
          <label for="bairro">Bairro</label>
          <input type="text" id="bairro" name="bairro" placeholder="Ex.: Polana" required value="<?= old_val($old, 'bairro') ?>">
          <span class="error-msg">Indique o seu bairro.</span>
        </div>

        <div class="contact-group">
          <div class="form-field<?= tem_erro($erros, 'telefone') ?>">
            <label for="telefone">Número para chamadas</label>
            <input type="tel" id="telefone" name="telefone" placeholder="84 000 0000" value="<?= old_val($old, 'telefone') ?>">
          </div>

          <div class="form-field<?= tem_erro($erros, 'whatsapp_cliente') ?>">
            <label for="whatsapp_cliente">Número do WhatsApp</label>
            <input type="tel" id="whatsapp_cliente" name="whatsapp_cliente" placeholder="84 000 0000" value="<?= old_val($old, 'whatsapp_cliente') ?>">
          </div>

          <p class="contact-group__note" id="contact-error" style="<?= !empty($erros['contacto']) ? 'display:flex;gap:6px;color:var(--danger)' : '' ?>">
            Preencha pelo menos um dos dois números de contacto.
          </p>
        </div>

        <button type="submit" class="btn btn-primary btn-block">
          Receber em casa <?= icon('arrow-right') ?>
        </button>

        <p class="checkout-note"><?= icon('check-circle') ?> Pagamento somente na entrega</p>
      </form>
    </div>

    <div class="trust-row" style="max-width:520px;margin-left:auto;margin-right:auto;margin-top:26px">
      <div class="trust-item"><?= icon('shield') ?><span>Compra segura</span></div>
      <div class="trust-item"><?= icon('wallet') ?><span>Pagamento na entrega</span></div>
      <div class="trust-item"><?= icon('truck') ?><span>Entrega rápida</span></div>
      <div class="trust-item"><?= icon('chat') ?><span>Atendimento via WhatsApp</span></div>
    </div>

  </div>
</main>

<footer class="site-footer">
  <div class="container">
    <p>Pagamento somente na entrega.</p>
    <p>Atendimento via
      <a class="whats-link" target="_blank" rel="noopener"
         href="<?= htmlspecialchars(link_whatsapp('Olá! Tenho uma dúvida sobre o meu pedido.')) ?>">WhatsApp</a>.
    </p>
    <div class="legal">
      <a href="#">Política de Privacidade</a>
      <a href="#">Termos de Uso</a>
    </div>
  </div>
</footer>

<script src="assets/js/main.js"></script>
</body>
</html>
