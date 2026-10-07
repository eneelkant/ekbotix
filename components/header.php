<?php
$nav = ek_load_data('nav');
$pageTitle = $pageTitle ?? null;
$pageDescription = $pageDescription ?? null;
$canonicalPath = $canonicalPath ?? ($GLOBALS['ek_route'] ?? '/');
$ogType = $ogType ?? 'website';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= ek_e(ek_page_title($pageTitle)) ?></title>
    <meta name="description" content="<?= ek_e(ek_meta_description($pageDescription)) ?>">
    <link rel="canonical" href="<?= ek_e(ek_url($canonicalPath === '/' ? '/' : $canonicalPath)) ?>">
    <meta property="og:title" content="<?= ek_e(ek_page_title($pageTitle)) ?>">
    <meta property="og:description" content="<?= ek_e(ek_meta_description($pageDescription)) ?>">
    <meta property="og:type" content="<?= ek_e($ogType) ?>">
    <meta property="og:url" content="<?= ek_e(ek_url($canonicalPath === '/' ? '/' : $canonicalPath)) ?>">
    <meta property="og:site_name" content="<?= ek_e((string) ek_config('app_name')) ?>">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?= ek_e(ek_page_title($pageTitle)) ?>">
    <meta name="twitter:description" content="<?= ek_e(ek_meta_description($pageDescription)) ?>">
    <link rel="shortcut icon" type="image/x-icon" href="<?= ek_e(ek_asset('images/fav.png')) ?>">
    <link rel="stylesheet preload" href="<?= ek_e(ek_asset('css/plugins/swiper.min.css')) ?>" as="style">
    <link rel="stylesheet preload" href="<?= ek_e(ek_asset('css/plugins/magnific-popup.css')) ?>" as="style">
    <link rel="stylesheet preload" href="<?= ek_e(ek_asset('css/plugins/metismenu.css')) ?>" as="style">
    <link rel="stylesheet preload" href="<?= ek_e(ek_asset('css/vendor/bootstrap.min.css')) ?>" as="style">
    <link rel="stylesheet preload" href="<?= ek_e(ek_asset('css/plugins/fontawesome.min.css')) ?>" as="style">
    <link rel="stylesheet preload" href="<?= ek_e(ek_asset('css/style.css')) ?>" as="style">
    <link rel="stylesheet" href="<?= ek_e(ek_asset('css/ekbotix.css')) ?>">
    <?php if (!empty($schemaJson)): ?>
    <script type="application/ld+json"><?= $schemaJson ?></script>
    <?php endif; ?>
</head>
<body class="ek-body">
<a class="ek-skip-link" href="#main-content">Skip to content</a>

<header class="header-style-one header--sticky ek-nav">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="header-style-one-wrapper">
                    <div class="logo-area">
                        <a href="<?= ek_e(ek_url('/')) ?>" class="logo" aria-label="Ekbotix home">
                            <img class="light" src="<?= ek_e(ek_asset('images/logo/ekbotix.svg')) ?>" alt="Ekbotix" width="160" height="36">
                            <img class="dark" src="<?= ek_e(ek_asset('images/logo/ekbotix-dark.svg')) ?>" alt="Ekbotix" width="160" height="36">
                        </a>
                    </div>
                    <?php ek_component('navigation', ['nav' => $nav, 'mobile' => false]); ?>
                    <div class="button-area-start">
                        <a href="<?= ek_e(ek_url('/resume')) ?>" class="rts-btn btn-primary">View Resume</a>
                        <button type="button" class="menu-btn" id="menu-btn" aria-label="Open menu" aria-controls="side-bar" aria-expanded="false">
                            <svg width="20" height="16" viewBox="0 0 20 16" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                <rect y="14" width="20" height="2" fill="#1F1F25"></rect>
                                <rect y="7" width="20" height="2" fill="#1F1F25"></rect>
                                <rect width="20" height="2" fill="#1F1F25"></rect>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<div id="side-bar" class="side-bar header-two" role="dialog" aria-label="Mobile navigation">
    <button type="button" class="close-icon-menu" aria-label="Close menu"><i class="fa-sharp fa-thin fa-xmark" aria-hidden="true"></i></button>
    <div class="mobile-menu-main">
        <?php ek_component('navigation', ['nav' => $nav, 'mobile' => true]); ?>
        <ul class="social-area-one pl--20 mt--80">
            <li><a href="<?= ek_e((string) ek_config('github')) ?>" rel="noopener noreferrer" target="_blank" aria-label="GitHub"><i class="fa-brands fa-github" aria-hidden="true"></i></a></li>
        </ul>
    </div>
</div>

<main id="main-content">
