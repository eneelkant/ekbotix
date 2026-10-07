<?php
$pageTitle = 'Experience';
$pageDescription = 'Career timeline — marketing automation, CRM/MarTech, analytics, AI automation.';
$canonicalPath = '/experience';
ek_page(['pageTitle' => $pageTitle, 'pageDescription' => $pageDescription, 'canonicalPath' => $canonicalPath]);
ek_component('header');
?>

<section class="single-case-studies-bread-crumb-area area-2 pt--120 pb--60">
    <div class="container">
        <div class="breadcrumb-inner">
            <div class="pagimation">
                <a href="<?= ek_e(ek_url('/')) ?>">Home</a><i class="fa-regular fa-chevron-right" aria-hidden="true"></i>
                <span class="current">Experience</span>
            </div>
            <h1 class="title">Experience</h1>
            <p class="mt--15" style="max-width:40rem;">Timeline of professional focus areas. Incomplete employer or date details are marked <code>[VERIFY]</code> rather than invented.</p>
        </div>
    </div>
</section>

<section class="rts-section-gapBottom">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="ek-timeline">
                    <?php foreach (ek_load_data('experience') as $item) {
                        ek_component('experience-card', ['item' => $item]);
                    } ?>
                </div>
            </div>
        </div>
    </div>
</section>

<?php ek_component('footer'); ?>
