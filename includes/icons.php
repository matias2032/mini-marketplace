<?php
/**
 * Pequena biblioteca de ícones SVG (stroke, 24x24) usados nas páginas.
 * Mantidos como funções para evitar duplicar markup nos templates.
 */
function icon($nome){
    $icones = [
        'lock' => '<path d="M6 11V8a6 6 0 0 1 12 0v3"/><rect x="4" y="11" width="16" height="10" rx="2"/>',
        'crown' => '<path d="M3 8l4 3 5-6 5 6 4-3-2 11H5L3 8z"/>',
        'shield' => '<path d="M12 3l7 3v6c0 5-3.5 8-7 9-3.5-1-7-4-7-9V6l7-3z"/>',
        'wallet' => '<path d="M3 7a2 2 0 0 1 2-2h13a1 1 0 0 1 1 1v3"/><path d="M3 7v11a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-8a2 2 0 0 0-2-2H5"/><circle cx="16" cy="14" r="1.4"/>',
        'truck' => '<rect x="1" y="6" width="13" height="10" rx="1.5"/><path d="M14 10h4l3 3v3h-7z"/><circle cx="5.5" cy="18" r="1.6"/><circle cx="16.5" cy="18" r="1.6"/>',
        'chat' => '<path d="M4 5h16v11H8l-4 4V5z"/>',
        'check' => '<polyline points="20 6 9 17 4 12"/>',
        'star' => '<polygon points="12 2 15 9 22 9.5 17 14.5 18.5 22 12 18 5.5 22 7 14.5 2 9.5 9 9 12 2" />',
        'arrow-left' => '<line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/>',
        'arrow-right' => '<line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/>',
        'image' => '<rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><path d="M21 15l-5-5L5 21"/>',
        'alert' => '<circle cx="12" cy="12" r="9"/><line x1="12" y1="8" x2="12" y2="13"/><circle cx="12" cy="16" r="0.6" fill="currentColor" stroke="none"/>',
        'check-circle' => '<circle cx="12" cy="12" r="9"/><polyline points="8 12.5 11 15.5 16 9"/>',
    ];
    if (!isset($icones[$nome])) return '';
    $stroke = $nome === 'star' || $nome === 'check-circle-fill' ? 'fill="currentColor" stroke="none"' : 'fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"';
    return '<svg viewBox="0 0 24 24" ' . $stroke . ' aria-hidden="true">' . $icones[$nome] . '</svg>';
}
