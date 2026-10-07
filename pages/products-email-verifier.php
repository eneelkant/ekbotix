<?php
$pageTitle = 'Email Verifier';
$pageDescription = 'Email verification built for automation — syntax, MX, SMTP, disposable and role checks.';
$canonicalPath = '/products/email-verifier';
$extraScripts = [ek_asset('js/email-verifier.js')];
ek_page(['pageTitle' => $pageTitle, 'pageDescription' => $pageDescription, 'canonicalPath' => $canonicalPath, 'extraScripts' => $extraScripts]);
ek_component('header');
?>

<section class="single-case-studies-bread-crumb-area area-2 pt--120 pb--40">
    <div class="container">
        <div class="breadcrumb-inner">
            <div class="pagimation">
                <a href="<?= ek_e(ek_url('/')) ?>">Home</a><i class="fa-regular fa-chevron-right" aria-hidden="true"></i>
                <a href="<?= ek_e(ek_url('/products')) ?>">Products</a><i class="fa-regular fa-chevron-right" aria-hidden="true"></i>
                <span class="current">Email Verifier</span>
            </div>
            <h1 class="title">Email Verification, Built for Automation</h1>
            <p class="mt--15" style="max-width:40rem;">Validate email addresses before they enter your CRM, marketing automation or lead-generation workflows.</p>
        </div>
    </div>
</section>

<section class="rts-section-gapBottom">
    <div class="container">
        <div class="row">
            <div class="col-lg-7">
                <form id="email-verify-form" class="p-4" style="background:#F8F9FB;border:1px solid #D7D9E9;border-radius:12px;" novalidate>
                    <?= ek_csrf_field() ?>
                    <label for="to_email" class="form-label"><strong>Email Address</strong></label>
                    <input type="email" class="form-control form-control-lg" id="to_email" name="to_email" placeholder="someone@example.com" maxlength="254" required autocomplete="email">
                    <button type="submit" class="rts-btn btn-primary mt--25" id="verify-btn">Verify Email</button>
                    <p id="verify-status" class="ek-verify-note" role="status" aria-live="polite"></p>
                </form>

                <div id="verify-result" class="ek-verify-result" hidden>
                    <p>Reachability: <span id="res-reachable" class="ek-reachable"></span></p>
                    <div class="ek-verify-grid mt--20">
                        <div class="ek-verify-metric"><strong>Syntax</strong><span id="res-syntax"></span></div>
                        <div class="ek-verify-metric"><strong>Domain / MX</strong><span id="res-mx"></span></div>
                        <div class="ek-verify-metric"><strong>SMTP</strong><span id="res-smtp"></span></div>
                        <div class="ek-verify-metric"><strong>Deliverability</strong><span id="res-deliverable"></span></div>
                        <div class="ek-verify-metric"><strong>Catch-all</strong><span id="res-catchall"></span></div>
                        <div class="ek-verify-metric"><strong>Disposable</strong><span id="res-disposable"></span></div>
                        <div class="ek-verify-metric"><strong>Role Account</strong><span id="res-role"></span></div>
                    </div>
                    <pre id="res-json" class="mt--30 p-3" style="background:#1F1F25;color:#fff;border-radius:8px;overflow:auto;font-size:.8rem;"></pre>
                </div>
            </div>
            <div class="col-lg-5 mt_md--40">
                <h2 style="font-size:1.25rem;">Pipeline</h2>
                <ol style="color:#4F4F55;line-height:1.8;">
                    <li>Normalize &amp; syntax validation</li>
                    <li>Domain extraction &amp; DNS / MX</li>
                    <li>SMTP connection &amp; verification (when hosting allows)</li>
                    <li>Catch-all, disposable, role-account checks</li>
                    <li>Classify: safe / risky / invalid / unknown</li>
                </ol>
                <p class="ek-verify-note">SMTP probes never send mail. Hosts that block outbound port 25 return <code>unknown</code> rather than a fabricated result.</p>

                <h2 class="mt--40" style="font-size:1.25rem;">Open Source Foundation</h2>
                <p style="color:#4F4F55;">This tool was developed using the open-source <a href="https://github.com/reacherhq/check-if-email-exists" rel="noopener noreferrer" target="_blank">Reacher check-if-email-exists</a> project as a technical reference for verification stages and response shape. It is an independent PHP implementation — not official Reacher software and not endorsed by Reacher maintainers.</p>
            </div>
        </div>
    </div>
</section>

<?php ek_component('footer'); ?>
