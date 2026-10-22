
<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . '/config/database.php';
require_once __DIR__ . '/includes/language.php';

$pageTitle = t('contact_page_title', 'Contact Us | Tabish Enterprises');
$pageDescription = t(
    'contact_page_description',
    'Contact Tabish Enterprises for marketplace management, digital marketing and website development.'
);

if (!function_exists('contactEscape')) {
    function contactEscape($value) {
        return htmlspecialchars(
            (string) $value,
            ENT_QUOTES | ENT_SUBSTITUTE,
            'UTF-8'
        );
    }
}

$services = $pdo->query(
    'SELECT name FROM services WHERE is_active = 1 ORDER BY sort_order, id'
)->fetchAll(PDO::FETCH_COLUMN);

$name = '';
$email = '';
$phone = '';
$message = '';
$selectedService = trim((string)($_GET['service'] ?? ''));
$selectedPackage = trim((string)($_GET['package'] ?? ''));
$errors = [];
$success = false;
$allowedPackages = ['Starter', 'Growth', 'Custom'];

if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim((string)($_POST['name'] ?? ''));
    $email = trim((string)($_POST['email'] ?? ''));
    $phone = trim((string)($_POST['phone'] ?? ''));
    $selectedService = trim((string)($_POST['service'] ?? ''));
    $selectedPackage = trim((string)($_POST['package'] ?? ''));
    $message = trim((string)($_POST['message'] ?? ''));

    $postedToken = $_POST['csrf_token'] ?? '';
    $sessionToken = $_SESSION['csrf_token'] ?? '';

    if (
        !is_string($postedToken) ||
        !is_string($sessionToken) ||
        $sessionToken === '' ||
        !hash_equals($sessionToken, $postedToken)
    ) {
        $errors[] = t(
            'contact_session_error',
            'Your session expired. Please refresh and try again.'
        );
    }

    $length = static function ($value) {
        return function_exists('mb_strlen')
            ? mb_strlen($value, 'UTF-8')
            : strlen($value);
    };

    if ($length($name) < 2 || $length($name) > 120) {
        $errors[] = t('contact_name_error', 'Enter your name (2–120 characters).');
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL) || strlen($email) > 190) {
        $errors[] = t('contact_email_error', 'Enter a valid email address.');
    }

    if (strlen($phone) > 30) {
        $errors[] = t('contact_phone_error', 'Phone number is too long.');
    }

    if (
        $selectedService !== '' &&
        $selectedService !== 'General enquiry' &&
        !in_array($selectedService, $services, true)
    ) {
        $errors[] = t('contact_service_error', 'Please select a valid service.');
    }

    if (
        $selectedPackage !== '' &&
        !in_array($selectedPackage, $allowedPackages, true)
    ) {
        $errors[] = t('contact_package_error', 'Please select a valid package.');
    }

    if ($length($message) < 10 || $length($message) > 3000) {
        $errors[] = t(
            'contact_message_error',
            'Describe your requirements in 10–3000 characters.'
        );
    }

    if (!$errors) {
        $serviceToSave = $selectedService !== ''
            ? $selectedService
            : 'General enquiry';

        $stmt = $pdo->prepare(
            'INSERT INTO enquiries
            (name, email, phone, service, package, message)
            VALUES (?, ?, ?, ?, ?, ?)'
        );

        $stmt->execute([
            $name,
            $email,
            $phone !== '' ? $phone : null,
            $serviceToSave,
            $selectedPackage !== '' ? $selectedPackage : null,
            $message
        ]);

        $success = true;
        $name = $email = $phone = $message = '';
        $selectedService = $selectedPackage = '';
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
}

require __DIR__ . '/includes/header.php';
?>



<main class="contact-page">

    
<section class="services-hero page-hero contact-hero">
    <div class="container">
        <div class="services-hero-content">

            <div class="services-eyebrow">
                <?= contactEscape(t('contact_eyebrow', "LET'S CONNECT")) ?>
            </div>

            <h1 class="services-hero-title">
                <?= contactEscape(t('contact_hero_title', 'Let’s build something')) ?>
                <span class="contact-hero-highlight">
                    <?= contactEscape(t('contact_hero_highlight', 'great together.')) ?>
                </span>
            </h1>

            <p class="services-hero-description">
                <?= contactEscape(t(
                    'contact_hero_description',
                    'Have a project in mind? Tell us about your business goals and let’s explore how we can help you grow.'
                )) ?>
            </p>

            <a href="#contact-form" class="services-hero-btn">
                <?= contactEscape(t('contact_hero_button', 'Get in Touch')) ?>
                <span aria-hidden="true">→</span>
            </a>

        </div>
    </div>
