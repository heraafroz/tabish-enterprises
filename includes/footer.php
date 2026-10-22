
<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$supportedLanguages = $supportedLanguages ?? [
    'en' => 'English',
    'ar' => 'العربية',
    'fr' => 'Français',
    'es' => 'Español',
    'de' => 'Deutsch'
];

$lang = $currentLang ?? ($_SESSION['lang'] ?? 'en');

if (!array_key_exists($lang, $supportedLanguages)) {
    $lang = 'en';
}

$isRTL = ($lang === 'ar');

/*
 * Preserve the existing translation function.
 * Do not redefine t() here.
 */
if (!function_exists('footerText')) {
    function footerText($key, $fallback = '')
    {
        if (function_exists('t')) {
            return t($key, $fallback);
        }

        global $translations;
        return $translations[$key] ?? ($fallback !== '' ? $fallback : $key);
    }
}
?>

<footer class="footer ecommerce-footer"
        lang="<?= htmlspecialchars($lang, ENT_QUOTES, 'UTF-8') ?>"
        dir="<?= $isRTL ? 'rtl' : 'ltr' ?>">

    

    <div class="container footer-main">

        <!-- Main Footer: Existing 4-column layout -->
        <div class="row g-4">

            <!-- Column 1: Brand -->
            <div class="col-12 col-md-6 col-lg-4">

                <a href="index.php" class="footer-brand">
                    <img
                        src="assets/images/tabish2-logo.png"
                        alt="Tabish Enterprises logo"
                        class="footer-logo"
                        width="320"
                        height="85"
                    >
                </a>

                <p class="footer-description">
                    <?= htmlspecialchars(
                        footerText(
                            'footer_description',
                            'Empowering businesses to grow online with expert e-commerce solutions, marketplace management, product cataloguing, digital marketing, and professional website development.'
                        ),
                        ENT_QUOTES,
                        'UTF-8'
                    ) ?>
                </p>

                <a href="contact.php" class="footer-contact-btn">
                    <span><?= htmlspecialchars(
                        footerText('footer_grow_business', "Let's Grow Your Business"),
                        ENT_QUOTES,
                        'UTF-8'
                    ) ?></span>
                    <i class="bi <?= $isRTL ? 'bi-arrow-left' : 'bi-arrow-right' ?>"
                       aria-hidden="true"></i>
                </a>

                <!-- Language Selector -->
                <div class="dropdown footer-language mt-3">

                    <button
                        class="btn footer-language-btn dropdown-toggle"
                        type="button"
                        id="footerLanguageDropdown"
                        data-bs-toggle="dropdown"
                        aria-expanded="false"
                    >
                        <?= htmlspecialchars(
                            $supportedLanguages[$lang] ?? 'English',
                            ENT_QUOTES,
                            'UTF-8'
                        ) ?>
                    </button>

                    <ul
                        class="dropdown-menu footer-language-menu"
                        aria-labelledby="footerLanguageDropdown"
                    >
                        <?php foreach ($supportedLanguages as $code => $name): ?>
                            <?php
                            $params = $_GET;
                            $params['lang'] = $code;

                            $languageUrl = basename(
                                $_SERVER['PHP_SELF'] ?? 'index.php'
                            ) . '?' . http_build_query($params);
                            ?>

                            <li>
                                <a
                                    class="dropdown-item <?= $lang === $code ? 'active' : '' ?>"
                                    href="<?= htmlspecialchars($languageUrl, ENT_QUOTES, 'UTF-8') ?>"
                                    lang="<?= htmlspecialchars($code, ENT_QUOTES, 'UTF-8') ?>"
                                    <?= $code === 'ar' ? 'dir="rtl"' : 'dir="ltr"' ?>
                                >
                                    <?= htmlspecialchars($name, ENT_QUOTES, 'UTF-8') ?>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>

                </div>

            </div>

            <!-- Column 2: E-commerce Solutions -->
            <div class="col-6 col-md-6 col-lg-3">

                <h2 class="footer-heading">
                    <?= htmlspecialchars(footerText('footer_ecommerce_solutions', 'E-commerce Solutions'), ENT_QUOTES, 'UTF-8') ?>
                </h2>

                <ul class="footer-links">
                    <li><a href="services.php"><?= htmlspecialchars(footerText('footer_marketplace_management', 'Marketplace Management'), ENT_QUOTES, 'UTF-8') ?></a></li>
                    <li><a href="services.php"><?= htmlspecialchars(footerText('footer_amazon_support', 'Amazon Seller Support'), ENT_QUOTES, 'UTF-8') ?></a></li>
                    <li><a href="services.php"><?= htmlspecialchars(footerText('footer_flipkart_support', 'Flipkart Seller Support'), ENT_QUOTES, 'UTF-8') ?></a></li>
                    <li><a href="services.php"><?= htmlspecialchars(footerText('footer_meesho_support', 'Meesho Seller Support'), ENT_QUOTES, 'UTF-8') ?></a></li>
                    <li><a href="services.php"><?= htmlspecialchars(footerText('footer_product_listing', 'Product Listing'), ENT_QUOTES, 'UTF-8') ?></a></li>
                    <li><a href="services.php"><?= htmlspecialchars(footerText('footer_cataloguing', 'Cataloguing Services'), ENT_QUOTES, 'UTF-8') ?></a></li>
                </ul>

            </div>

            <!-- Column 3: Digital Services -->
            <div class="col-6 col-md-6 col-lg-2">

                <h2 class="footer-heading">
                    <?= htmlspecialchars(footerText('footer_digital_services', 'Digital Services'), ENT_QUOTES, 'UTF-8') ?>
                </h2>

                <ul class="footer-links">
                    <li><a href="services.php"><?= htmlspecialchars(footerText('footer_digital_marketing', 'Digital Marketing'), ENT_QUOTES, 'UTF-8') ?></a></li>
                    <li><a href="services.php"><?= htmlspecialchars(footerText('footer_seo_services', 'SEO Services'), ENT_QUOTES, 'UTF-8') ?></a></li>
                    <li><a href="services.php"><?= htmlspecialchars(footerText('footer_website_development', 'Website Development'), ENT_QUOTES, 'UTF-8') ?></a></li>
                    <li><a href="services.php"><?= htmlspecialchars(footerText('footer_business_branding', 'Business Branding'), ENT_QUOTES, 'UTF-8') ?></a></li>
                    <li><a href="pricing.php"><?= htmlspecialchars(footerText('footer_pricing_plans', 'Pricing & Plans'), ENT_QUOTES, 'UTF-8') ?></a></li>
                </ul>

            </div>

            <!-- Column 4: Company -->
            <div class="col-12 col-md-6 col-lg-3">

                <h2 class="footer-heading">
                    <?= htmlspecialchars(footerText('footer_company', 'Company'), ENT_QUOTES, 'UTF-8') ?>
                </h2>

                <ul class="footer-links footer-company-links">
                    <li><a href="index.php"><?= htmlspecialchars(footerText('footer_home', 'Home'), ENT_QUOTES, 'UTF-8') ?></a></li>
                    <li><a href="about.php"><?= htmlspecialchars(footerText('footer_about_us', 'About Us'), ENT_QUOTES, 'UTF-8') ?></a></li>
                    <li><a href="services.php"><?= htmlspecialchars(footerText('footer_our_services', 'Our Services'), ENT_QUOTES, 'UTF-8') ?></a></li>
                    <li><a href="contact.php"><?= htmlspecialchars(footerText('footer_contact_us', 'Contact Us'), ENT_QUOTES, 'UTF-8') ?></a></li>
                </ul>

                <!-- Customer Support + Social Icons -->
                <div class="footer-support-social">

                    <!-- Customer Support -->
                    <div class="footer-support">

                        <h2 class="footer-heading">
                            <?= htmlspecialchars(footerText('footer_customer_support', 'Customer Support'), ENT_QUOTES, 'UTF-8') ?>
                        </h2>

                        <ul class="footer-links">
                            <li><a href="contact.php"><?= htmlspecialchars(footerText('footer_get_help', 'Get Help'), ENT_QUOTES, 'UTF-8') ?></a></li>
                            <li><a href="contact.php"><?= htmlspecialchars(footerText('footer_business_enquiries', 'Business Enquiries'), ENT_QUOTES, 'UTF-8') ?></a></li>
                        </ul>

                    </div>

                    <!-- Social Media -->
                    <div class="footer-social">

                        <h2 class="footer-heading">
                            <?= htmlspecialchars(footerText('footer_follow_us', 'Follow Us'), ENT_QUOTES, 'UTF-8') ?>
                        </h2>

                        <div class="footer-social-icons">

                            <a href="https://www.facebook.com/YOUR_PAGE"
                               target="_blank"
                               rel="noopener noreferrer"
                               aria-label="Facebook">
                                <i class="bi bi-facebook" aria-hidden="true"></i>
                            </a>

                            <a href="https://www.instagram.com/YOUR_PAGE"
                               target="_blank"
                               rel="noopener noreferrer"
                               aria-label="Instagram">
                                <i class="bi bi-instagram" aria-hidden="true"></i>
                            </a>

                            <a href="https://www.linkedin.com/company/YOUR_PAGE"
                               target="_blank"
                               rel="noopener noreferrer"
                               aria-label="LinkedIn">
                                <i class="bi bi-linkedin" aria-hidden="true"></i>
                            </a>

                            <a href="https://www.youtube.com/@YOUR_CHANNEL"
                               target="_blank"
                               rel="noopener noreferrer"
                               aria-label="YouTube">
                                <i class="bi bi-youtube" aria-hidden="true"></i>
                            </a>

                            <a href="https://wa.me/YOUR_PHONE_NUMBER"
                               target="_blank"
                               rel="noopener noreferrer"
                               aria-label="WhatsApp">
                                <i class="bi bi-whatsapp" aria-hidden="true"></i>
                            </a>

                        </div>
                    </div>

                </div>

            </div>

        </div>

        <!-- Bottom Bar -->
        <div class="footer-bottom">

            <div class="row align-items-center g-2">

                <div class="col-12 col-lg-6 text-center text-lg-start">
                    <p class="footer-copyright">
                        &copy; <?= date('Y') ?>
                        Tabish Enterprises.
                        <?= htmlspecialchars(
                            footerText('footer_all_rights_reserved', 'All rights reserved.'),
                            ENT_QUOTES,
                            'UTF-8'
                        ) ?>
                    </p>
                </div>

                <div class="col-12 col-lg-6 text-center text-lg-end">
                    <p class="footer-tagline">
                        <?= htmlspecialchars(
                            footerText('footer_tagline', 'Empowering businesses in the digital marketplace.'),
                            ENT_QUOTES,
                            'UTF-8'
                        ) ?>
                    </p>
                </div>

            </div>

        </div>

    </div>

