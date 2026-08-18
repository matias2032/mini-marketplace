<?php
// confirmado.php
session_start();
require_once __DIR__ . '/includes/icons.php';

$pedido = $_SESSION['pedido_confirmado'] ?? null;
unset($_SESSION['pedido_confirmado']);

// Sem pedido válido na sessão -> volta para o catálogo
if (!$pedido) {
    header('Location: index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-MZ">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Pedido registado — Finalize no WhatsApp</title>
<link rel="stylesheet" href="assets/css/style.css">
<link rel="icon" type="image/svg+xml" href="assets/img/favicon.svg">
<!-- REMOVIDA A TAG META REFRESH -->
</head>
<body>
<main>
  <div class="confirm-wrap">
    <div class="confirm-card">
      <div class="confirm-icon"><?= icon('check-circle') ?></div>
      <h1>Pedido registado!</h1>
      <p>
        Obrigado, <?= htmlspecialchars($pedido['nome']) ?>. O seu pedido de
        <strong><?= htmlspecialchars($pedido['produto']) ?></strong>
        (<?= htmlspecialchars($pedido['preco']) ?>) foi reservado.
      </p>
      
      <!-- Adicionado um aviso forte para o utilizador clicar -->
      <div style="background-color: #fff3cd; color: #856404; padding: 15px; border-radius: 8px; margin: 20px 0; border: 1px solid #ffeeba;">
          <strong>⚠️ ATENÇÃO:</strong> O seu pedido só será enviado após confirmação no WhatsApp. Clique no botão abaixo para concluir.
      </div>

      <!-- O target="_blank" ajuda a contornar alguns bloqueios -->
      <a href="<?= htmlspecialchars($pedido['whatsapp']) ?>" class="btn btn-primary btn-block" target="_blank" rel="noopener">
        <?= icon('chat') ?> CONFIRMAR PEDIDO NO WHATSAPP
      </a>
    </div>
  </div>
</main>
<!-- REMOVIDO O SCRIPT DE SETTIMEOUT -->
</body>
</html>