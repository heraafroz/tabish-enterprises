
<?php
$pageTitle = 'About Us | Tabish Enterprises';

require __DIR__ . '/includes/header.php';

/*
|--------------------------------------------------------------------------
| Translation Helper
|--------------------------------------------------------------------------
| Uses your existing t() translation function.
| Falls back to English when a translation is unavailable.
*/
if (!function_exists('aboutText')) {
    function aboutText(string $key, string $fallback): string
    {
        if (function_exists('t')) {
            return t($key, $fallback);
        }

        return $fallback;
    }
}

/*
|--------------------------------------------------------------------------
| Current Language
|--------------------------------------------------------------------------
*/
$aboutLang = $currentLang ?? ($_SESSION['lang'] ?? 'en');

if (!is_string($aboutLang) || $aboutLang === '') {
    $aboutLang = 'en';
}

$isArabic = ($aboutLang === 'ar');
?>

<!-- About Page -->
<main
    class="about-page"
    lang="<?= htmlspecialchars($aboutLang, ENT_QUOTES, 'UTF-8') ?>"
    dir="<?= $isArabic ? 'rtl' : 'ltr' ?>"
>

   
<!-- About Hero Section -->
<section class="about-hero page-hero">
    <div class="container">
        <div class="about-hero-content">

            <span class="about-eyebrow">
                <?= htmlspecialchars(aboutText(
                    'about_eyebrow',
                    'ABOUT TABISH ENTERPRISES'
                ), ENT_QUOTES, 'UTF-8') ?>
            </span>

            <h1 class="about-hero-title">
                <?= htmlspecialchars(aboutText(
                    'about_hero_title',
                    'Helping Businesses Build a Stronger Digital Presence'
                ), ENT_QUOTES, 'UTF-8') ?>
            </h1>

            <p class="about-hero-description">
                <?= htmlspecialchars(aboutText(
                    'about_hero_description',
                    'Practical digital solutions and marketplace support for sellers, entrepreneurs and growing brands.'
                ), ENT_QUOTES, 'UTF-8') ?>
            </p>

            <a href="contact.php" class="btn btn-teal about-hero-btn">
                <?= htmlspecialchars(aboutText(
                    'about_cta',
                    'Discuss Your Requirements'
                ), ENT_QUOTES, 'UTF-8') ?>
                <span class="about-btn-arrow" aria-hidden="true">&rarr;</span>
            </a>

        </div>
    </div>
