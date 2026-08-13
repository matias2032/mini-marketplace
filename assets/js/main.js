/**
 * Temporizador de oferta — 30 minutos, reinicia sempre que a página
 * é carregada/recarregada (não persiste em armazenamento nenhum).
 */
(function offerTimer(){
  const DURATION_SECONDS = 30 * 60; // 30 minutos
  const els = document.querySelectorAll('[data-offer-timer]');
  if (!els.length) return;

  let remaining = DURATION_SECONDS;

  function render(){
    const m = Math.floor(remaining / 60).toString().padStart(2, '0');
    const s = Math.floor(remaining % 60).toString().padStart(2, '0');
    els.forEach(function(wrap){
      const minEl = wrap.querySelector('[data-min]');
      const secEl = wrap.querySelector('[data-sec]');
      if (minEl) minEl.textContent = m;
      if (secEl) secEl.textContent = s;
      wrap.classList.toggle('is-ending', remaining <= 120);
    });
  }

  render();
  const tick = setInterval(function(){
    remaining -= 1;
    if (remaining <= 0){
      remaining = 0;
      render();
      clearInterval(tick);
      return;
    }
    render();
  }, 1000);
})();

/**
 * Checkout — pelo menos um dos dois contactos (chamada ou WhatsApp)
 * tem de estar preenchido. Validação no cliente antes de enviar ao
 * process_order.php (que valida novamente no servidor).
 */
(function checkoutForm(){
  const form = document.querySelector('#form-checkout');
  if (!form) return;

  const telefone = form.querySelector('#telefone');
  const whatsapp = form.querySelector('#whatsapp_cliente');
  const contactAlert = form.querySelector('#contact-error');

  function clearFieldError(field){
    const wrap = field.closest('.form-field');
    if (wrap) wrap.classList.remove('has-error');
  }

  function setFieldError(field){
    const wrap = field.closest('.form-field');
    if (wrap) wrap.classList.add('has-error');
  }

  [telefone, whatsapp].forEach(function(field){
    if (!field) return;
    field.addEventListener('input', function(){
      if (telefone.value.trim() || whatsapp.value.trim()){
        clearFieldError(telefone);
        clearFieldError(whatsapp);
        if (contactAlert) contactAlert.style.display = 'none';
      }
    });
  });

  form.addEventListener('submit', function(e){
    let valid = true;

    form.querySelectorAll('[required]').forEach(function(field){
      if (!field.value.trim()){
        setFieldError(field);
        valid = false;
      } else {
        clearFieldError(field);
      }
    });

    if (telefone && whatsapp && !telefone.value.trim() && !whatsapp.value.trim()){
      setFieldError(telefone);
      setFieldError(whatsapp);
      if (contactAlert) contactAlert.style.display = 'flex';
      valid = false;
    }

    if (!valid){
      e.preventDefault();
      const firstError = form.querySelector('.has-error');
      if (firstError) firstError.scrollIntoView({ behavior:'smooth', block:'center' });
    }
  });
})();

/**
 * Sincroniza o resumo do produto selecionado quando o utilizador
 * troca a opção no <select> do checkout.
 */
(function productSelectSync(){
  const select = document.querySelector('#produto_select');
  if (!select) return;

  select.addEventListener('change', function(){
    const url = new URL(window.location.href);
    url.searchParams.set('produto', select.value);
    window.location.href = url.toString();
  });
})();
