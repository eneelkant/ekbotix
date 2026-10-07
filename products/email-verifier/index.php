<?php

declare(strict_types=1);

// Direct access redirects into the front-controller product page.
header('Location: /products/email-verifier', true, 302);
exit;
