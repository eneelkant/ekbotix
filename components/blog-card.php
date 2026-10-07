<?php /** @var array $article */ ?>
<div class="col-lg-4 col-md-6 col-sm-10">
    <article class="single-blog-area-style-one">
        <a href="<?= ek_e(ek_url('/insights/' . ($article['slug'] ?? ''))) ?>" class="thumbnail">
            <img src="<?= ek_e(ek_asset($article['image'] ?? 'images/blog/01.png')) ?>" alt="" loading="lazy" width="400" height="260">
        </a>
        <div class="inner-content-wrapper">
            <a href="<?= ek_e(ek_url('/insights/' . ($article['slug'] ?? ''))) ?>">
                <h6 class="title"><?= ek_e($article['title'] ?? '') ?></h6>
            </a>
            <div class="bottom-area">
                <span class="admin"><?= ek_e((string) ek_config('person_name')) ?></span>
                <span class="date">• <?= ek_e(isset($article['date']) ? date('d F, Y', strtotime($article['date'])) : '') ?></span>
            </div>
        </div>
    </article>
</div>
