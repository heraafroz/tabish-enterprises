
<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

/* Use the same language system across the website */
require_once __DIR__ . '/language.php';

$pageTitle = $pageTitle ?? 'Tabish Enterprises | Your E-commerce Growth Partner';
$currentPage = basename($_SERVER['PHP_SELF'] ?? 'index.php');

$supportedLanguages = [
    'en' => 'English',
    'ar' => 'العربية',
    'fr' => 'Français',
    'es' => 'Español',
    'de' => 'Deutsch'
];

/* Keep the language selected by language.php */
$lang = $currentLang ?? ($_SESSION['lang'] ?? 'en');

if (!isset($supportedLanguages[$lang])) {
    $lang = 'en';
}

$_SESSION['lang'] = $lang;

/* Compatibility with existing translateText() calls */
if (!function_exists('translateText')) {
    function translateText($key, $fallback = '')
    {
        return t($key, $fallback);
    }
}

$queryParams = $_GET;
unset($queryParams['lang']);

$currentUrlPage = basename($_SERVER['PHP_SELF'] ?? 'index.php');
?>


<!doctype html>
<html lang="<?= htmlspecialchars($lang, ENT_QUOTES, 'UTF-8') ?>"
      dir="<?= $lang === 'ar' ? 'rtl' : 'ltr' ?>">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="description"
          content="Tabish Enterprises provides marketplace management, product listing, digital marketing, SEO and website development services.">

    <meta name="robots" content="index, follow">

    <title><?= htmlspecialchars($pageTitle, ENT_QUOTES, 'UTF-8') ?></title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">

          
<link rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">


    
<link rel="stylesheet" href="assets/css/style.css?v=2">

</head>

<body>

<!-- Topbar Start -->
<div class="topbar">
    <div class="container topbar-inner">

        <!-- Tagline -->
        <span class="topbar-text">
            <?= htmlspecialchars(
                translateText(
                    'topbar_text',
                    'YOUR MARKETPLACE GROWTH PARTNER'
                ),
                ENT_QUOTES,
                'UTF-8'
            ) ?>
        </span>

        <!-- Contact Links + Social Icons -->
        <div class="topbar-right">

            <div class="topbar-contact">
                <a href="contact.php">
                    <?= htmlspecialchars(
                        translateText('business_enquiries', 'Business Enquiries'),
                        ENT_QUOTES,
                        'UTF-8'
                    ) ?>
                </a>

                <span class="topbar-separator">|</span>

                <a href="contact.php">
                    <?= htmlspecialchars(
                        translateText('get_support', 'Get Support'),
                        ENT_QUOTES,
                        'UTF-8'
                    ) ?>
                </a>
            </div>

            <!-- Social Media Icons -->
            <div class="topbar-social">

                <a href="https://www.facebook.com/YOUR_PAGE"
                   target="_blank"
                   rel="noopener noreferrer"
                   aria-label="Facebook">
                    <i class="bi bi-facebook"></i>
                </a>

                <a href="https://www.instagram.com/YOUR_PAGE"
                   target="_blank"
                   rel="noopener noreferrer"
                   aria-label="Instagram">
                    <i class="bi bi-instagram"></i>
                </a>

                <a href="https://www.linkedin.com/company/YOUR_PAGE"
                   target="_blank"
                   rel="noopener noreferrer"
                   aria-label="LinkedIn">
                    <i class="bi bi-linkedin"></i>
                </a>

                <a href="https://wa.me/YOUR_PHONE_NUMBER"
                   target="_blank"
                   rel="noopener noreferrer"
                   aria-label="WhatsApp">
                    <i class="bi bi-whatsapp"></i>
                </a>

            </div>

        </div>
    </div>
</div>
<!-- Topbar End -->




<nav class="navbar navbar-expand-lg navbar-dark main-navbar sticky-top">
    <div class="container">

        <!-- Logo -->
        <a class="navbar-brand brand" href="index.php">
            <img
                src="assets/images/tabish-logo.png"
                alt="Tabish Enterprises"
                class="tabish-logo"
            >
        </a>

        <!-- Mobile Menu Button -->
        <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#mainNav"
            aria-controls="mainNav"
            aria-expanded="false"
            aria-label="Toggle navigation"
        >
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navbar Content -->
        <div class="collapse navbar-collapse" id="mainNav">

            <!-- Navigation Links -->
            <ul class="navbar-nav mx-auto mb-2 mb-lg-0">

                <li class="nav-item">
                    <a class="nav-link <?= $currentPage === 'index.php' ? 'active' : '' ?>"
                       href="index.php">
                        <?= htmlspecialchars(translateText('home', 'Home'), ENT_QUOTES, 'UTF-8') ?>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link <?= $currentPage === 'about.php' ? 'active' : '' ?>"
                       href="about.php">
                        <?= htmlspecialchars(translateText('about', 'About Us'), ENT_QUOTES, 'UTF-8') ?>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link <?= $currentPage === 'services.php' ? 'active' : '' ?>"
                       href="services.php">
                        <?= htmlspecialchars(translateText('services', 'Services'), ENT_QUOTES, 'UTF-8') ?>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link <?= $currentPage === 'pricing.php' ? 'active' : '' ?>"
                       href="pricing.php">
                        <?= htmlspecialchars(translateText('pricing', 'Pricing'), ENT_QUOTES, 'UTF-8') ?>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link <?= $currentPage === 'contact.php' ? 'active' : '' ?>"
                       href="contact.php">
                        <?= htmlspecialchars(translateText('contact', 'Contact'), ENT_QUOTES, 'UTF-8') ?>
                    </a>
                </li>

            </ul>

            <!-- Language Dropdown -->
            <div class="dropdown nav-language me-lg-3 mb-3 mb-lg-0">

                <button
                    class="btn btn-outline-warning dropdown-toggle"
                    type="button"
                    id="languageDropdown"
                    data-bs-toggle="dropdown"
                    aria-expanded="false"
                >
                    <?= htmlspecialchars($supportedLanguages[$lang], ENT_QUOTES, 'UTF-8') ?>
                </button>

                <ul class="dropdown-menu dropdown-menu-end"
                    aria-labelledby="languageDropdown">

                    <?php foreach ($supportedLanguages as $code => $name): ?>
                        <?php
                        $params = $queryParams;
                        $params['lang'] = $code;
                        $languageUrl = $currentUrlPage . '?' . http_build_query($params);
                        ?>

                        <li>
                            <a
                                class="dropdown-item <?= $lang === $code ? 'active' : '' ?>"
                                href="<?= htmlspecialchars($languageUrl, ENT_QUOTES, 'UTF-8') ?>"
                                lang="<?= htmlspecialchars($code, ENT_QUOTES, 'UTF-8') ?>"
                            >
                                <?= htmlspecialchars($name, ENT_QUOTES, 'UTF-8') ?>
                            </a>
                        </li>
                    <?php endforeach; ?>

                </ul>
            </div>

            <!-- Consultation Button -->
            <a class="btn btn-teal nav-cta" href="contact.php">
                <?= htmlspecialchars(translateText('consultation', 'Get Free Consultation'), ENT_QUOTES, 'UTF-8') ?>
            </a>

        </div>
    </div>
</nav>

