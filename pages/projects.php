<?php
$pageTitle = 'Projects';
$pageDescription = 'Selected projects across marketing automation, analytics, AI, integrations, and product engineering.';
$canonicalPath = '/projects';
ek_page(['pageTitle' => $pageTitle, 'pageDescription' => $pageDescription, 'canonicalPath' => $canonicalPath]);
ek_component('header');
$projects = ek_load_data('projects');
$categories = array_values(array_unique(array_map(static fn ($p) => $p['category'], $projects)));
?>

<section class="single-case-studies-bread-crumb-area area-2 pt--120 pb--60">
    <div class="container">
        <div class="breadcrumb-inner">
            <div class="pagimation">
                <a href="<?= ek_e(ek_url('/')) ?>">Home</a><i class="fa-regular fa-chevron-right" aria-hidden="true"></i>
                <span class="current">Projects</span>
            </div>
            <h1 class="title">Projects</h1>
            <p class="mt--15">Real work patterns across automation, data, AI, and software. Impacts use [VERIFY METRIC] when not independently confirmed.</p>
        </div>
    </div>
</section>

<section class="rts-section-gapBottom rts-blog-area-one">
    <div class="container">
        <?php foreach ($categories as $cat): ?>
            <h2 class="mb--30" style="font-size:1.5rem;"><?= ek_e($cat) ?></h2>
            <div class="row g-48 mb--60">
                <?php foreach ($projects as $project) {
                    if (($project['category'] ?? '') !== $cat) {
                        continue;
                    }
                    ek_component('project-card', ['project' => $project]);
                } ?>
            </div>
        <?php endforeach; ?>
    </div>
</section>

<?php ek_component('footer'); ?>
