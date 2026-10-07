<?php
$pageTitle = 'Insights';
$pageDescription = 'Articles on AI automation, agents, and marketing operations.';
$canonicalPath = '/insights';
ek_page(['pageTitle' => $pageTitle, 'pageDescription' => $pageDescription, 'canonicalPath' => $canonicalPath]);
ek_component('header');
?>

<section class="single-case-studies-bread-crumb-area area-2 pt--120 pb--60">
    <div class="container">
        <div class="breadcrumb-inner">
            <div class="pagimation">
                <a href="<?= ek_e(ek_url('/')) ?>">Home</a><i class="fa-regular fa-chevron-right" aria-hidden="true"></i>
                <span class="current">Insights</span>
            </div>
            <h1 class="title">Insights</h1>
        </div>
    </div>
</section>

<section class="rts-section-gapBottom rts-blog-area-one">
    <div class="container">
        <div class="row g-48">
            <?php foreach (ek_load_data('articles') as $article) {
                ek_component('blog-card', ['article' => $article]);
            } ?>
        </div>
    </div>
</section>

<?php ek_component('footer'); ?>
