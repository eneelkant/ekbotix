<?php
/** @var array $nav */
/** @var bool $mobile */
$mobile = $mobile ?? false;
if ($mobile): ?>
<nav class="nav-main mainmenu-nav mt--30" aria-label="Mobile">
    <ul class="mainmenu metismenu" id="mobile-menu-active">
        <?php foreach ($nav as $item): ?>
            <li>
                <a href="<?= ek_e(ek_url($item['href'])) ?>" class="main<?= ek_nav_class($item['href']) ?>"><?= ek_e($item['label']) ?></a>
            </li>
        <?php endforeach; ?>
    </ul>
</nav>
<?php else: ?>
<nav class="main-nav-area" aria-label="Primary">
    <ul class="list-unstyled fluxi-desktop-menu">
        <?php foreach ($nav as $item): ?>
            <li class="menu-item">
                <a class="main-element fluxi-dropdown-main-element<?= ek_nav_class($item['href']) ?>" href="<?= ek_e(ek_url($item['href'])) ?>"><?= ek_e($item['label']) ?></a>
            </li>
        <?php endforeach; ?>
    </ul>
</nav>
<?php endif; ?>
