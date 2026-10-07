<?php
$pageTitle = 'About';
$pageDescription = 'Career story of Neelkant E. — from digital marketing to AI automation and agents.';
$canonicalPath = '/about';
ek_page(['pageTitle' => $pageTitle, 'pageDescription' => $pageDescription, 'canonicalPath' => $canonicalPath]);
ek_component('header');
?>

<section class="single-case-studies-bread-crumb-area area-2 pt--120 pb--60">
    <div class="container">
        <div class="breadcrumb-inner">
            <div class="pagimation">
                <a href="<?= ek_e(ek_url('/')) ?>">Home</a><i class="fa-regular fa-chevron-right" aria-hidden="true"></i>
                <span class="current">About</span>
            </div>
            <h1 class="title">About</h1>
        </div>
    </div>
</section>

<section class="rts-section-gapBottom">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <p class="lead" style="font-size:1.25rem;color:#1F1F25;">I build intelligent systems that turn repetitive marketing and business operations into automated workflows.</p>
                <p style="color:#4F4F55;line-height:1.75;">My career evolved from digital marketing into marketing automation, then CRM and MarTech platforms, then data and analytics — and now AI automation and AI agents. Each step added a systems layer: not just campaigns, but the pipelines, integrations, and decision logic that make marketing operations reliable.</p>
                <h2 class="mt--40">How I work</h2>
                <p style="color:#4F4F55;line-height:1.75;">I focus on problem framing first: where humans repeat the same triage, sync, or reporting work. Then I design workflows that connect tools — CRM, Account Engagement / HubSpot, GA4, BigQuery, Looker Studio, Apps Script, APIs, n8n/Zapier, and LLM-assisted steps — with clear ownership and measurable operational improvement.</p>
                <h2 class="mt--40">Technology with accountability</h2>
                <p style="color:#4F4F55;line-height:1.75;">AI is useful when it is constrained: structured inputs, tool boundaries, confidence gates, and human review where risk is high. Products like the Ekbotix Email Verifier show the same mindset applied to software — modular pipelines, honest uncertainty (unknown beats a false “safe”), and documentation of hosting limits.</p>
                <h2 class="mt--40">What Ekbotix is</h2>
                <p style="color:#4F4F55;line-height:1.75;">Ekbotix is a personal technology and product brand — a professional portfolio and working tools — not a marketing agency or generic consultancy site.</p>
                <div class="ek-cta-group mt--40">
                    <a href="<?= ek_e(ek_url('/experience')) ?>" class="rts-btn btn-primary">Experience</a>
                    <a href="<?= ek_e(ek_url('/projects')) ?>" class="rts-btn btn-primary btn-white">Projects</a>
                </div>
            </div>
        </div>
    </div>
</section>

<?php ek_component('footer'); ?>
