(function () {
  const form = document.getElementById('email-verify-form');
  if (!form) return;

  const btn = document.getElementById('verify-btn');
  const status = document.getElementById('verify-status');
  const result = document.getElementById('verify-result');

  function yesNo(v) {
    if (v === true) return 'Yes';
    if (v === false) return 'No';
    return 'Unknown';
  }

  form.addEventListener('submit', async function (e) {
    e.preventDefault();
    const email = (document.getElementById('to_email') || {}).value || '';
    const csrf = (form.querySelector('input[name="_csrf"]') || {}).value || '';
    status.textContent = 'Verifying…';
    result.hidden = true;
    btn.disabled = true;

    try {
      const res = await fetch('/products/email-verifier/api/verify.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'Accept': 'application/json',
          'X-CSRF-Token': csrf
        },
        body: JSON.stringify({ to_email: email, _csrf: csrf })
      });
      const data = await res.json();
      if (!res.ok && data.error) {
        status.textContent = data.error;
        btn.disabled = false;
        return;
      }

      const reachable = data.is_reachable || 'unknown';
      const el = document.getElementById('res-reachable');
      el.textContent = reachable;
      el.className = 'ek-reachable ek-reachable--' + reachable;

      document.getElementById('res-syntax').textContent = data.syntax?.is_valid_syntax ? 'Valid' : 'Invalid';
      document.getElementById('res-mx').textContent = data.mx?.accepts_mail
        ? ('Accepts mail (' + (data.mx.records || []).length + ' MX)')
        : 'No MX';
      document.getElementById('res-smtp').textContent = data.smtp?.skipped
        ? ('Skipped: ' + (data.smtp.skip_reason || 'n/a'))
        : yesNo(data.smtp?.can_connect_smtp);
      document.getElementById('res-deliverable').textContent = yesNo(data.smtp?.is_deliverable);
      document.getElementById('res-catchall').textContent = yesNo(data.smtp?.is_catch_all);
      document.getElementById('res-disposable').textContent = yesNo(data.misc?.is_disposable);
      document.getElementById('res-role').textContent = yesNo(data.misc?.is_role_account);
      document.getElementById('res-json').textContent = JSON.stringify(data, null, 2);

      status.textContent = 'Done.';
      result.hidden = false;
    } catch (err) {
      status.textContent = 'Request failed. Please try again.';
    } finally {
      btn.disabled = false;
    }
  });
})();
