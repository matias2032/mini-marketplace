<?php
/**
 * ping.php
 */
 
header('Content-Type: application/json; charset=utf-8');
header('Cache-Control: no-store, no-cache, must-revalidate');
 
http_response_code(200);
 
echo json_encode([
    'status' => 'ok',
    'servico' => 'potenciashop',
    'hora_utc' => gmdate('Y-m-d H:i:s') . ' UTC',
]);
 