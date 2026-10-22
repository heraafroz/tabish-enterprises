
<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/config/database.php';
require_once __DIR__ . '/includes/language.php';

$plans = [
    'Silver' => 1999,
    'Gold' => 2999,
    'Diamond' => 3999,
    'Amazon + Flipkart' => 4999,
    'Amazon + Flipkart + Meesho' => 5999,
];

$selectedPackage = trim($_GET['package'] ?? $_POST['package'] ?? '');
$error = '';

if (!isset($_SESSION['checkout_csrf'])) {
    $_SESSION['checkout_csrf'] = bin2hex(random_bytes(32));
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $token = $_POST['csrf_token'] ?? '';

    if (
        !is_string($token) ||
        !hash_equals($_SESSION['checkout_csrf'], $token)
    ) {
        $error = 'session_expired_error';
    } elseif (!isset($plans[$selectedPackage])) {
        $error = 'valid_package_error';
    } else {
        $name = trim($_POST['name'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $phone = trim($_POST['phone'] ?? '');

        if ($name === '' || mb_strlen($name) > 120) {
            $error = 'valid_name_error';
        } elseif (
            !filter_var($email, FILTER_VALIDATE_EMAIL) ||
            strlen($email) > 190
        ) {
            $error = 'valid_email_error';
        } elseif ($phone === '' || mb_strlen($phone) > 30) {
            $error = 'valid_phone_error';
        } else {
            $_SESSION['checkout_customer'] = [
                'name' => $name,
                'email' => $email,
                'phone' => $phone,
                'package' => $selectedPackage,
                'amount_paise' => $plans[$selectedPackage] * 100,
            ];

            header(
                'Location: checkout.php?package=' .
                rawurlencode($selectedPackage) . '&review=1'
            );
            exit;
        }
    }
}

$customer = $_SESSION['checkout_customer'] ?? [];

$review = isset($_GET['review']) &&
    isset($customer['package']) &&
    $customer['package'] === $selectedPackage;

$pageTitle = t('checkout_title', 'Complete Your Checkout') .
    ' | Tabish Enterprises';

require_once __DIR__ . '/includes/header.php';

function checkoutEscape($value)
{
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}

function checkoutText($key, $default = '')
{
    return checkoutEscape(t($key, $default));
}
?>

<style>
.te-checkout {
    --te-gold: #c8a45d;
    --te-gold-dark: #a7833e;
    --te-black: #151515;
    --te-muted: #777;
    --te-border: #e9e3d8;
    background: #f8f7f4;
    color: var(--te-black);
    padding: 58px 0 75px;
    min-height: 70vh;
}

.te-checkout * {
    box-sizing: border-box;
}

.te-checkout .checkout-eyebrow {
    color: var(--te-gold-dark);
    font-size: 12px;
    font-weight: 800;
    letter-spacing: 3px;
    text-transform: uppercase;
}

.te-checkout .checkout-title {
    font-size: clamp(30px, 4vw, 44px);
    font-weight: 800;
    letter-spacing: -1.2px;
}

.te-checkout .checkout-subtitle {
    color: var(--te-muted);
    line-height: 1.8;
    max-width: 560px;
    margin-inline: auto;
}

.te-checkout .checkout-card {
    height: 100%;
    background: #fff;
    border: 1px solid var(--te-border);
    border-radius: 18px;
    box-shadow: 0 12px 35px rgba(0,0,0,.045);
    overflow: hidden;
}

.te-checkout .checkout-card-top {
    padding: 23px 26px;
    background: var(--te-black);
    color: #fff;
}

.te-checkout .checkout-card-top h2 {
    font-size: 20px;
    font-weight: 750;
    margin: 0;
}

.te-checkout .checkout-card-top p {
    color: #d4d0c7;
    margin: 7px 0 0;
    font-size: 14px;
}

.te-checkout .checkout-card-content {
    padding: 26px;
}

.te-checkout .checkout-label {
    font-size: 13px;
    font-weight: 700;
    margin-bottom: 8px;
    color: #282828;
}

.te-checkout .checkout-input {
    min-height: 49px;
    border: 1px solid #dedbd4;
    border-radius: 10px;
    padding: 12px 14px;
    background: #fff;
    box-shadow: none;
}

.te-checkout .checkout-input:focus {
    border-color: var(--te-gold);
    box-shadow: 0 0 0 3px rgba(200,164,93,.17);
}

.te-checkout .checkout-btn {
    min-height: 51px;
    background: var(--te-gold);
    border: 1px solid var(--te-gold);
    color: #171717;
    border-radius: 10px;
    font-weight: 800;
    transition: .2s ease;
}

.te-checkout .checkout-btn:hover {
    background: var(--te-gold-dark);
    border-color: var(--te-gold-dark);
    color: #fff;
    transform: translateY(-1px);
}

.te-checkout .checkout-price {
    font-size: 34px;
    line-height: 1.2;
    font-weight: 850;
    letter-spacing: -1px;
}

.te-checkout .checkout-price small {
    font-size: 13px;
    font-weight: 500;
    color: var(--te-muted);
    letter-spacing: 0;
}

.te-checkout .checkout-price-panel {
    border: 1px solid #ebdfc7;
    background: #fcf8ef;
    border-radius: 13px;
    padding: 21px;
}

.te-checkout .checkout-summary-row {
    display: flex;
    justify-content: space-between;
    gap: 14px;
    padding: 15px 0;
    border-bottom: 1px solid #eeeae3;
    font-size: 14px;
}

.te-checkout .checkout-summary-row:last-child {
    border-bottom: 0;
}

.te-checkout .checkout-summary-row span {
    color: var(--te-muted);
}

.te-checkout .checkout-summary-row strong {
    text-align: right;
    overflow-wrap: anywhere;
}

.te-checkout .checkout-package-link {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 15px;
    padding: 17px 19px;
    margin-bottom: 12px;
    border: 1px solid var(--te-border);
    border-radius: 12px;
    background: #fff;
    text-decoration: none;
    color: var(--te-black);
    transition: .2s ease;
}

.te-checkout .checkout-package-link:hover {
    border-color: var(--te-gold);
    background: #fcf8ef;
    transform: translateY(-1px);
}

.te-checkout .checkout-package-link strong {
    color: var(--te-gold-dark);
    white-space: nowrap;
}

.te-checkout .checkout-error {
    padding: 14px 16px;
    border-radius: 10px;
    background: #fff0f0;
    color: #9e2424;
    border: 1px solid #f0cccc;
}

.te-checkout .checkout-notice {
    color: var(--te-muted);
    background: #f8f7f4;
    border: 1px solid var(--te-border);
    padding: 14px;
    border-radius: 10px;
    font-size: 13px;
    line-height: 1.7;
}

.te-checkout .checkout-step {
    display: inline-flex;
    width: 34px;
    height: 34px;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    background: var(--te-gold);
    color: #151515;
    font-weight: 800;
    margin-right: 9px;
}

.te-checkout .checkout-back {
    color: var(--te-gold-dark);
    font-weight: 700;
    text-decoration: none;
}

.te-checkout .checkout-back:hover {
    text-decoration: underline;
}

@media(max-width: 575.98px) {
    .te-checkout {
        padding: 38px 0 50px;
    }

    .te-checkout .checkout-card-content {
        padding: 21px;
    }

    .te-checkout .checkout-card-top {
        padding: 21px;
    }

    .te-checkout .checkout-package-link {
        align-items: flex-start;
        flex-direction: column;
    }
}
</style>

<main class="te-checkout">
    <div class="container">

        <header class="text-center mb-5">
            <div class="checkout-eyebrow mb-3">
                <i class="bi bi-shield-check me-1"></i>
                <?= checkoutText('site_name', 'Tabish Enterprises') ?>
            </div>

            <h1 class="checkout-title mb-3">
                <?= $review
                    ? checkoutText('review_order', 'Review Your Order')
                    : checkoutText('checkout_title', 'Complete Your Checkout') ?>
            </h1>

            <p class="checkout-subtitle">
                <?= $review
                    ? checkoutText('review_subtitle', 'Please verify your package and customer details.')
                    : checkoutText('checkout_subtitle', 'Choose your marketplace package and enter your details to continue.') ?>
            </p>
        </header>

        <?php if ($error !== ''): ?>
            <div class="checkout-error mb-4 mx-auto"
                 style="max-width:800px" role="alert">
                <i class="bi bi-exclamation-circle me-2"></i>
                <?= checkoutText($error, 'Something went wrong. Please try again.') ?>
            </div>
        <?php endif; ?>

        <?php if (!isset($plans[$selectedPackage])): ?>

            <div class="mx-auto" style="max-width:760px">
                <div class="checkout-card">
                    <div class="checkout-card-top">
                        <h2>
                            <i class="bi bi-grid me-2"></i>
                            <?= checkoutText('select_package', 'Select Your Package') ?>
                        </h2>
                        <p>
                            <?= checkoutText('choose_plan', 'Choose the plan that suits your business.') ?>
                        </p>
                    </div>

                    <div class="checkout-card-content">
                        <?php foreach ($plans as $package => $price): ?>
                            <a class="checkout-package-link"
                               href="checkout.php?package=<?= rawurlencode($package) ?>">
                                <span>
                                    <i class="bi bi-box-seam me-2"></i>
                                    <?= checkoutEscape($package) ?>
                                </span>
                                <strong>
                                    ₹<?= number_format($price) ?>/<?= checkoutText('monthly_price_label', 'month') ?>
                                    <i class="bi bi-arrow-right ms-2"></i>
                                </strong>
                            </a>
                        <?php endforeach; ?>

                        <p class="checkout-notice mt-4 mb-0">
                            <i class="bi bi-info-circle me-2"></i>
                            <?= checkoutText(
                                'package_price_notice',
                                'Package prices are displayed as monthly amounts. Any promotional offer and its terms must be confirmed separately.'
                            ) ?>
                        </p>
                    </div>
                </div>
            </div>

        <?php elseif ($review): ?>

            <div class="row g-4 justify-content-center">
                <div class="col-12 col-lg-7">
                    <div class="checkout-card">
                        <div class="checkout-card-top">
                            <h2>
                                <span class="checkout-step">1</span>
                                <?= checkoutText('order_details', 'Order Details') ?>
                            </h2>
                            <p>
                                <?= checkoutText('verify_before_continue', 'Check the information before proceeding.') ?>
                            </p>
                        </div>

                        <div class="checkout-card-content">
                            <div class="checkout-summary-row">
                                <span><?= checkoutText('selected_package', 'Selected package') ?></span>
                                <strong><?= checkoutEscape($customer['package']) ?></strong>
                            </div>

                            <div class="checkout-summary-row">
                                <span><?= checkoutText('customer_name', 'Customer name') ?></span>
                                <strong><?= checkoutEscape($customer['name']) ?></strong>
                            </div>

                            <div class="checkout-summary-row">
                                <span><?= checkoutText('email_address', 'Email address') ?></span>
                                <strong><?= checkoutEscape($customer['email']) ?></strong>
                            </div>

                            <div class="checkout-summary-row">
                                <span><?= checkoutText('phone_number', 'Phone number') ?></span>
                                <strong><?= checkoutEscape($customer['phone']) ?></strong>
                            </div>

                            <div class="checkout-notice mt-4">
                                <i class="bi bi-info-circle me-2"></i>
                                <?= checkoutText(
                                    'payment_not_enabled',
                                    'Payment has not been enabled yet. No payment has been taken.'
                                ) ?>
                            </div>

                            <a href="checkout.php?package=<?= rawurlencode($selectedPackage) ?>"
                               class="checkout-back d-inline-block mt-4">
                                <i class="bi bi-arrow-left me-2"></i>
                                <?= checkoutText('edit_details', 'Edit details') ?>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-lg-4">
                    <div class="checkout-card">
                        <div class="checkout-card-content">
                            <div class="checkout-eyebrow mb-3">
                                <?= checkoutText('order_summary', 'Order Summary') ?>
                            </div>

                            <h2 class="h5 fw-bold mb-4">
                                <?= checkoutEscape($selectedPackage) ?>
                            </h2>

                            <div class="checkout-price-panel">
                                <div class="small text-secondary mb-2">
                                    <?= checkoutText('monthly_price', 'Monthly package price') ?>
                                </div>

                                <div class="checkout-price">
                                    ₹<?= number_format($plans[$selectedPackage]) ?>
                                </div>

                                <small class="text-secondary">
                                    <?= checkoutText('inr_per_month', 'INR / month') ?>
                                </small>
                            </div>

                            <div class="checkout-summary-row mt-3">
                                <span><?= checkoutText('billing_frequency', 'Billing frequency') ?></span>
                                <strong><?= checkoutText('monthly_price_label', 'Monthly price') ?></strong>
                            </div>

                            <div class="checkout-summary-row">
                                <span><?= checkoutText('payment_status', 'Payment status') ?></span>
                                <strong class="text-warning">
                                    <?= checkoutText('not_paid', 'Not paid') ?>
                                </strong>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        <?php else: ?>

            <div class="row g-4 justify-content-center">
                <div class="col-12 col-lg-7">
                    <div class="checkout-card">
                        <div class="checkout-card-top">
                            <h2>
                                <span class="checkout-step">1</span>
                                <?= checkoutText('customer_information', 'Customer Information') ?>
                            </h2>
                            <p>
                                <?= checkoutText('enter_contact_details', 'Enter your contact details.') ?>
                            </p>
                        </div>

                        <div class="checkout-card-content">
                            <form method="post"
                                  action="checkout.php?package=<?= rawurlencode($selectedPackage) ?>">

                                <input type="hidden" name="csrf_token"
                                    value="<?= checkoutEscape($_SESSION['checkout_csrf']) ?>">

                                <input type="hidden" name="package"
                                    value="<?= checkoutEscape($selectedPackage) ?>">

                                <div class="mb-4">
                                    <label for="name" class="form-label checkout-label">
                                        <i class="bi bi-person me-1"></i>
                                        <?= checkoutText('full_name', 'Full Name') ?>
                                    </label>

                                    <input id="name" name="name"
                                        class="form-control checkout-input"
                                        maxlength="120" autocomplete="name"
                                        placeholder="<?= checkoutEscape(t('enter_full_name', 'Enter your full name')) ?>"
                                        required>
                                </div>

                                <div class="mb-4">
                                    <label for="email" class="form-label checkout-label">
                                        <i class="bi bi-envelope me-1"></i>
                                        <?= checkoutText('email_address', 'Email Address') ?>
                                    </label>

                                    <input id="email" type="email" name="email"
                                        class="form-control checkout-input"
                                        maxlength="190" autocomplete="email"
                                        placeholder="<?= checkoutEscape(t('email_placeholder', 'you@example.com')) ?>"
                                        required>
                                </div>

                                <div class="mb-4">
                                    <label for="phone" class="form-label checkout-label">
                                        <i class="bi bi-telephone me-1"></i>
                                        <?= checkoutText('phone_number', 'Phone Number') ?>
                                    </label>

                                    <input id="phone" type="tel" name="phone"
                                        class="form-control checkout-input"
                                        maxlength="30" autocomplete="tel"
                                        placeholder="<?= checkoutEscape(t('enter_phone', 'Enter your phone number')) ?>"
                                        required>
                                </div>

                                <button type="submit" class="btn checkout-btn w-100">
                                    <?= checkoutText('review_order_button', 'Review Order') ?>
                                    <i class="bi bi-arrow-right ms-2"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-lg-4">
                    <div class="checkout-card">
                        <div class="checkout-card-top">
                            <h2>
                                <i class="bi bi-bag-check me-2"></i>
                                <?= checkoutText('order_summary', 'Order Summary') ?>
                            </h2>
                            <p>
                                <?= checkoutText('selected_service_package', 'Your selected service package.') ?>
                            </p>
                        </div>

                        <div class="checkout-card-content">
                            <div class="checkout-eyebrow mb-3">
                                <?= checkoutText('selected_plan', 'Selected Plan') ?>
                            </div>

                            <h3 class="h5 fw-bold mb-4">
                                <?= checkoutEscape($selectedPackage) ?>
                            </h3>

                            <div class="checkout-price-panel mb-4">
                                <div class="small text-secondary mb-2">
                                    <?= checkoutText('monthly_price', 'Monthly package price') ?>
                                </div>

                                <div class="checkout-price">
                                    ₹<?= number_format($plans[$selectedPackage]) ?>
                                </div>

                                <small class="text-secondary">
                                    <?= checkoutText('inr_per_month', 'INR / month') ?>
                                </small>
                            </div>

                            <div class="checkout-summary-row">
                                <span><?= checkoutText('package', 'Package') ?></span>
                                <strong><?= checkoutEscape($selectedPackage) ?></strong>
                            </div>

                            <div class="checkout-summary-row">
                                <span><?= checkoutText('payment', 'Payment') ?></span>
                                <strong><?= checkoutText('not_started', 'Not started') ?></strong>
                            </div>

                            <p class="checkout-notice mt-4 mb-0">
                                <i class="bi bi-shield-lock me-2"></i>
                                <?= checkoutText(
                                    'information_notice',
                                    'Your information will be used to process your enquiry and order.'
                                ) ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

        <?php endif; ?>

        <div class="text-center mt-4">
            <a href="pricing.php" class="checkout-back">
                <i class="bi bi-arrow-left me-2"></i>
                <?= checkoutText('back_to_pricing', 'Back to Pricing') ?>
            </a>
        </div>

    </div>
</main>

<?php require __DIR__ . '/includes/footer.php'; ?>