</section>


    <section class="contact-section">
        <div class="container">

            <div class="row g-4 g-xl-5 align-items-start">

                <!-- Left: Contact information and map -->
                <div class="col-lg-5">
                    <div class="contact-kicker">
                        <?= contactEscape(t('contact_kicker', 'GET IN TOUCH')) ?>
                    </div>

                    <h2 class="contact-heading">
                        <?= contactEscape(t('contact_help_title', 'How can we help?')) ?>
                    </h2>

                    <p class="contact-description mb-4">
                        <?= contactEscape(t(
                            'contact_help_description',
                            'From marketplace management to website development, share your requirements with us.'
                        )) ?>
                    </p>

                    <div class="contact-info-card">
                        <div class="contact-icon" aria-hidden="true">✉</div>
                        <div>
                            <h3><?= contactEscape(t('contact_email_label', 'Email us')) ?></h3>
                            <p>
                                <?= contactEscape(t(
                                    'contact_email_info',
                                    'Use the form to send your enquiry. Add your official business email here when ready.'
                                )) ?>
                            </p>
                        </div>
                    </div>

                    <div class="contact-info-card">
                        <div class="contact-icon" aria-hidden="true">◎</div>
                        <div>
                            <h3><?= contactEscape(t('contact_services_title', 'Our services')) ?></h3>
                            <p>
                                <?= contactEscape(t(
                                    'contact_services_info',
                                    'Marketplace support, product listings, SEO, digital marketing and website development.'
                                )) ?>
                            </p>
                        </div>
                    </div>

                    <div class="contact-info-card">
                        <div class="contact-icon" aria-hidden="true">◷</div>
                        <div>
                            <h3><?= contactEscape(t('contact_response_title', 'What happens next?')) ?></h3>
                            <p>
                                <?= contactEscape(t(
                                    'contact_response_info',
                                    'Your enquiry is saved securely in the website database for your team to review.'
                                )) ?>
                            </p>
                        </div>
                    </div>

                    <div class="mt-4">
                        <h3 class="h5 fw-bold mb-3">
                            <?= contactEscape(t('contact_map_title', 'Find us on the map')) ?>
                        </h3>

                        <div class="contact-map">
                            <iframe
                                title="Map location"
                                src="https://maps.google.com/maps?q=India&t=&z=4&ie=UTF8&iwloc=&output=embed"
                                loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade"
                                allowfullscreen>
                            </iframe>
                        </div>

                        <p class="contact-map-note mt-2 mb-0">
                            <?= contactEscape(t(
                                'contact_map_note',
                                'Demo map location. Replace India with your actual office address before publishing.'
                            )) ?>
                        </p>
                    </div>
                </div>

                <!-- Right: Enquiry form -->
                <div class="col-lg-7">
                    <div class="contact-form-card">

                        <div class="contact-kicker">
                            <?= contactEscape(t('contact_form_kicker', 'START A CONVERSATION')) ?>
                        </div>

                        <h2 class="h3 fw-bold mt-2 mb-2">
                            <?= contactEscape(t('contact_form_title', 'Tell us about your project')) ?>
                        </h2>

                        <p class="contact-description mb-4">
                            <?= contactEscape(t(
                                'contact_form_description',
                                'Fill in the details below and describe what you need.'
                            )) ?>
                        </p>

                        <?php if ($success): ?>
                            <div class="alert alert-success" role="status">
                                <?= contactEscape(t(
                                    'contact_success',
                                    'Thank you! Your enquiry has been submitted successfully.'
                                )) ?>
                            </div>
                        <?php endif; ?>

                        <?php if ($errors): ?>
                            <div class="alert alert-danger" role="alert">
                                <ul class="mb-0">
                                    <?php foreach ($errors as $error): ?>
                                        <li><?= contactEscape($error) ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        <?php endif; ?>

                        <form
                            method="post"
                            action="contact.php<?= $currentLang !== 'en' ? '?lang=' . rawurlencode($currentLang) : '' ?>"
                        >
                            <input
                                type="hidden"
                                name="csrf_token"
                                value="<?= contactEscape($_SESSION['csrf_token']) ?>"
                            >

                            <div class="row g-3">

                                <div class="col-md-6">
                                    <label class="form-label" for="name">
                                        <?= contactEscape(t('contact_full_name', 'Full name')) ?> *
                                    </label>
                                    <input
                                        class="form-control"
                                        type="text"
                                        id="name"
                                        name="name"
                                        maxlength="120"
                                        autocomplete="name"
                                        required
                                        value="<?= contactEscape($name) ?>"
                                    >
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label" for="email">
                                        <?= contactEscape(t('contact_email_address', 'Email address')) ?> *
                                    </label>
                                    <input
                                        class="form-control"
                                        type="email"
                                        id="email"
                                        name="email"
                                        maxlength="190"
                                        autocomplete="email"
                                        required
                                        value="<?= contactEscape($email) ?>"
                                    >
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label" for="phone">
                                        <?= contactEscape(t('contact_phone_label', 'Phone (optional)')) ?>
                                    </label>
                                    <input
                                        class="form-control"
                                        type="tel"
                                        id="phone"
                                        name="phone"
                                        maxlength="30"
                                        autocomplete="tel"
                                        value="<?= contactEscape($phone) ?>"
                                    >
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label" for="service">
                                        <?= contactEscape(t('contact_service_label', 'Service')) ?> *
                                    </label>
                                    <select class="form-select" id="service" name="service" required>
                                        <option value="">
                                            <?= contactEscape(t('contact_choose_service', 'Choose a service')) ?>
                                        </option>

                                        <?php foreach ($services as $service): ?>
                                            <option
                                                value="<?= contactEscape($service) ?>"
                                                <?= $selectedService === $service ? 'selected' : '' ?>
                                            >
                                                <?= contactEscape(t_service($service, 'name', $service)) ?>
                                            </option>
                                        <?php endforeach; ?>

                                        <option
                                            value="General enquiry"
                                            <?= $selectedService === 'General enquiry' ? 'selected' : '' ?>
                                        >
                                            <?= contactEscape(t('contact_general_enquiry', 'General enquiry')) ?>
                                        </option>
                                    </select>
                                </div>

                                <div class="col-12">
                                    <label class="form-label" for="package">
                                        <?= contactEscape(t('contact_package_label', 'Package (optional)')) ?>
                                    </label>
                                    <select class="form-select" id="package" name="package">
                                        <option value="">
                                            <?= contactEscape(t('contact_not_sure', 'Not sure yet')) ?>
                                        </option>

                                        <?php foreach ($allowedPackages as $package): ?>
                                            <option
                                                value="<?= contactEscape($package) ?>"
                                                <?= $selectedPackage === $package ? 'selected' : '' ?>
                                            >
                                                <?= contactEscape(t(
                                                    'package_' . strtolower($package),
                                                    $package
                                                )) ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <div class="col-12">
                                    <label class="form-label" for="message">
                                        <?= contactEscape(t('contact_requirements', 'Your requirements')) ?> *
                                    </label>
                                    <textarea
                                        class="form-control"
                                        id="message"
                                        name="message"
                                        rows="5"
                                        maxlength="3000"
                                        required
                                    ><?= contactEscape($message) ?></textarea>
                                </div>

                                <div class="col-12 pt-2">
                                    <button class="contact-submit" type="submit">
                                        <?= contactEscape(t('contact_submit', 'Send enquiry')) ?>
                                        <span aria-hidden="true">→</span>
                                    </button>

                                    <p class="small text-secondary mt-3 mb-0">
                                        <?= contactEscape(t(
                                            'contact_sensitive_notice',
                                            'Please do not include passwords, payment card details or other sensitive information.'
                                        )) ?>
                                    </p>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="contact-bottom">
                <div class="row align-items-center g-3">
                    <div class="col-md">
                        <h3 class="h5 fw-bold mb-2">
                            <?= contactEscape(t('contact_bottom_title', 'Ready to grow your business?')) ?>
                        </h3>
                        <p class="text-secondary mb-0">
                            <?= contactEscape(t(
                                'contact_bottom_description',
                                'Tell us your goals and the services you are interested in.'
                            )) ?>
                        </p>
                    </div>
                    <div class="col-md-auto">
                        <a href="#name" class="contact-submit text-decoration-none">
                            <?= contactEscape(t('contact_bottom_button', 'Start your enquiry')) ?>
                            <span aria-hidden="true">↑</span>
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </section>
</main>

<?php require __DIR__ . '/includes/footer.php'; ?>
