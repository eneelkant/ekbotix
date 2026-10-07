<?php
$pageTitle = 'Products';
$pageDescription = 'Practical software tools built under Ekbotix — starting with Email Verifier.';
$canonicalPath = '/products';
ek_page(['pageTitle' => $pageTitle, 'pageDescription' => $pageDescription, 'canonicalPath' => $canonicalPath]);
ek_component('header');
?>

<section class="single-case-studies-bread-crumb-area area-2 pt--120 pb--60">
    <div class="container">
        <div class="breadcrumb-inner">
            <div class="pagimation">
                <a href="<?= ek_e(ek_url('/')) ?>">Home</a><i class="fa-regular fa-chevron-right" aria-hidden="true"></i>
                <span class="current">Products</span>
            </div>
            <h1 class="title">Products</h1>
            <p class="mt--15">Practical tools built by Neelkant under Ekbotix — not a SaaS company pitch.</p>
        </div>
    </div>
</section>

<section class="rts-section-gapBottom">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <article class="p-4 p-md-5" style="background:linear-gradient(89deg,#CDD0ED 5.62%,#F0F2FF 90.1%);border-radius:16px;">
                    <p style="color:#614CE1;font-weight:600;text-transform:uppercase;letter-spacing:.04em;font-size:.85rem;">Product 01</p>
                    <h2 style="font-size:2rem;">Email Verifier</h2>
                    <p class="mt--10" style="font-size:1.15rem;font-weight:600;">Email Verification, Built for Automation</p>
                    <p class="mt--20" style="max-width:36rem;">Validate email addresses before they enter your CRM, marketing automation or lead-generation workflows.</p>
                    <a href="<?= ek_e(ek_url('/products/email-verifier')) ?>" class="rts-btn btn-primary mt--30">Open Email Verifier</a>
                </article>
            </div>
        </div>
    </div>
</section>

<?php ek_component('footer'); ?>
