
<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/config/database.php';
require_once __DIR__ . '/includes/language.php';

function servicePageEscape($value): string
{
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}

function servicePageText($key, $default = ''): string
{
    return servicePageEscape(t($key, $default));
}

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

$stmt = $pdo->prepare(
    'SELECT * FROM services WHERE id = ? AND is_active = 1 LIMIT 1'
);
$stmt->execute([$id ?: 0]);
$service = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$service) {
    http_response_code(404);

    $pageTitle = t('service_not_found_title', 'Service Not Found')
        . ' | Tabish Enterprises';

    require __DIR__ . '/includes/header.php';
    ?>

    <main class="container py-5">
        <h1><?= servicePageText('service_not_found_heading', 'Service not found') ?></h1>

        <p>
            <?= servicePageText(
                'service_not_found_description',
                'Please browse our available services.'
            ) ?>
        </p>

        <a class="btn btn-teal" href="services.php">
            <?= servicePageText('service_all_button', 'All Services') ?>
        </a>
    </main>

    <?php
    require __DIR__ . '/includes/footer.php';
    exit;
}

$pageTitle = $service['name'] . ' | Tabish Enterprises';
require __DIR__ . '/includes/header.php';
?>

<main>
    <section class="page-hero">
        <div class="container">
            <div class="eyebrow mb-2">
                <?= servicePageText('service_detail_eyebrow', 'Our Services') ?>
            </div>

            <h1><?= servicePageEscape($service['name']) ?></h1>

            <p class="text-secondary mt-3 mb-0">
                <?= servicePageEscape($service['short_description'] ?? '') ?>
            </p>
        </div>
    </section>

    <section class="section-space">
        <div class="container">
            <div class="row g-4">

                <div class="col-lg-8">
                    <div class="service-card">
                        <div class="service-icon">
                            <?= servicePageEscape($service['icon'] ?? '') ?>
                        </div>

                        <h2 class="h3 mt-4">
                            <?= servicePageEscape($service['name']) ?>
                        </h2>

                        <p class="text-secondary lh-lg">
                            <?= nl2br(
                                servicePageEscape($service['description'] ?? '')
                            ) ?>
                        </p>

                        <a
                            class="btn btn-teal mt-2"
                            href="contact.php?service=<?= rawurlencode($service['name']) ?>"
                        >
                            <?= servicePageText(
                                'service_enquire_button',
                                'Enquire About This Service'
                            ) ?>
                        </a>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="service-card">
                        <h3>
                            <?= servicePageText(
                                'service_help_title',
                                'Need help choosing?'
                            ) ?>
                        </h3>

                        <p>
                            <?= servicePageText(
                                'service_help_description',
                                "Share your business goals and we'll discuss the service scope with you."
                            ) ?>
                        </p>

                        <a class="btn btn-outline-navy" href="contact.php">
                            <?= servicePageText(
                                'service_contact_button',
                                'Contact Our Team'
                            ) ?>
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </section>
</main>

<?php require __DIR__ . '/includes/footer.php'; ?>
