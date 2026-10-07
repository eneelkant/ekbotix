<?php
$pageTitle = 'Resume';
$pageDescription = 'Interactive online resume — Neelkant E., AI & Marketing Automation Specialist.';
$canonicalPath = '/resume';
$resumeFile = ek_config('paths.root') . '/assets/files/resume.pdf';
$hasResumeDownload = is_file($resumeFile);
ek_page(['pageTitle' => $pageTitle, 'pageDescription' => $pageDescription, 'canonicalPath' => $canonicalPath, 'hasResumeDownload' => $hasResumeDownload]);
ek_component('header');
?>

<section class="single-case-studies-bread-crumb-area area-2 pt--120 pb--60">
    <div class="container">
        <div class="breadcrumb-inner">
            <div class="pagimation">
                <a href="<?= ek_e(ek_url('/')) ?>">Home</a><i class="fa-regular fa-chevron-right" aria-hidden="true"></i>
                <span class="current">Resume</span>
            </div>
            <h1 class="title">Resume</h1>
            <p class="mt--10"><?= ek_e((string) ek_config('person_name')) ?> — <?= ek_e((string) ek_config('title')) ?></p>
            <?php if ($hasResumeDownload): ?>
                <a href="<?= ek_e(ek_asset('files/resume.pdf')) ?>" class="rts-btn btn-primary mt--25">Download Resume</a>
            <?php endif; ?>
        </div>
    </div>
</section>

<section class="rts-section-gapBottom">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-8">
                <h2>Professional Summary</h2>
                <p style="color:#4F4F55;line-height:1.75;"><?= ek_e((string) ek_config('tagline')) ?> Career progression spans digital marketing, marketing automation, CRM &amp; MarTech, data &amp; analytics, AI automation, and AI agents — with a focus on systems that connect tools and reduce manual operational work.</p>

                <h2 class="mt--40">Career Timeline</h2>
                <div class="ek-timeline mt--20">
                    <?php foreach (ek_load_data('experience') as $item) {
                        ek_component('experience-card', ['item' => $item]);
                    } ?>
                </div>

                <h2 class="mt--40">Selected Projects</h2>
                <ul>
                    <?php foreach (ek_load_data('projects') as $p): ?>
                        <li><a href="<?= ek_e(ek_url('/projects/' . $p['slug'])) ?>"><?= ek_e($p['title']) ?></a> — <?= ek_e($p['category']) ?></li>
                    <?php endforeach; ?>
                </ul>

                <h2 class="mt--40">AI / Automation Work</h2>
                <ul>
                    <?php foreach (ek_load_data('ai-lab') as $exp): ?>
                        <li><strong><?= ek_e($exp['title']) ?></strong> (<?= ek_e($exp['status']) ?>) — <?= ek_e($exp['problem']) ?></li>
                    <?php endforeach; ?>
                </ul>

                <h2 class="mt--40">Achievements</h2>
                <ul>
                    <li>Shipped Ekbotix Email Verifier with modular PHP pipeline, API, and tests.</li>
                    <li>[VERIFY METRIC] Operational improvements from automation and reporting systems — confirm before publishing external numbers.</li>
                </ul>

                <h2 class="mt--40">Education / Certifications</h2>
                <p style="color:#4F4F55;">[VERIFY] Add verified education and certification entries here.</p>
            </div>
            <div class="col-lg-4">
                <aside class="p-4" style="background:#F8F9FB;border-radius:12px;border:1px solid #D7D9E9;">
                    <h2 style="font-size:1.15rem;">Core Expertise</h2>
                    <div class="ek-skill-grid mt--20">
                        <?php foreach (['Marketing Automation', 'AI Agents', 'CRM / MarTech', 'GA4 / BigQuery', 'APIs', 'PHP / Python / JS'] as $s): ?>
                            <div class="ek-skill"><?= ek_e($s) ?></div>
                        <?php endforeach; ?>
                    </div>
                    <h2 class="mt--40" style="font-size:1.15rem;">Technology Stack</h2>
                    <p style="color:#4F4F55;font-size:.95rem;">Salesforce Account Engagement, HubSpot, MailWizz, GA4, BigQuery, Looker Studio, Apps Script, n8n, Zapier, MCP, REST APIs, PHP, Python, JavaScript, SQL, Git.</p>
                    <a href="<?= ek_e(ek_url('/contact')) ?>" class="rts-btn btn-primary mt--30 w-100 text-center">Contact</a>
                </aside>
            </div>
        </div>
    </div>
</section>

<?php ek_component('footer'); ?>