</footer>

<!-- RTL styles scoped to this footer only -->
<style>
/* Arabic footer direction */
.ecommerce-footer[dir="rtl"] {
    direction: rtl;
    text-align: right;
}

.ecommerce-footer[dir="rtl"] .footer-description,
.ecommerce-footer[dir="rtl"] .footer-heading,
.ecommerce-footer[dir="rtl"] .footer-links,
.ecommerce-footer[dir="rtl"] .footer-copyright,
.ecommerce-footer[dir="rtl"] .footer-tagline {
    text-align: right;
}

/* Keep lists aligned without changing their existing layout */
.ecommerce-footer[dir="rtl"] .footer-links {
    padding-right: 0;
    padding-left: 0;
}

/* Keep brand image dimensions and appearance unchanged */
.ecommerce-footer[dir="rtl"] .footer-brand {
    direction: rtl;
}

/* Align contact button content in Arabic */
.ecommerce-footer[dir="rtl"] .footer-contact-btn {
    direction: rtl;
}

/* Place the language dropdown on the right */
.ecommerce-footer[dir="rtl"] .footer-language {
    direction: rtl;
    text-align: right;
}

.ecommerce-footer[dir="rtl"] .footer-language-menu {
    right: 0;
    left: auto;
    text-align: right;
}

