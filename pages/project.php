<?php
$slug = $GLOBALS['ek_project_slug'] ?? '';
$project = null;
foreach (ek_load_data('projects') as $p) {
    if (($p['slug'] ?? '') === $slug) {
        $project = $p;
        break;
    }
}
if ($project === null) {
    http_response_code(404);
    require __DIR__ . '/404.php';
    return;
}
$pageTitle = $project['title'];
$pageDescription = $project['summary'];
$canonicalPath = '/projects/' . $project['slug'];
ek_page(['pageTitle' => $pageTitle, 'pageDescription' => $pageDescription, 'canonicalPath' => $canonicalPath]);
ek_component('header');
?>

<section class="single-case-studies-bread-crumb-area area-2 pt--120 pb--60">
    <div class="container">
        <div class="breadcrumb-inner">
            <div class="pagimation">
                <a href="<?= ek_e(ek_url('/')) ?>">Home</a><i class="fa-regular fa-chevron-right" aria-hidden="true"></i>
                <a href="<?= ek_e(ek_url('/projects')) ?>">Projects</a><i class="fa-regular fa-chevron-right" aria-hidden="true"></i>
                <span class="current"><?= ek_e($project['title']) ?></span>
            </div>
            <p class="mb--10" style="color:#614CE1;font-weight:600;"><?= ek_e($project['category']) ?></p>
            <h1 class="title"><?= ek_e($project['title']) ?></h1>
        </div>
    </div>
</section>

<section class="rts-section-gapBottom">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 ek-article">
                <h2>Problem</h2>
                <p><?= ek_e($project['problem']) ?></p>
                <h2>Solution</h2>
                <p><?= ek_e($project['solution']) ?></p>
                <h2>Technology</h2>
                <div class="ek-skill-grid mb--30">
                    <?php foreach ($project['technology'] as $tech): ?>
                        <div class="ek-skill"><?= ek_e($tech) ?></div>
                    <?php endforeach; ?>
                </div>
                <h2>Workflow</h2>
                <p><?= ek_e($project['workflow']) ?></p>
                <h2>Impact</h2>
                <p><?= ek_e($project['impact']) ?></p>
                <h2>Role</h2>
                <p><?= ek_e($project['role']) ?></p>
                <?php if (!empty($project['links'])): ?>
                    <h2>Links</h2>
                    <ul>
                        <?php foreach ($project['links'] as $link): ?>
                            <li>
                                <?php
                                $url = $link['url'];
                                $external = str_starts_with($url, 'http');
                                $href = $external ? $url : ek_url($url);
                                ?>
                                <a href="<?= ek_e($href) ?>"<?= $external ? ' rel="noopener noreferrer" target="_blank"' : '' ?>><?= ek_e($link['label']) ?></a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
                <a href="<?= ek_e(ek_url('/projects')) ?>" class="rts-btn btn-primary mt--40">Back to Projects</a>
            </div>
        </div>
    </div>
</section>

<?php ek_component('footer'); ?>
