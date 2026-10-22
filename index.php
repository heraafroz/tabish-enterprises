
<?php
require_once __DIR__ . '/includes/language.php';
require_once __DIR__ . '/config/database.php';

$pageTitle = t(
    'home_page_title',
    'Tabish Enterprises | Your E-commerce Growth Partner'
);

$stmt = $pdo->query("
    SELECT id, name, short_description, icon
    FROM services
    WHERE is_active = 1
    ORDER BY sort_order, id
    LIMIT 6
");

$services = $stmt->fetchAll(PDO::FETCH_ASSOC);

require __DIR__ . '/includes/header.php';

function homeText($key, $default)
{
    return htmlspecialchars(
        t($key, $default),
        ENT_QUOTES,
        'UTF-8'
    );
}
?>

<main class="home-page">

    <!-- HERO SECTION -->
    <section class="home-hero">
        <div class="hero-glow hero-glow-one"></div>
        <div class="hero-glow hero-glow-two"></div>

        <div class="container position-relative">
            <div class="row align-items-center gy-5">

                <div class="col-lg-7">
                    <div class="hero-content">

                        <div class="hero-badge">
                            <i class="bi bi-stars"></i>
                            <?= homeText('hero_eyebrow', 'YOUR E-COMMERCE GROWTH PARTNER') ?>
                        </div>

                        <h1 class="hero-heading mt-4">
                            <?= homeText('hero_title_line1', 'Grow Your Business') ?>
                            <br>
                            <?= homeText('hero_title_line2', 'Across Every') ?>
                            <span class="hero-highlight">
                                <?= homeText('hero_title_highlight', 'Marketplace') ?>
                            </span>
                        </h1>

                        <p class="hero-description mt-4">
                            <?= homeText(
                                'hero_description',
                                'Practical support for online sellers and growing businesses — from marketplace operations and product listings to digital marketing and website development.'
                            ) ?>
                        </p>

                        <div class="hero-actions d-flex flex-wrap gap-3 mt-4">
                            <a href="services.php" class="btn btn-home-primary">
                                <?= homeText('explore_services', 'Explore Services') ?>
                                <i class="bi bi-arrow-up-right ms-2"></i>
                            </a>

                            <a href="contact.php" class="btn btn-home-secondary">
                                <i class="bi bi-chat-dots me-2"></i>
                                <?= homeText('talk_to_expert', 'Talk to an Expert') ?>
                            </a>
                        </div>

                        <div class="hero-trust mt-4">
                            <div>
                                <i class="bi bi-check-circle-fill"></i>
                                <?= homeText('benefit_business', 'Business-focused solutions') ?>
                            </div>

                            <div>
                                <i class="bi bi-check-circle-fill"></i>
                                <?= homeText('benefit_communication', 'Clear communication') ?>
                            </div>

                            <div>
                                <i class="bi bi-check-circle-fill"></i>
                                <?= homeText('benefit_support', 'Tailored support') ?>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- VISUAL PANEL -->
                <div class="col-lg-5">
                    <div class="hero-art">

                        <div class="floating-label floating-label-top">
                            <span class="floating-icon">
                                <i class="bi bi-shop"></i>
                            </span>

                            <span>
                                <strong>
                                    <?= homeText('visual_marketplace_title', 'Marketplace') ?>
                                </strong>
                                <small>
                                    <?= homeText('visual_marketplace_subtitle', 'Business support') ?>
                                </small>
                            </span>
                        </div>

                        <div class="growth-panel">
                            <div class="growth-panel-header">
                                <div>
                                    <span class="panel-overline">
                                        <?= homeText('visual_eyebrow', 'BUILT FOR ONLINE GROWTH') ?>
                                    </span>

                                    <h2>
                                        <?= homeText('visual_title', 'Your business, moving forward.') ?>
                                    </h2>
                                </div>

                                <div class="panel-main-icon">
                                    <i class="bi bi-bar-chart-line"></i>
                                </div>
                            </div>

                            <div class="growth-line-art">
                                <div class="chart-label">
                                    <i class="bi bi-graph-up-arrow"></i>
                                    <?= homeText('visual_tagline', 'Plan better. Build stronger. Grow online.') ?>
                                </div>

                                <svg viewBox="0 0 420 155"
                                     class="growth-chart"
                                     role="img"
                                     aria-label="<?= homeText('growth_chart_aria', 'Illustrative business growth chart') ?>">
                                    <defs>
                                        <linearGradient id="growthFill"
                                            x1="0" y1="0" x2="0" y2="1">
                                            <stop offset="0%" stop-color="#13b89a"
                                                  stop-opacity=".28"/>
                                            <stop offset="100%" stop-color="#13b89a"
                                                  stop-opacity="0"/>
                                        </linearGradient>
                                    </defs>

                                    <path d="M0 125 L60 105 L115 113 L175 70 L230 86 L290 45 L345 54 L420 12 L420 155 L0 155 Z"
                                          fill="url(#growthFill)"/>

                                    <path d="M0 125 L60 105 L115 113 L175 70 L230 86 L290 45 L345 54 L420 12"
                                          fill="none"
                                          stroke="#13b89a"
                                          stroke-width="4"
                                          stroke-linecap="round"
                                          stroke-linejoin="round"/>

                                    <circle cx="420" cy="12" r="6" fill="#13b89a"/>
                                </svg>
                            </div>

                            <div class="growth-services">

                                <div class="growth-service">
                                    <span class="growth-service-icon">
                                        <i class="bi bi-shop-window"></i>
                                    </span>

                                    <span>
                                        <strong>
                                            <?= homeText('visual_marketplace', 'Marketplace account support') ?>
                                        </strong>

                                        <small>
                                            <?= homeText('visual_marketplace_small', 'Marketplace operations') ?>
                                        </small>
                                    </span>

                                    <i class="bi bi-arrow-up-right ms-auto"></i>
                                </div>

                                <div class="growth-service">
                                    <span class="growth-service-icon">
                                        <i class="bi bi-grid-1x2"></i>
                                    </span>

                                    <span>
                                        <strong>
                                            <?= homeText('visual_listing', 'Product listing & cataloguing') ?>
                                        </strong>

                                        <small>
                                            <?= homeText('visual_listing_small', 'Product presentation') ?>
                                        </small>
                                    </span>

                                    <i class="bi bi-arrow-up-right ms-auto"></i>
                                </div>

                                <div class="growth-service">
                                    <span class="growth-service-icon">
                                        <i class="bi bi-window"></i>
                                    </span>

                                    <span>
                                        <strong>
                                            <?= homeText('visual_marketing', 'Marketing & website solutions') ?>
                                        </strong>

                                        <small>
                                            <?= homeText('visual_marketing_small', 'Digital presence') ?>
                                        </small>
                                    </span>

                                    <i class="bi bi-arrow-up-right ms-auto"></i>
                                </div>

                            </div>
                        </div>

                        <div class="floating-label floating-label-bottom">
                            <i class="bi bi-lightning-charge-fill"></i>
                            <?= homeText('visual_bottom_label', 'Digital solutions for your business') ?>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </section>


    <!-- ==========================================
         VALUE STRIP
    ========================================== -->

    <section class="value-strip">
        <div class="container">
            <div class="row g-3">

                <!-- Marketplace -->
                <div class="col-6 col-lg-3">
                    <div class="value-item">
                        <span class="value-icon">
                            <i class="bi bi-shop-window" aria-hidden="true"></i>
                        </span>

                        <div>
                            <strong>
                                <?= homeText('value_marketplace', 'Marketplace') ?>
                            </strong>

                            <small>
                                <?= homeText('value_marketplace_desc', 'Business support') ?>
                            </small>
                        </div>
                    </div>
                </div>

                <!-- Product Listings -->
                <div class="col-6 col-lg-3">
                    <div class="value-item">
                        <span class="value-icon">
                            <i class="bi bi-box-seam" aria-hidden="true"></i>
                        </span>

                        <div>
                            <strong>
                                <?= homeText('value_product_listings', 'Product Listings') ?>
                            </strong>

                            <small>
                                <?= homeText('value_product_listings_desc', 'Cataloguing support') ?>
                            </small>
                        </div>
                    </div>
                </div>

                <!-- Digital Marketing -->
                <div class="col-6 col-lg-3">
                    <div class="value-item">
                        <span class="value-icon">
                            <i class="bi bi-megaphone" aria-hidden="true"></i>
                        </span>

                        <div>
                            <strong>
                                <?= homeText('value_digital_marketing', 'Digital Marketing') ?>
                            </strong>

                            <small>
                                <?= homeText('value_digital_marketing_desc', 'Online visibility') ?>
                            </small>
                        </div>
                    </div>
                </div>

                <!-- Web Development -->
                <div class="col-6 col-lg-3">
                    <div class="value-item">
                        <span class="value-icon">
                            <i class="bi bi-code-slash" aria-hidden="true"></i>
                        </span>

                        <div>
                            <strong>
                                <?= homeText('value_web_development', 'Web Development') ?>
                            </strong>

                            <small>
                                <?= homeText('value_web_development_desc', 'Digital solutions') ?>
                            </small>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>


    <!-- ==========================================
         SERVICES SECTION
    ========================================== -->

    <section class="home-services section-space">
        <div class="container">

            <!-- Section Heading -->
            <div class="section-top">
                <div>
                    <div class="section-eyebrow">
                        <span aria-hidden="true"></span>
                        <?= homeText('services_eyebrow', 'OUR SERVICES') ?>
                    </div>

                    <h2 class="section-title">
                        <?= homeText(
                            'services_heading',
                            'Everything You Need to Succeed Online'
                        ) ?>
                    </h2>

                    <p class="section-description">
                        <?= homeText(
                            'services_description',
                            'Flexible digital and marketplace services designed around your business needs.'
                        ) ?>
                    </p>
                </div>

                <a href="services.php" class="section-view-link">
                    <?= homeText('explore_services', 'Explore Services') ?>
                    <i class="bi bi-arrow-up-right" aria-hidden="true"></i>
                </a>
            </div>

            <!-- Services Cards -->
            <div class="row g-4 mt-2">

                <?php if (!empty($services)): ?>

                    <?php foreach ($services as $index => $service): ?>

                        <?php
                        $serviceId = (int) ($service['id'] ?? 0);

                        $serviceName = t(
                            'service_' . $serviceId . '_name',
                            $service['name'] ?? ''
                        );

                        $serviceDescription = t(
                            'service_' . $serviceId . '_description',
                            $service['short_description'] ?? ''
                        );

                        $serviceIcon = trim(
                            (string) ($service['icon'] ?? '')
                        );

                        $isBootstrapIcon = preg_match(
                            '/^bi(?:\s+bi-[a-z0-9-]+)+$/',
                            $serviceIcon
                        ) === 1;
                        ?>

                        <div class="col-md-6 col-lg-4">
                            <article class="home-service-card">

                                <!-- Card Top -->
                                <div class="service-card-top">
                                    <div class="service-card-icon">

                                        <?php if ($isBootstrapIcon): ?>

                                            <i
                                                class="<?= htmlspecialchars(
                                                    $serviceIcon,
                                                    ENT_QUOTES,
                                                    'UTF-8'
                                                ) ?>"
                                                aria-hidden="true"
                                            ></i>

                                        <?php elseif ($serviceIcon !== ''): ?>

                                            <?= htmlspecialchars(
                                                $serviceIcon,
                                                ENT_QUOTES,
                                                'UTF-8'
                                            ) ?>

                                        <?php else: ?>

                                            <i class="bi bi-stars" aria-hidden="true"></i>

                                        <?php endif; ?>

                                    </div>

                                    <span class="service-number">
                                        <?= str_pad(
                                            (string) ($index + 1),
                                            2,
                                            '0',
                                            STR_PAD_LEFT
                                        ) ?>
                                    </span>
                                </div>

                                <!-- Service Name -->
                                <h3>
                                    <?= htmlspecialchars(
                                        (string) $serviceName,
                                        ENT_QUOTES,
                                        'UTF-8'
                                    ) ?>
                                </h3>

                                <!-- Service Description -->
                                <p>
                                    <?= htmlspecialchars(
                                        (string) $serviceDescription,
                                        ENT_QUOTES,
                                        'UTF-8'
                                    ) ?>
                                </p>

                                <!-- Service Details Link -->
                                <a
                                    href="service-details.php?id=<?= $serviceId ?>"
                                    class="service-card-link"
                                >
                                    <?= homeText('explore_service', 'Explore service') ?>
                                    <i class="bi bi-arrow-up-right" aria-hidden="true"></i>
                                </a>

                            </article>
                        </div>

                    <?php endforeach; ?>

                <?php else: ?>

                    <!-- No Services Available -->
                    <div class="col-12">
                        <div class="empty-services">

                            <i class="bi bi-grid-1x2" aria-hidden="true"></i>

                            <h3>
                                <?= homeText(
                                    'no_services',
                                    'Our services are being updated. Please contact us for assistance.'
                                ) ?>
                            </h3>

                            <a href="contact.php" class="btn btn-home-primary">
                                <?= homeText('talk_to_expert', 'Talk to an Expert') ?>
                            </a>

                        </div>
                    </div>

                <?php endif; ?>

            </div>
        </div>
    </section>


    <!-- ==========================================
         MARKETPLACE SHOWCASE
    ========================================== -->

    <section class="home-marketplaces">
        <div class="container">
            <div class="marketplace-box">

                <!-- Section Heading -->
                <div class="text-center marketplace-heading">

                    <div class="section-eyebrow justify-content-center">
                        <span></span>
                        <?= homeText('market_eyebrow', 'MARKETPLACES WE SUPPORT') ?>
                        <span></span>
                    </div>

                    <h2>
                        <?= homeText(
                            'market_heading',
                            'Solutions for Growing Businesses'
                        ) ?>
                    </h2>

                    <p>
                        <?= homeText(
                            'market_description',
                            'Support for selling and managing products across popular online channels.'
                        ) ?>
                    </p>

                </div>

                <!-- Marketplace Cards -->
                <div class="row g-3 mt-4">

                    <!-- Amazon -->
                    <div class="col-6 col-lg-3">
                        <div class="market-brand">
                            <span class="market-brand-icon amazon-icon">
                                <i class="bi bi-box-seam" aria-hidden="true"></i>
                            </span>
                            <span>Amazon</span>
                        </div>
                    </div>

                    <!-- Flipkart -->
                    <div class="col-6 col-lg-3">
                        <div class="market-brand">
                            <span class="market-brand-icon flipkart-icon">
                                <i class="bi bi-bag-fill" aria-hidden="true"></i>
                            </span>
                            <span>Flipkart</span>
                        </div>
                    </div>

                    <!-- Meesho -->
                    <div class="col-6 col-lg-3">
                        <div class="market-brand">
                            <span class="market-brand-icon meesho-icon">
                                <i class="bi bi-basket2-fill" aria-hidden="true"></i>
                            </span>
                            <span>Meesho</span>
                        </div>
                    </div>

                    <!-- Shopify -->
                    <div class="col-6 col-lg-3">
                        <div class="market-brand">
                            <span class="market-brand-icon shopify-icon">
                                <i class="bi bi-cart3" aria-hidden="true"></i>
                            </span>
                            <span>Shopify</span>
                        </div>
                    </div>

                </div>

                <!-- Disclaimer -->
                <p class="market-disclaimer">
                    <?= homeText(
                        'market_disclaimer',
                        'Services are subject to platform eligibility and applicable marketplace policies. No sales or approval guarantees.'
                    ) ?>
                </p>

            </div>
        </div>
    </section>


    <!-- ==========================================
         E-COMMERCE LISTING & ONLINE BUSINESS SERVICES
    ========================================== -->

    <section class="home-ecommerce section-space">
        <div class="container">

            <!-- Section Heading -->
            <div class="ecommerce-heading text-center">
                <div class="section-eyebrow justify-content-center">
                    <span></span>
                    <?= homeText('ecom_eyebrow', 'E-COMMERCE SOLUTIONS') ?>
                    <span></span>
                </div>

                <h2 class="section-title">
                    <?= homeText(
                        'ecom_heading',
                        'E-commerce Listing, Cataloging & Marketplace Services'
                    ) ?>
                </h2>

                <p class="section-description mx-auto">
                    <?= homeText(
                        'ecom_description',
                        'Build a stronger online presence with product listing, catalog management and digital services for your business.'
                    ) ?>
                </p>
            </div>

            <!-- Marketplace Platforms -->

            <?php
            $platforms = [
                ['name' => 'Amazon', 'slug' => 'amazon', 'color' => '#232F3E'],
                ['name' => 'Flipkart', 'slug' => 'flipkart', 'color' => '#2874F0'],
                ['name' => 'Meesho', 'slug' => 'meesho', 'color' => '#570D75'],
                ['name' => 'Shopify', 'slug' => 'shopify', 'color' => '#7AB55C'],
                ['name' => 'Etsy', 'slug' => 'etsy', 'color' => '#F1641E'],
                ['name' => 'Alibaba.com', 'slug' => 'alibabadotcom', 'color' => '#FF6A00'],
                ['name' => 'eBay', 'slug' => 'ebay', 'color' => '#E53238'],
                ['name' => 'IndiaMART', 'slug' => 'indiamart', 'color' => '#2B5CAB']
            ];
            ?>

            <div class="ecommerce-platforms mt-5">
                <h3 class="ecommerce-subheading">
                    <?= homeText('ecom_platform_heading', 'Marketplace Platforms') ?>
                </h3>

                <div class="marketplace-slider">
                    <div class="marketplace-track">

                        <?php for ($copy = 0; $copy < 2; $copy++): ?>
                            <?php foreach ($platforms as $platform): ?>

                                <div class="marketplace-slide"
                                     <?= $copy === 1 ? 'aria-hidden="true"' : '' ?>>

                                    <div class="ecommerce-platform-card">
                                        <div class="brand-logo-box">
                                            <img
                                                src="https://cdn.simpleicons.org/<?= htmlspecialchars($platform['slug'], ENT_QUOTES, 'UTF-8') ?>"
                                                alt="<?= htmlspecialchars($platform['name'], ENT_QUOTES, 'UTF-8') ?> logo"
                                                loading="lazy"
                                                onerror="this.style.display='none';this.nextElementSibling.style.display='flex';"
                                            >

                                            <span class="brand-logo-fallback"
                                                  style="display:none; color:<?= htmlspecialchars($platform['color'], ENT_QUOTES, 'UTF-8') ?>">
                                                <?= htmlspecialchars(
                                                    strtoupper(substr($platform['name'], 0, 1)),
                                                    ENT_QUOTES,
                                                    'UTF-8'
                                                ) ?>
                                            </span>
                                        </div>

                                        <span class="marketplace-name">
                                            <?= htmlspecialchars($platform['name'], ENT_QUOTES, 'UTF-8') ?>
                                        </span>
                                    </div>
                                </div>

                            <?php endforeach; ?>
                        <?php endfor; ?>

                    </div>
                </div>
            </div>


            <!-- Online Business Services -->
            <div class="ecommerce-services mt-5">

                <h3 class="ecommerce-subheading">
                    <?= homeText(
                        'ecom_services_heading',
                        'Online Services for Your Business'
                    ) ?>
                </h3>

                <div class="row g-4 mt-2">

                    <!-- Service 1 -->
                    <div class="col-md-6 col-lg-4">
                        <article class="ecommerce-service-card">
                            <div class="ecommerce-service-icon">
                                <i class="bi bi-card-list" aria-hidden="true"></i>
                            </div>

                            <h4>
                                <?= homeText('ecom_service_listing', 'Product Listing & Cataloging') ?>
                            </h4>

                            <p>
                                <?= homeText(
                                    'ecom_service_listing_desc',
                                    'Product titles, descriptions, attributes, variations and catalog uploads.'
                                ) ?>
                            </p>
                        </article>
                    </div>

                    <!-- Service 2 -->
                    <div class="col-md-6 col-lg-4">
                        <article class="ecommerce-service-card">
                            <div class="ecommerce-service-icon">
                                <i class="bi bi-images" aria-hidden="true"></i>
                            </div>

                            <h4>
                                <?= homeText('ecom_service_images', 'Product Images & Content') ?>
                            </h4>

                            <p>
                                <?= homeText(
                                    'ecom_service_images_desc',
                                    'Product image optimization, banners, infographics and enhanced content.'
                                ) ?>
                            </p>
                        </article>
                    </div>

                    <!-- Service 3 -->
                    <div class="col-md-6 col-lg-4">
                        <article class="ecommerce-service-card">
                            <div class="ecommerce-service-icon">
                                <i class="bi bi-search" aria-hidden="true"></i>
                            </div>

                            <h4>
                                <?= homeText('ecom_service_seo', 'Marketplace SEO') ?>
                            </h4>

                            <p>
                                <?= homeText(
                                    'ecom_service_seo_desc',
                                    'Keyword research and listing improvements to help customers discover products.'
                                ) ?>
                            </p>
                        </article>
                    </div>

                    <!-- Service 4 -->
                    <div class="col-md-6 col-lg-4">
                        <article class="ecommerce-service-card">
                            <div class="ecommerce-service-icon">
                                <i class="bi bi-person-workspace" aria-hidden="true"></i>
                            </div>

                            <h4>
                                <?= homeText('ecom_service_account', 'Seller Account Support') ?>
                            </h4>

                            <p>
                                <?= homeText(
                                    'ecom_service_account_desc',
                                    'Assistance with seller account setup, listing updates and routine account tasks.'
                                ) ?>
                            </p>
                        </article>
                    </div>

                    <!-- Service 5 -->
                    <div class="col-md-6 col-lg-4">
                        <article class="ecommerce-service-card">
                            <div class="ecommerce-service-icon">
                                <i class="bi bi-boxes" aria-hidden="true"></i>
                            </div>

                            <h4>
                                <?= homeText('ecom_service_inventory', 'Inventory & Order Support') ?>
                            </h4>

                            <p>
                                <?= homeText(
                                    'ecom_service_inventory_desc',
                                    'Support with stock updates, product information and order tracking workflows.'
                                ) ?>
                            </p>
                        </article>
                    </div>

                    <!-- Service 6 -->
                    <div class="col-md-6 col-lg-4">
                        <article class="ecommerce-service-card">
                            <div class="ecommerce-service-icon">
                                <i class="bi bi-laptop" aria-hidden="true"></i>
                            </div>

                            <h4>
                                <?= homeText('ecom_service_website', 'E-commerce Website Development') ?>
                            </h4>

                            <p>
                                <?= homeText(
                                    'ecom_service_website_desc',
                                    'Online store development, product uploads, website customization and maintenance.'
                                ) ?>
                            </p>
                        </article>
                    </div>

                </div>
            </div>

            <!-- Section CTA -->
            <div class="ecommerce-bottom-cta mt-5">
                <div>
                    <h3>
                        <?= homeText(
                            'ecom_cta_heading',
                            'Need help growing your online business?'
                        ) ?>
                    </h3>

                    <p>
                        <?= homeText(
                            'ecom_cta_description',
                            'Tell us about your business and the services you need.'
                        ) ?>
                    </p>
                </div>

                <a href="contact.php" class="btn btn-home-primary">
                    <?= homeText('ecom_cta_button', 'Discuss Your Project') ?>
                    <i class="bi bi-arrow-up-right ms-2" aria-hidden="true"></i>
                </a>
            </div>

            <p class="ecommerce-disclaimer mt-3">
                <?= homeText(
                    'ecom_disclaimer',
                    'Services depend on platform eligibility, account access and applicable marketplace policies. Platform names are used for identification; no affiliation or guaranteed results are implied.'
                ) ?>
            </p>

        </div>
    </section>


    <!-- ==========================================
         WHY CHOOSE US SECTION
    ========================================== -->

    <section class="why-choose-section py-5">
        <div class="container">

            <div class="text-center mb-5">
                <span class="why-label">
                    <?= homeText('why_label', 'WHY TABISH ENTERPRISES') ?>
                </span>

                <h2 class="why-title">
                    <?= homeText('why_title', 'Why Choose Us?') ?>
                </h2>

                <p class="why-description">
                    <?= homeText(
                        'why_description',
                        'We help businesses grow with reliable services, professional support, and solutions designed for success.'
                    ) ?>
                </p>
            </div>

            <div class="row g-4">

                <!-- Card 1 -->
                <div class="col-md-6 col-lg-4">
                    <div class="why-card">
                        <div class="why-icon">
                            <i class="bi bi-patch-check"></i>
                        </div>

                        <h5>
                            <?= homeText('why_reliable_title', 'Reliable & Professional Service') ?>
                        </h5>

                        <p>
                            <?= homeText(
                                'why_reliable_desc',
                                'We focus on quality work, clear communication, and dependable support for your business needs.'
                            ) ?>
                        </p>
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="col-md-6 col-lg-4">
                    <div class="why-card">
                        <div class="why-icon">
                            <i class="bi bi-cart-check"></i>
                        </div>

                        <h5>
                            <?= homeText('why_marketplace_title', 'Marketplace Expertise') ?>
                        </h5>

                        <p>
                            <?= homeText(
                                'why_marketplace_desc',
                                'Get support for product listings, catalog management, and online marketplace operations.'
                            ) ?>
                        </p>
                    </div>
                </div>

                <!-- Card 3 -->
                <div class="col-md-6 col-lg-4">
                    <div class="why-card">
                        <div class="why-icon">
                            <i class="bi bi-laptop"></i>
                        </div>

                        <h5>
                            <?= homeText('why_custom_title', 'Customized Solutions') ?>
                        </h5>

                        <p>
                            <?= homeText(
                                'why_custom_desc',
                                'Our services are tailored to your business goals, requirements, and online growth plans.'
                            ) ?>
                        </p>
                    </div>
                </div>

                <!-- Card 4 -->
                <div class="col-md-6 col-lg-4">
                    <div class="why-card">
                        <div class="why-icon">
                            <i class="bi bi-people"></i>
                        </div>

                        <h5>
                            <?= homeText('why_customer_title', 'Customer-Focused Approach') ?>
                        </h5>

                        <p>
                            <?= homeText(
                                'why_customer_desc',
                                'We value your requirements and aim to build long-term professional relationships.'
                            ) ?>
                        </p>
                    </div>
                </div>

                <!-- Card 5 -->
                <div class="col-md-6 col-lg-4">
                    <div class="why-card">
                        <div class="why-icon">
                            <i class="bi bi-lightning-charge"></i>
                        </div>

                        <h5>
                            <?= homeText('why_efficient_title', 'Efficient Work Process') ?>
                        </h5>

                        <p>
                            <?= homeText(
                                'why_efficient_desc',
                                'We aim to simplify everyday business tasks through organized workflows and practical solutions.'
                            ) ?>
                        </p>
                    </div>
                </div>

                <!-- Card 6 -->
                <div class="col-md-6 col-lg-4">
                    <div class="why-card">
                        <div class="why-icon">
                            <i class="bi bi-graph-up-arrow"></i>
                        </div>

                        <h5>
                            <?= homeText('why_growth_title', 'Growth-Oriented Support') ?>
                        </h5>

                        <p>
                            <?= homeText(
                                'why_growth_desc',
                                'We help you strengthen your online presence and work toward your business growth objectives.'
                            ) ?>
                        </p>
                    </div>
                </div>

            </div>

            <div class="why-bottom-cta text-center mt-5">
                <h4>
                    <?= homeText('why_cta_title', 'Ready to Grow Your Business?') ?>
                </h4>

                <p>
                    <?= homeText(
                        'why_cta_desc',
                        "Let's find the right solutions for your business."
                    ) ?>
                </p>

                <a href="contact.php" class="btn why-cta-btn">
                    <?= homeText('contact_us', 'Contact Us') ?>
                    <i class="bi bi-arrow-right"></i>
                </a>
            </div>

        </div>
    </section>


    <!-- ==========================================
         CALL TO ACTION (CTA)
    ========================================== -->

    <section class="home-cta-section">
        <div class="container">

            <div class="home-cta">

                <!-- Decorative Elements -->
                <div class="cta-decoration cta-decoration-one"></div>
                <div class="cta-decoration cta-decoration-two"></div>

                <div class="row align-items-center gy-4 position-relative">

                    <!-- CTA Content -->
                    <div class="col-lg-8">

                        <span class="cta-eyebrow">
                            <i class="bi bi-stars" aria-hidden="true"></i>

                            <?= homeText(
                                'cta_eyebrow',
                                "LET'S BUILD SOMETHING GREAT"
                            ) ?>
                        </span>

                        <h2>
                            <?= homeText(
                                'cta_heading',
                                'Ready to grow your online business?'
                            ) ?>
                        </h2>

                        <p>
                            <?= homeText(
                                'cta_description',
                                "Tell us what you need. We'll get back to you about the next steps."
                            ) ?>
                        </p>

                    </div>

                    <!-- CTA Button -->
                    <div class="col-lg-4 text-lg-end">

                        <a href="contact.php" class="btn btn-cta-light">
                            <?= homeText(
                                'free_consultation',
                                'Get Free Consultation'
                            ) ?>

                            <i
                                class="bi bi-arrow-up-right ms-2"
                                aria-hidden="true"
                            ></i>
                        </a>

                    </div>

                </div>
            </div>
        </div>
    </section>

</main>

<?php require __DIR__ . '/includes/footer.php'; ?>
