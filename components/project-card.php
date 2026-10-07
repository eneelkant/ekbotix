<?php /** @var array $project */ ?>
<div class="col-lg-4 col-md-6 col-sm-10">
    <article class="single-blog-area-style-one h-100">
        <div class="inner-content-wrapper" style="padding-top:1.5rem;">
            <span class="admin"><?= ek_e($project['category'] ?? '') ?></span>
            <a href="<?= ek_e(ek_url('/projects/' . ($project['slug'] ?? ''))) ?>">
                <h6 class="title mt--10"><?= ek_e($project['title'] ?? '') ?></h6>
            </a>
            <p class="mt--15" style="color:#4F4F55;"><?= ek_e($project['summary'] ?? '') ?></p>
            <a class="mt--20 d-inline-block" href="<?= ek_e(ek_url('/projects/' . ($project['slug'] ?? ''))) ?>">View project →</a>
        </div>
    </article>
</div>
