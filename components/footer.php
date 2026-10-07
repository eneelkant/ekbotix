</main>

<footer class="rts-footer-area footer-four rts-section-gap">
    <div class="container mb--40">
        <div class="row g-48">
            <div class="col-lg-4 col-md-6 col-12">
                <div class="single-footer-wized-one">
                    <h6 class="title"><?= ek_e((string) ek_config('app_name')) ?></h6>
                    <p><?= ek_e((string) ek_config('person_name')) ?> — <?= ek_e((string) ek_config('title')) ?>.</p>
                    <p class="mt--10"><?= ek_e((string) ek_config('tagline')) ?></p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-12">
                <div class="single-footer-wized-one">
                    <h6 class="title">Explore</h6>
                    <ul>
                        <?php foreach (ek_load_data('nav') as $item): ?>
                            <li><a href="<?= ek_e(ek_url($item['href'])) ?>"><?= ek_e($item['label']) ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-12">
                <div class="single-footer-wized-one">
                    <h6 class="title">Products &amp; Work</h6>
                    <ul>
                        <li><a href="<?= ek_e(ek_url('/products/email-verifier')) ?>">Email Verifier</a></li>
                        <li><a href="<?= ek_e(ek_url('/projects')) ?>">Projects</a></li>
                        <li><a href="<?= ek_e(ek_url('/ai-lab')) ?>">AI Lab</a></li>
                        <li><a href="<?= ek_e(ek_url('/insights')) ?>">Insights</a></li>
                        <li><a href="<?= ek_e((string) ek_config('github')) ?>" rel="noopener noreferrer" target="_blank">GitHub</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="copyright-area-four pt--40 mt-40 border-top">
                    <a href="<?= ek_e(ek_url('/')) ?>" class="logo">
                        <img class="light" src="<?= ek_e(ek_asset('images/logo/ekbotix.svg')) ?>" alt="Ekbotix" width="140" height="32">
                        <img class="dark" src="<?= ek_e(ek_asset('images/logo/ekbotix-dark.svg')) ?>" alt="Ekbotix" width="140" height="32">
                    </a>
                    <p>© <?= ek_e(gmdate('Y')) ?> Ekbotix. Personal professional portfolio of <?= ek_e((string) ek_config('person_name')) ?>.</p>
                </div>
            </div>
        </div>
    </div>
</footer>

<div id="anywhere-home" class=""></div>

<div class="progress-wrap">
    <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
        <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
    </svg>
</div>

<script defer src="<?= ek_e(ek_asset('js/plugins/jquery.min.js')) ?>"></script>
<script defer src="<?= ek_e(ek_asset('js/plugins/bootstrap.min.js')) ?>"></script>
<script defer src="<?= ek_e(ek_asset('js/plugins/metismenu.js')) ?>"></script>
<script defer src="<?= ek_e(ek_asset('js/vendor/jqueryui.js')) ?>"></script>
<script defer src="<?= ek_e(ek_asset('js/vendor/waypoint.js')) ?>"></script>
<script defer src="<?= ek_e(ek_asset('js/plugins/swiper.js')) ?>"></script>
<script defer src="<?= ek_e(ek_asset('js/plugins/theia-sticky-sidebar.min.js')) ?>"></script>
<script defer src="<?= ek_e(ek_asset('js/plugins/gsap.min.js')) ?>"></script>
<script defer src="<?= ek_e(ek_asset('js/plugins/scrolltigger.js')) ?>"></script>
<script defer src="<?= ek_e(ek_asset('js/vendor/split-text.js')) ?>"></script>
<script defer src="<?= ek_e(ek_asset('js/vendor/split-type.js')) ?>"></script>
<script defer src="<?= ek_e(ek_asset('js/vendor/waw.js')) ?>"></script>
<script defer src="<?= ek_e(ek_asset('js/plugins/counter-up.js')) ?>"></script>
<script defer src="<?= ek_e(ek_asset('js/plugins/magnific-popup.js')) ?>"></script>
<script defer src="<?= ek_e(ek_asset('js/main.js')) ?>"></script>
<?php if (!empty($extraScripts)): ?>
    <?php foreach ((array) $extraScripts as $scriptSrc): ?>
        <script defer src="<?= ek_e($scriptSrc) ?>"></script>
    <?php endforeach; ?>
<?php endif; ?>
</body>
</html>
