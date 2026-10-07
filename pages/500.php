<?php
http_response_code(500);
$pageTitle = 'Server Error';
$pageDescription = 'Something went wrong.';
$canonicalPath = '/500';
ek_page(['pageTitle' => $pageTitle, 'pageDescription' => $pageDescription, 'canonicalPath' => $canonicalPath]);
ek_component('header');
?>

<div class="rts-error-section">
    <div class="section-inner">
        <div class="wrapper-para mt--45">
            <h1 class="title">Something went wrong</h1>
            <p class="disc">An unexpected error occurred. Please try again later.</p>
            <a href="<?= ek_e(ek_url('/')) ?>" class="rts-btn btn-primary m-auto">Back to Home</a>
        </div>
    </div>
</div>

<?php ek_component('footer'); ?>
