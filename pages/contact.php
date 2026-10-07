<?php
$pageTitle = 'Contact';
$pageDescription = 'Contact Neelkant E. / Ekbotix about automation, MarTech, and AI systems work.';
$canonicalPath = '/contact';
ek_page(['pageTitle' => $pageTitle, 'pageDescription' => $pageDescription, 'canonicalPath' => $canonicalPath]);
ek_component('header');
?>

<section class="single-case-studies-bread-crumb-area area-2 pt--120 pb--60">
    <div class="container">
        <div class="breadcrumb-inner">
            <div class="pagimation">
                <a href="<?= ek_e(ek_url('/')) ?>">Home</a><i class="fa-regular fa-chevron-right" aria-hidden="true"></i>
                <span class="current">Contact</span>
            </div>
            <h1 class="title">Contact</h1>
            <p class="mt--15">Professional inquiries about automation systems, MarTech, analytics, and AI workflows.</p>
        </div>
    </div>
</section>

<section class="rts-section-gapBottom">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-6">
                <form id="contact-form" method="post" action="<?= ek_e(ek_url('/contact/submit')) ?>" class="p-4" style="background:#F8F9FB;border:1px solid #D7D9E9;border-radius:12px;">
                    <?= ek_csrf_field() ?>
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" maxlength="100" required autocomplete="name">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" maxlength="254" required autocomplete="email">
                    </div>
                    <div class="mb-3">
                        <label for="message" class="form-label">Message</label>
                        <textarea class="form-control" id="message" name="message" rows="6" maxlength="4000" required></textarea>
                    </div>
                    <div class="mb-3" aria-hidden="true" style="position:absolute;left:-10000px;height:1px;overflow:hidden;">
                        <label for="website">Website</label>
                        <input type="text" id="website" name="website" tabindex="-1" autocomplete="off">
                    </div>
                    <button type="submit" class="rts-btn btn-primary">Send Message</button>
                    <p id="contact-status" class="ek-verify-note" role="status" aria-live="polite"></p>
                </form>
            </div>
            <div class="col-lg-5">
                <h2 style="font-size:1.25rem;">Other channels</h2>
                <ul>
                    <li><a href="<?= ek_e((string) ek_config('github')) ?>" rel="noopener noreferrer" target="_blank">GitHub</a></li>
                    <?php if (ek_config('linkedin')): ?>
                        <li><a href="<?= ek_e((string) ek_config('linkedin')) ?>" rel="noopener noreferrer" target="_blank">LinkedIn</a></li>
                    <?php endif; ?>
                </ul>
                <p class="ek-verify-note mt--30">Personal phone numbers and private emails are not published on this site. Set <code>EKBOTIX_CONTACT_EMAIL</code> on the server to enable mail delivery.</p>
            </div>
        </div>
    </div>
</section>

<script>
document.getElementById('contact-form')?.addEventListener('submit', async (e) => {
  e.preventDefault();
  const form = e.target;
  const status = document.getElementById('contact-status');
  status.textContent = 'Sending…';
  try {
    const res = await fetch(form.action, { method: 'POST', body: new FormData(form), headers: { 'Accept': 'application/json' } });
    const data = await res.json();
    status.textContent = data.message || (res.ok ? 'Sent.' : 'Unable to send.');
    if (res.ok) form.reset();
  } catch (err) {
    status.textContent = 'Network error. Please try again later.';
  }
});
</script>

<?php ek_component('footer'); ?>