/* Reverse dropdown caret spacing */
.ecommerce-footer[dir="rtl"] .footer-language-btn.dropdown-toggle::after {
    margin-right: 0.5em;
    margin-left: 0;
}

/* Keep social icons in a right-to-left row */
.ecommerce-footer[dir="rtl"] .footer-social-icons {
    direction: rtl;
}

/* Bottom bar: retain the existing responsive Bootstrap layout */
.ecommerce-footer[dir="rtl"] .footer-bottom {
    direction: rtl;
}

.ecommerce-footer[dir="rtl"] .footer-bottom .text-lg-start,
.ecommerce-footer[dir="rtl"] .footer-bottom .text-lg-end {
    text-align: center !important;
}

@media (min-width: 992px) {
    .ecommerce-footer[dir="rtl"] .footer-bottom .text-lg-start {
        text-align: right !important;
    }

    .ecommerce-footer[dir="rtl"] .footer-bottom .text-lg-end {
        text-align: left !important;
    }
}

/* Prevent long Arabic text from overflowing on small screens */
.ecommerce-footer[dir="rtl"] a,
.ecommerce-footer[dir="rtl"] .footer-description,
.ecommerce-footer[dir="rtl"] .footer-tagline {
    overflow-wrap: anywhere;
}
</style>

<!-- Include Bootstrap JS only once on the page -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/main.js"></script>

</body>
</html>
