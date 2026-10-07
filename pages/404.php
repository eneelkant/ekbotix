<?php
http_response_code(404);
$pageTitle = 'Page Not Found';
$pageDescription = 'The requested page could not be found.';
$canonicalPath = '/404';
ek_page(['pageTitle' => $pageTitle, 'pageDescription' => $pageDescription, 'canonicalPath' => $canonicalPath]);
ek_component('header');
?>

<div class="rts-error-section">
    <div class="section-inner">
        <img src="<?= ek_e(ek_asset('images/error.png')) ?>" alt="">
        <div class="wrapper-para mt--45">
            <h1 class="title">Page Not Found</h1>
            <p class="disc">The page you requested could not be found. Return to the homepage to continue exploring Ekbotix.</p>
            <a href="<?= ek_e(ek_url('/')) ?>" class="rts-btn btn-primary m-auto">Back to Home</a>
        </div>
    </div>
</div>

<?php ek_component('footer'); ?>
