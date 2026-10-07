<?php /** @var array $item */ ?>
<div class="ek-timeline__item">
    <p class="mb--5" style="color:#614CE1;font-weight:600;"><?= ek_e($item['period'] ?? '') ?></p>
    <h3 class="title" style="font-size:1.25rem;"><?= ek_e($item['title'] ?? '') ?></h3>
    <p class="mb--10"><strong><?= ek_e($item['org'] ?? '') ?></strong></p>
    <p style="color:#4F4F55;"><?= ek_e($item['focus'] ?? '') ?></p>
    <?php if (!empty($item['highlights'])): ?>
        <ul class="mt--15">
            <?php foreach ($item['highlights'] as $h): ?>
                <li><?= ek_e($h) ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
</div>
