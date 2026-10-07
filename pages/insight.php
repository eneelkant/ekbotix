<?php
$slug = $GLOBALS['ek_article_slug'] ?? '';
$article = null;
foreach (ek_load_data('articles') as $a) {
    if (($a['slug'] ?? '') === $slug) {
        $article = $a;
        break;
    }
}
if ($article === null) {
    http_response_code(404);
    require __DIR__ . '/404.php';
    return;
}
$pageTitle = $article['title'];
$pageDescription = $article['excerpt'];
$canonicalPath = '/insights/' . $article['slug'];
$ogType = 'article';
ek_page(['pageTitle' => $pageTitle, 'pageDescription' => $pageDescription, 'canonicalPath' => $canonicalPath, 'ogType' => $ogType]);
ek_component('header');
$bodyFile = ek_config('paths.root') . '/blog/' . $article['file'];
?>

<section class="single-case-studies-bread-crumb-area area-2 pt--120 pb--40">
    <div class="container">
        <div class="breadcrumb-inner">
            <div class="pagimation">
                <a href="<?= ek_e(ek_url('/')) ?>">Home</a><i class="fa-regular fa-chevron-right" aria-hidden="true"></i>
                <a href="<?= ek_e(ek_url('/insights')) ?>">Insights</a><i class="fa-regular fa-chevron-right" aria-hidden="true"></i>
                <span class="current"><?= ek_e($article['title']) ?></span>
            </div>
            <h1 class="title"><?= ek_e($article['title']) ?></h1>
            <p class="mt--10"><?= ek_e((string) ek_config('person_name')) ?> · <?= ek_e(date('d F Y', strtotime($article['date']))) ?></p>
        </div>
    </div>
</section>

<section class="rts-section-gapBottom">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 ek-article">
                <?php if (is_file($bodyFile)) {
                    require $bodyFile;
                } ?>
                <a href="<?= ek_e(ek_url('/insights')) ?>" class="rts-btn btn-primary mt--40">All Insights</a>
            </div>
        </div>
    </div>
</section>

<?php ek_component('footer'); ?>
