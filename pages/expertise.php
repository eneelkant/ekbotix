<?php
$pageTitle = 'Expertise';
$pageDescription = 'Marketing automation, data & analytics, AI automation, and development skills.';
$canonicalPath = '/expertise';
ek_page(['pageTitle' => $pageTitle, 'pageDescription' => $pageDescription, 'canonicalPath' => $canonicalPath]);
ek_component('header');

$groups = [
    'Marketing Automation' => [
        'Salesforce Account Engagement / Pardot',
        'HubSpot',
        'MailWizz',
        'Lead routing',
        'Campaign automation',
        'Email automation',
    ],
    'Data & Analytics' => [
        'GA4',
        'BigQuery',
        'Looker Studio',
        'Google Search Console',
        'Google Sheets',
        'Apps Script',
    ],
    'AI & Automation' => [
        'AI agents',
        'LLM workflows',
        'AI lead classification',
        'n8n',
        'Zapier',
        'MCP',
        'Automation orchestration',
    ],
    'Development' => [
        'PHP',
        'Python',
        'JavaScript',
        'jQuery',
        'REST APIs',
        'JSON',
        'SQL',
        'Git / GitHub',
    ],
];
?>

<section class="single-case-studies-bread-crumb-area area-2 pt--120 pb--60">
    <div class="container">
        <div class="breadcrumb-inner">
            <div class="pagimation">
                <a href="<?= ek_e(ek_url('/')) ?>">Home</a><i class="fa-regular fa-chevron-right" aria-hidden="true"></i>
                <span class="current">Expertise</span>
            </div>
            <h1 class="title">Expertise</h1>
        </div>
    </div>
</section>

<section class="rts-section-gapBottom">
    <div class="container">
        <?php foreach ($groups as $title => $items): ?>
            <h2 class="mb--25" style="font-size:1.5rem;"><?= ek_e($title) ?></h2>
            <div class="ek-skill-grid mb--50">
                <?php foreach ($items as $item): ?>
                    <div class="ek-skill"><?= ek_e($item) ?></div>
                <?php endforeach; ?>
            </div>
        <?php endforeach; ?>
    </div>
</section>

<?php ek_component('footer'); ?>
