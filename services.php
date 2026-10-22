
<?php

require_once __DIR__ . '/config/database.php';

// Page title
$pageTitle = 'Services | Tabish Enterprises';

// Database connection check
if (!isset($pdo) || !($pdo instanceof PDO)) {
    die('Database connection failed. Please check config/database.php');
}

// Fetch active services
$services = $pdo->query("
    SELECT id, name, short_description, description, icon
    FROM services
    WHERE is_active = 1
    ORDER BY sort_order, id
")->fetchAll(PDO::FETCH_ASSOC);

require __DIR__ . '/includes/header.php';
?>

<main class="services-page">

    <!-- Services Hero -->
    <section class="services-hero page-hero">
        <div class="container">
            <div class="services-hero-content">

                <span class="services-eyebrow">
                    <?= htmlspecialchars(
                        t('services_eyebrow', 'OUR SERVICES'),
                        ENT_QUOTES,
                        'UTF-8'
                    ) ?>
                </span>

                <h1 class="services-hero-title">
                    <?= htmlspecialchars(
                        t(
                            'services_hero_title',
                            'Services That Help Your Business Grow'
                        ),
                        ENT_QUOTES,
                        'UTF-8'
                    ) ?>
                </h1>

                <p class="services-hero-description">
                    <?= htmlspecialchars(
                        t(
                            'services_hero_description',
                            'Explore practical digital solutions and marketplace support tailored to your business needs.'
                        ),
                        ENT_QUOTES,
                        'UTF-8'
                    ) ?>
                </p>

                <a href="contact.php" class="btn btn-gold services-hero-btn">
                    <?= htmlspecialchars(
                        t('services_hero_cta', 'Discuss Your Requirements'),
                        ENT_QUOTES,
                        'UTF-8'
                    ) ?>
                    <span aria-hidden="true">&rarr;</span>
                </a>

            </div>
        </div>
    </section>

    <!-- Services List -->
    <section class="services-list section-space">
        <div class="container">

            <div class="services-section-heading">

                <span class="services-section-label">
                    <?= htmlspecialchars(
                        t('services_section_eyebrow', 'HOW WE CAN HELP'),
                        ENT_QUOTES,
                        'UTF-8'
                    ) ?>
                </span>

                <h2>
                    <?= htmlspecialchars(
                        t('services_section_title', 'Explore Our Services'),
                        ENT_QUOTES,
                        'UTF-8'
                    ) ?>
                </h2>

                <p>
                    <?= htmlspecialchars(
                        t(
                            'services_section_description',
                            'Choose the services that best match your current business goals.'
                        ),
                        ENT_QUOTES,
                        'UTF-8'
                    ) ?>
                </p>

            </div>

            <div class="row g-4">

                <?php if (!empty($services)): ?>

                    <?php foreach ($services as $s): ?>

                        <?php
                        $originalName = trim((string) ($s['name'] ?? ''));
                        $originalDescription = trim(
                            (string) ($s['short_description'] ?? '')
                        );

                        // Translations come from the selected language file.
                        $serviceName = t_service(
                            $originalName,
                            'name',
                            $originalName
                        );

                        $serviceDescription = t_service(
                            $originalName,
                            'description',
                            $originalDescription
                        );
                        ?>

                        <div class="col-12 col-md-6 col-lg-4">

                            <article class="service-card services-item h-100">

                                <div
                                    class="service-icon services-item-icon"
                                    aria-hidden="true"
                                >
                                    <?= htmlspecialchars(
                                        (string) ($s['icon'] ?? ''),
                                        ENT_QUOTES,
                                        'UTF-8'
                                    ) ?>
                                </div>

                                <h3 class="services-item-title">
                                    <?= htmlspecialchars(
                                        $serviceName,
                                        ENT_QUOTES,
                                        'UTF-8'
                                    ) ?>
                                </h3>

                                <p class="services-item-description">
                                    <?= htmlspecialchars(
                                        $serviceDescription,
                                        ENT_QUOTES,
                                        'UTF-8'
                                    ) ?>
                                </p>

                                <a
                                    class="services-details-link"
                                    href="service-details.php?id=<?= (int) $s['id'] ?>"
                                >
                                    <?= htmlspecialchars(
                                        t('services_view_details', 'View Details'),
                                        ENT_QUOTES,
                                        'UTF-8'
                                    ) ?>
                                    <span aria-hidden="true">&rarr;</span>
                                </a>

                            </article>

                        </div>

                    <?php endforeach; ?>

                <?php else: ?>

                    <div class="col-12">
                        <div class="services-empty">

                            <h3>
                                <?= htmlspecialchars(
                                    t(
                                        'services_empty_title',
                                        'Services Coming Soon'
                                    ),
                                    ENT_QUOTES,
                                    'UTF-8'
                                ) ?>
                            </h3>

                            <p>
                                <?= htmlspecialchars(
                                    t(
                                        'services_empty_description',
                                        'We are preparing our services. Please check back soon or contact our team.'
                                    ),
                                    ENT_QUOTES,
                                    'UTF-8'
                                ) ?>
                            </p>

                            <a href="contact.php" class="btn btn-gold">
                                <?= htmlspecialchars(
                                    t(
                                        'services_hero_cta',
                                        'Discuss Your Requirements'
                                    ),
                                    ENT_QUOTES,
                                    'UTF-8'
                                ) ?>
                            </a>

                        </div>
                    </div>

                <?php endif; ?>

            </div>
        </div>
    </section>

</main>

<?php require __DIR__ . '/includes/footer.php'; ?>