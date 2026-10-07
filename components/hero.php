<section class="rts-banner-area-one home-five rts-section-gap ek-hero" aria-labelledby="hero-brand">
    <div class="container pt--120 pt_sm--100 pb--80">
        <div class="row align-items-center">
            <div class="col-lg-7">
                <p class="mb--10" style="font-weight:600;color:#614CE1;letter-spacing:.04em;text-transform:uppercase;font-size:.85rem;">Personal portfolio · Ekbotix</p>
                <h1 id="hero-brand" class="ek-hero__brand"><?= ek_e((string) ek_config('person_name')) ?></h1>
                <p class="ek-hero__title"><?= ek_e((string) ek_config('title')) ?></p>
                <p class="ek-hero__lead">I build intelligent systems that turn repetitive marketing and business operations into automated workflows.</p>
                <p class="ek-hero__support">From digital marketing and marketing automation to CRM, analytics, APIs and AI agents — I design systems that connect data, technology and automation to reduce manual work and improve operational efficiency.</p>
                <div class="ek-cta-group">
                    <a href="<?= ek_e(ek_url('/projects')) ?>" class="rts-btn btn-primary">Explore My Work</a>
                    <a href="<?= ek_e(ek_url('/resume')) ?>" class="rts-btn btn-primary btn-white">View Resume</a>
                    <a href="<?= ek_e(ek_url('/products')) ?>" class="rts-btn btn-primary btn-white">Explore Products</a>
                </div>
            </div>
            <div class="col-lg-5 mt_md--40 mt_sm--40">
                <img src="<?= ek_e(ek_asset('images/banner/01.png')) ?>" alt="Automation and systems illustration" class="img-fluid" width="640" height="480" loading="eager">
            </div>
        </div>
    </div>
</section>
