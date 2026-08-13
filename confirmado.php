<?php
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
<title>Pedido registado — a encaminhar para o WhatsApp</title>
<link rel="stylesheet" href="assets/css/style.css">
<meta http-equiv="refresh" content="2;url=<?= htmlspecialchars($pedido['whatsapp']) ?>">
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
        (<?= htmlspecialchars($pedido['preco']) ?>) foi registado.
        Vamos abrir o WhatsApp para confirmar a entrega.
      </p>
      <div class="confirm-spinner" aria-hidden="true"></div>
      <a href="<?= htmlspecialchars($pedido['whatsapp']) ?>" class="btn btn-primary" target="_blank" rel="noopener">
        Continuar no WhatsApp
      </a>
    </div>
  </div>
</main>
<script>
  // Reforço via JS caso o redireccionamento por meta-refresh seja bloqueado
  setTimeout(function(){
    window.location.href = <?= json_encode($pedido['whatsapp']) ?>;
  }, 2200);
</script>
</body>
</html>