</section>


    <!-- Who We Are -->
    <section class="section-space about-intro">
        <div class="container">
            <div class="row g-4 g-lg-5 align-items-center">

                <!-- Text Content -->
                <div class="col-12 col-lg-7">
                    <div class="about-content">

                        <span class="about-section-label">
                            <?= htmlspecialchars(aboutText(
                                'about_who_we_are',
                                'WHO WE ARE'
                            ), ENT_QUOTES, 'UTF-8') ?>
                        </span>

                        <h2 class="about-section-title">
                            <?= htmlspecialchars(aboutText(
                                'about_main_title',
                                'Your Partner for Online Business Operations'
                            ), ENT_QUOTES, 'UTF-8') ?>
                        </h2>

                        <p class="about-paragraph">
                            <?= htmlspecialchars(aboutText(
                                'about_paragraph_one',
                                'Tabish Enterprises helps businesses navigate online marketplaces and digital channels with greater confidence. Our service areas include marketplace support, product catalogue preparation, digital marketing, search engine optimization (SEO) and website development.'
                            ), ENT_QUOTES, 'UTF-8') ?>
                        </p>

                        <p class="about-paragraph">
                            <?= htmlspecialchars(aboutText(
                                'about_paragraph_two',
                                'We believe in clear communication, tailored solutions and realistic expectations. Every project begins with understanding the client’s goals, business needs and the support required to move forward.'
                            ), ENT_QUOTES, 'UTF-8') ?>
                        </p>

                        <a href="contact.php" class="btn btn-teal about-contact-btn">
                            <?= htmlspecialchars(aboutText(
                                'about_cta',
                                'Discuss Your Requirements'
                            ), ENT_QUOTES, 'UTF-8') ?>
                            <span aria-hidden="true">&rarr;</span>
                        </a>

                    </div>
                </div>


                <!-- Approach and Focus -->
                <div class="col-12 col-lg-5">
                    <div class="service-card about-info-card h-100">

                        <div class="service-icon" aria-hidden="true">
                            <span>✦</span>
                        </div>

                        <h3 class="about-card-title">
                            <?= htmlspecialchars(aboutText(
                                'about_approach_title',
                                'Our Approach'
                            ), ENT_QUOTES, 'UTF-8') ?>
                        </h3>

                        <p class="about-card-text">
                            <?= htmlspecialchars(aboutText(
                                'about_approach_text',
                                'We understand your business, define the project scope, plan the work and communicate progress clearly at every stage.'
                            ), ENT_QUOTES, 'UTF-8') ?>
                        </p>

                        <hr class="about-divider">

                        <h3 class="about-card-title">
                            <?= htmlspecialchars(aboutText(
                                'about_focus_title',
                                'Our Focus'
                            ), ENT_QUOTES, 'UTF-8') ?>
                        </h3>

                        <p class="about-card-text mb-0">
                            <?= htmlspecialchars(aboutText(
                                'about_focus_text',
                                'We focus on practical digital solutions and marketplace assistance designed around each client’s requirements and business goals.'
                            ), ENT_QUOTES, 'UTF-8') ?>
                        </p>

                    </div>
                </div>

            </div>
        </div>
    </section>


    <!-- Our Values -->
    <section class="about-values section-space">
        <div class="container">

            <div class="text-center about-values-heading">
                <span class="about-section-label">
                    <?= htmlspecialchars(aboutText(
                        'about_values_eyebrow',
                        'WHAT MATTERS TO US'
                    ), ENT_QUOTES, 'UTF-8') ?>
                </span>

                <h2 class="about-section-title">
                    <?= htmlspecialchars(aboutText(
                        'about_values_title',
                        'The Principles Behind Our Work'
                    ), ENT_QUOTES, 'UTF-8') ?>
                </h2>

                <p class="about-values-description">
                    <?= htmlspecialchars(aboutText(
                        'about_values_description',
                        'Our work is guided by practical solutions, transparent communication and a focus on your business goals.'
                    ), ENT_QUOTES, 'UTF-8') ?>
                </p>
            </div>

            <div class="row g-4 mt-2">

                <div class="col-12 col-md-4">
                    <div class="about-value-card h-100">
                        <div class="about-value-icon" aria-hidden="true">
                            <span class="bi bi-chat-square-text"></span>
                        </div>

                        <h3>
                            <?= htmlspecialchars(aboutText(
                                'about_value_communication_title',
                                'Clear Communication'
                            ), ENT_QUOTES, 'UTF-8') ?>
                        </h3>

                        <p class="mb-0">
                            <?= htmlspecialchars(aboutText(
                                'about_value_communication_text',
                                'We value clear discussions, realistic expectations and regular project updates.'
                            ), ENT_QUOTES, 'UTF-8') ?>
                        </p>
                    </div>
                </div>

                <div class="col-12 col-md-4">
                    <div class="about-value-card h-100">
                        <div class="about-value-icon" aria-hidden="true">
                            <span class="bi bi-bullseye"></span>
                        </div>

                        <h3>
                            <?= htmlspecialchars(aboutText(
                                'about_value_goals_title',
                                'Goal-Oriented Solutions'
                            ), ENT_QUOTES, 'UTF-8') ?>
                        </h3>

                        <p class="mb-0">
                            <?= htmlspecialchars(aboutText(
                                'about_value_goals_text',
                                'We shape our approach around each client’s needs, priorities and objectives.'
                            ), ENT_QUOTES, 'UTF-8') ?>
                        </p>
                    </div>
                </div>

                <div class="col-12 col-md-4">
                    <div class="about-value-card h-100">
                        <div class="about-value-icon" aria-hidden="true">
                            <span class="bi bi-lightbulb"></span>
                        </div>

                        <h3>
                            <?= htmlspecialchars(aboutText(
                                'about_value_practical_title',
                                'Practical Thinking'
                            ), ENT_QUOTES, 'UTF-8') ?>
                        </h3>

                        <p class="mb-0">
                            <?= htmlspecialchars(aboutText(
                                'about_value_practical_text',
                                'We focus on useful digital support that addresses real business requirements.'
                            ), ENT_QUOTES, 'UTF-8') ?>
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </section>


    <!-- Contact Call to Action -->
    <section class="about-cta-section section-space">
        <div class="container">
            <div class="about-cta-box">

                <div class="about-cta-content">
                    <h2>
                        <?= htmlspecialchars(aboutText(
                            'about_cta_title',
                            'Ready to Discuss Your Business Goals?'
                        ), ENT_QUOTES, 'UTF-8') ?>
                    </h2>

                    <p class="mb-0">
                        <?= htmlspecialchars(aboutText(
                            'about_cta_description',
                            'Let’s discuss your requirements and explore suitable digital solutions for your business.'
                        ), ENT_QUOTES, 'UTF-8') ?>
                    </p>
                </div>

                <div class="about-cta-action">
                    <a href="contact.php" class="btn btn-light about-cta-btn">
                        <?= htmlspecialchars(aboutText(
                            'about_cta_button',
                            'Contact Our Team'
                        ), ENT_QUOTES, 'UTF-8') ?>
                        <span aria-hidden="true">&rarr;</span>
                    </a>
                </div>

            </div>
        </div>
    </section>

</main>


<?php require __DIR__ . '/includes/footer.php'; ?>
