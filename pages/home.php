<?php
$pageTitle = null;
$pageDescription = 'Neelkant E. — AI & Marketing Automation Specialist. Portfolio of automation systems, CRM/MarTech, analytics, AI agents, and products.';
$canonicalPath = '/';
$schemaJson = json_encode([
    '@context' => 'https://schema.org',
    '@type' => 'Person',
    'name' => ek_config('person_full'),
    'jobTitle' => ek_config('title'),
    'url' => ek_url('/'),
    'sameAs' => array_values(array_filter([ek_config('github'), ek_config('linkedin')])),
], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);

ek_page(['pageTitle' => $pageTitle, 'pageDescription' => $pageDescription, 'canonicalPath' => $canonicalPath, 'schemaJson' => $schemaJson]);
ek_component('header');
ek_component('hero');

$projects = array_values(array_filter(ek_load_data('projects'), static fn ($p) => !empty($p['featured'])));
$articles = ek_load_data('articles');
$skills = [
    'Marketing Automation', 'AI Automation', 'AI Agents', 'CRM / MarTech',
    'Salesforce Account Engagement', 'HubSpot', 'GA4', 'BigQuery',
    'Looker Studio', 'Google Apps Script', 'APIs', 'Python', 'PHP',
    'JavaScript', 'n8n', 'Zapier', 'Data & Analytics',
];
$evolution = [
    'Digital Marketing',
    'Marketing Automation',
    'CRM & MarTech',
    'Data & Analytics',
    'AI Automation',
    'AI Agents',
];
?>

<section class="rts-section-gap" aria-labelledby="evolution-heading">
    <div class="container">
        <div class="title-style-one-center mb--50">
            <h2 id="evolution-heading" class="title">Career Evolution</h2>
            <p class="disc">A path from digital marketing into systems, data, and agentic automation.</p>
        </div>
        <ol class="ek-evolution">
            <?php foreach ($evolution as $step): ?>
                <li><?= ek_e($step) ?></li>
            <?php endforeach; ?>
        </ol>
    </div>
</section>

<section class="rts-section-gap bg_white" style="background:var(--section-bg-gray,#F8F9FB);" aria-labelledby="impact-heading">
    <div class="container">
        <div class="title-style-one-center mb--40">
            <h2 id="impact-heading" class="title">Impact</h2>
            <p class="disc">Measurable outcomes where verified. Unverified figures stay marked.</p>
        </div>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="single-service-one text-center p-4">
                    <h3 class="title" style="font-size:1.1rem;">Operational automation</h3>
                    <p>[VERIFY METRIC] Reduced repetitive marketing ops work through workflow automation.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="single-service-one text-center p-4">
                    <h3 class="title" style="font-size:1.1rem;">Reporting reliability</h3>
                    <p>[VERIFY METRIC] Faster recurring analytics cycles via GA4 / BigQuery / Looker Studio patterns.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="single-service-one text-center p-4">
                    <h3 class="title" style="font-size:1.1rem;">Shipped product</h3>
                    <p>Email Verifier — a working PHP verification pipeline with API and UI.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="rts-section-gap rts-blog-area-one" aria-labelledby="projects-heading">
    <div class="container">
        <div class="title-style-one-center mb--40">
            <h2 id="projects-heading" class="title">Featured Projects</h2>
            <p class="disc">Selected systems across automation, analytics, AI, and product engineering.</p>
        </div>
        <div class="row g-48">
            <?php foreach ($projects as $project) {
                ek_component('project-card', ['project' => $project]);
            } ?>
        </div>
        <div class="text-center mt--40">
            <a href="<?= ek_e(ek_url('/projects')) ?>" class="rts-btn btn-primary">All Projects</a>
        </div>
    </div>
</section>

<section class="rts-section-gap" style="background:#F8F9FB;" aria-labelledby="expertise-heading">
    <div class="container">
        <div class="title-style-one-center mb--40">
            <h2 id="expertise-heading" class="title">Expertise</h2>
            <p class="disc">Marketing + automation + data + APIs + AI + software.</p>
        </div>
        <div class="ek-skill-grid">
            <?php foreach ($skills as $skill): ?>
                <div class="ek-skill"><?= ek_e($skill) ?></div>
            <?php endforeach; ?>
        </div>
        <div class="text-center mt--40">
            <a href="<?= ek_e(ek_url('/expertise')) ?>" class="rts-btn btn-primary btn-white">Full Expertise</a>
        </div>
    </div>
</section>

<section class="rts-section-gap" aria-labelledby="ailab-heading">
    <div class="container">
        <div class="title-style-one-center mb--40">
            <h2 id="ailab-heading" class="title">AI Lab</h2>
            <p class="disc">Experiments, prototypes, and agentic workflow research.</p>
        </div>
        <div class="row g-4">
            <?php foreach (array_slice(ek_load_data('ai-lab'), 0, 3) as $exp): ?>
                <div class="col-md-4">
                    <div class="p-4 h-100" style="background:#fff;border:1px solid #D7D9E9;border-radius:12px;">
                        <span class="ek-status ek-status--<?= ek_e(strtolower($exp['status'])) ?>"><?= ek_e($exp['status']) ?></span>
                        <h3 class="mt--15" style="font-size:1.15rem;"><?= ek_e($exp['title']) ?></h3>
                        <p style="color:#4F4F55;"><?= ek_e($exp['problem']) ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="text-center mt--40">
            <a href="<?= ek_e(ek_url('/ai-lab')) ?>" class="rts-btn btn-primary">Enter AI Lab</a>
        </div>
    </div>
</section>

<section class="rts-section-gap" style="background:linear-gradient(89deg,#CDD0ED 5.62%,#F0F2FF 90.1%);" aria-labelledby="products-heading">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-7">
                <h2 id="products-heading" class="title">Products</h2>
                <h3 class="mt--15" style="font-size:1.5rem;">Email Verifier</h3>
                <p class="mt--15" style="max-width:36rem;">Validate email addresses before they enter your CRM, marketing automation or lead-generation workflows.</p>
                <a href="<?= ek_e(ek_url('/products/email-verifier')) ?>" class="rts-btn btn-primary mt--30">Open Email Verifier</a>
            </div>
        </div>
    </div>
</section>

<section class="rts-section-gap rts-blog-area-one" aria-labelledby="insights-heading">
    <div class="container">
        <div class="title-style-one-center mb--40">
            <h2 id="insights-heading" class="title">Insights</h2>
            <p class="disc">Writing on AI automation, agents, and marketing operations.</p>
        </div>
        <div class="row g-48">
            <?php foreach ($articles as $article) {
                ek_component('blog-card', ['article' => $article]);
            } ?>
        </div>
    </div>
</section>

<section class="rts-section-gapBottom" aria-labelledby="final-cta">
    <div class="container text-center">
        <h2 id="final-cta" class="title">Let’s connect</h2>
        <p class="disc mx-auto" style="max-width:36rem;">Explore the interactive resume and projects — or get in touch about automation, MarTech, and AI systems work.</p>
        <div class="ek-cta-group justify-content-center mt--30">
            <a href="<?= ek_e(ek_url('/resume')) ?>" class="rts-btn btn-primary">View Resume</a>
            <a href="<?= ek_e(ek_url('/contact')) ?>" class="rts-btn btn-primary btn-white">Contact</a>
        </div>
    </div>
</section>

<?php ek_component('footer'); ?>
