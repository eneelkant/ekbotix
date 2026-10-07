<?php
$pageTitle = 'AI Lab';
$pageDescription = 'AI agents, MCP experiments, and automation prototypes by Neelkant E.';
$canonicalPath = '/ai-lab';
ek_page(['pageTitle' => $pageTitle, 'pageDescription' => $pageDescription, 'canonicalPath' => $canonicalPath]);
ek_component('header');
?>

<section class="single-case-studies-bread-crumb-area area-2 pt--120 pb--60">
    <div class="container">
        <div class="breadcrumb-inner">
            <div class="pagimation">
                <a href="<?= ek_e(ek_url('/')) ?>">Home</a><i class="fa-regular fa-chevron-right" aria-hidden="true"></i>
                <span class="current">AI Lab</span>
            </div>
            <h1 class="title">AI Lab</h1>
            <p class="mt--15" style="max-width:40rem;">An experimental engineering space for agents, workflows, and intelligent processing — with honest status labels.</p>
        </div>
    </div>
</section>

<section class="rts-section-gapBottom">
    <div class="container">
        <div class="row g-4">
            <?php foreach (ek_load_data('ai-lab') as $exp): ?>
                <div class="col-lg-6">
                    <article class="p-4 h-100" style="background:#F8F9FB;border:1px solid #D7D9E9;border-radius:12px;">
                        <span class="ek-status ek-status--<?= ek_e(strtolower($exp['status'])) ?>"><?= ek_e($exp['status']) ?></span>
                        <h2 class="mt--20" style="font-size:1.35rem;"><?= ek_e($exp['title']) ?></h2>
                        <p><strong>Problem</strong><br><?= ek_e($exp['problem']) ?></p>
                        <p><strong>Approach</strong><br><?= ek_e($exp['approach']) ?></p>
                        <p><strong>Technology</strong><br><?= ek_e(implode(', ', $exp['technology'])) ?></p>
                        <p><strong>Workflow</strong><br><?= ek_e($exp['workflow']) ?></p>
                        <p><strong>Result</strong><br><?= ek_e($exp['result']) ?></p>
                    </article>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<?php ek_component('footer'); ?>
