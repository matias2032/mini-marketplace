<?php
require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/includes/icons.php';

$mensagem_whatsapp_generico = 'Olá! Vim do site e gostaria de mais informações sobre os produtos.';
?>
<!DOCTYPE html>
<html lang="pt-MZ">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Reacenda a Sua Potência</title>
<meta name="description" content="Produtos premium de cuidado masculino. Pagamento apenas na entrega, em todo o país.">
<link rel="stylesheet" href="assets/css/style.css">
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

    <!-- ========================= HERO ========================= -->
    <section class="hero">
      <div class="hero__crown"><?= icon('crown') ?></div>
      <h1>Reacenda a Sua<br><em>Potência</em></h1>
      <p>Receba sem sair de casa e pague apenas quando receber.</p>
      <div class="hero__cta">
        <a href="#produtos" class="btn btn-primary">
          Ver produtos <?= icon('arrow-right') ?>
        </a>
      </div>

      <div class="trust-row">
        <div class="trust-item"><?= icon('shield') ?><span>Compra segura</span></div>
        <div class="trust-item"><?= icon('wallet') ?><span>Pagamento na entrega</span></div>
        <div class="trust-item"><?= icon('truck') ?><span>Entrega rápida</span></div>
        <div class="trust-item"><?= icon('chat') ?><span>Atendimento via WhatsApp</span></div>
      </div>
    </section>

    <!-- ======================= PRODUTOS ======================= -->
    <section class="section" id="produtos">
      <div class="section-head">
        <span class="section-head__eyebrow">Catálogo</span>
        <h2>Escolha o seu produto</h2>
        <p>Pagamento na entrega em todo o país. Sem cartão, sem risco.</p>
      </div>

      <div class="product-grid">
        <?php foreach ($PRODUTOS as $p): ?>
        <article class="product-card">
          <span class="product-card__ribbon">Oferta</span>

          <div class="product-media">
            <div class="product-media__placeholder">
              <?= icon('image') ?>
              <span>Imagem do produto<br>(<?= htmlspecialchars($p['imagem']) ?>)</span>
            </div>
            <img
              src="<?= htmlspecialchars($p['imagem']) ?>"
              alt="<?= htmlspecialchars($p['nome']) ?>"
              loading="lazy"
              onerror="this.style.display='none'">
          </div>

          <div class="product-card__body">
            <h3 class="product-card__name"><?= htmlspecialchars($p['nome']) ?></h3>

            <div class="product-card__price">
              <span class="price-old"><?= formatar_preco($p['preco_de'], $p['moeda']) ?></span>
              <span class="price-now"><?= formatar_preco($p['preco'], $p['moeda']) ?></span>
            </div>

            <ul class="product-card__list">
              <?php foreach ($p['beneficios'] as $b): ?>
              <li><?= icon('check') ?><span><?= htmlspecialchars($b) ?></span></li>
              <?php endforeach; ?>
            </ul>

            <a href="checkout.php?produto=<?= urlencode($p['id']) ?>" class="btn btn-primary">
              <?= icon('wallet') ?> Comprar agora
            </a>
          </div>
        </article>
        <?php endforeach; ?>
      </div>
    </section>

    <!-- ====================== TESTEMUNHOS ====================== -->
    <section class="section" style="padding-top:0">
      <div class="section-head">
        <span class="section-head__eyebrow">★★★★★</span>
        <h2>Clientes satisfeitos</h2>
      </div>

      <div class="testi-grid">
        <div class="testi-card">
          <div class="testi-stars"><?= str_repeat(icon('star'), 5) ?></div>
          <p>"Pedi e recebi em casa no dia seguinte. Só paguei quando o produto chegou. Recomendo."</p>
          <small>Cliente verificado — Maputo</small>
        </div>
        <div class="testi-card">
          <div class="testi-stars"><?= str_repeat(icon('star'), 5) ?></div>
          <p>"Atendimento rápido pelo WhatsApp e entrega discreta. Muito profissional."</p>
          <small>Cliente verificado — Beira</small>
        </div>
        <div class="testi-card">
          <div class="testi-stars"><?= str_repeat(icon('star'), 5) ?></div>
          <p>"Produto de qualidade e pagamento na entrega deu muita confiança."</p>
          <small>Cliente verificado — Nampula</small>
        </div>
      </div>

      <div class="trust-row" style="margin-top:34px">
        <div class="trust-item"><?= icon('truck') ?><span>Entrega rápida em todo o país</span></div>
        <div class="trust-item"><?= icon('wallet') ?><span>Pague apenas ao receber</span></div>
        <div class="trust-item"><?= icon('shield') ?><span>Embalagem 100% discreta</span></div>
        <div class="trust-item"><?= icon('chat') ?><span>Atendimento via WhatsApp</span></div>
      </div>
    </section>

  </div>
</main>

<!-- ========================= RODAPÉ ========================= -->
<footer class="site-footer">
  <div class="container">
    <p>Pagamento somente na entrega.</p>
    <p>Atendimento via
      <a class="whats-link" target="_blank" rel="noopener"
         href="<?= htmlspecialchars(link_whatsapp($mensagem_whatsapp_generico)) ?>">WhatsApp</a>.
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
