

<?php
$pageTitle = 'Pricing | Tabish Enterprises';
require_once __DIR__ . '/includes/header.php';

function pricingText($key, $fallback = '')
{
    return translateText('pricing_' . $key, $fallback);
}
?>




<main class="pricing-page">

    

<!-- HERO SECTION -->

<section class="pricing-hero">
    <div class="container">

        <div class="eyebrow">
            <span class="eyebrow-dot"></span>
            <?= htmlspecialchars(
                pricingText('eyebrow', 'OUR PRICING'),
                ENT_QUOTES,
                'UTF-8'
            ) ?>
        </div>

        <h1>
            <?= htmlspecialchars(
                pricingText(
                    'hero_title',
                    'Packages Shaped Around Your Needs'
                ),
                ENT_QUOTES,
                'UTF-8'
            ) ?>
        </h1>

        <p class="mt-3 mb-0">
            <?= htmlspecialchars(
                pricingText(
                    'hero_description',
                    'Choose a service package that fits your marketplace business. From seller account management to advertising, listings and brand growth, explore the options below.'
                ),
                ENT_QUOTES,
                'UTF-8'
            ) ?>
        </p>

        <div class="hero-bottom-line"></div>

    </div>
</section>


    
<!-- Pricing Plans -->
<section class="pricing-section">
    <div class="container">

        <div class="pricing-heading">
            <h2><?= htmlspecialchars(t('pricing_choose_package', 'Choose Your Package')) ?></h2>
            <p class="mt-3 mb-0">
                <?= htmlspecialchars(t('pricing_intro', 'Explore our service plans for Amazon, Flipkart and Meesho. Contact our team to discuss your requirements.')) ?>
            </p>
        </div>

        <?php
        $pricingPlans = [
            [
                'name' => 'Silver',
                'title_key' => 'pricing_silver_title',
                'title' => 'Silver Plan',
                'badge_key' => 'pricing_silver_badge',
                'badge' => 'Silver',
                'desc_key' => 'pricing_silver_desc',
                'desc' => 'Essential support for marketplace sellers.',
                'offer' => '3,999',
                'price' => '1,999',
                'featured' => false,
                'col' => 'col-12 col-md-6 col-xl-4',
                'package' => 'Silver',
                'features' => [
                    ['pricing_f_buyer_seller_messages', 'All buyer and seller messages responded to'],
                    ['pricing_f_atoz_claims', 'A-to-Z claims representation'],
                    ['pricing_f_feedback_removal', 'Feedback removal support'],
                    ['pricing_f_50_listings', 'Up to 50 listings per month'],
                    ['pricing_f_20_safet_claims', '20 Safe-T claims filed'],
                    ['pricing_f_coupons_promotions', 'Coupons and promotions management'],
                    ['pricing_f_case_followups', 'Case creation and follow-ups'],
                    ['pricing_f_mtr_report', 'Monthly MTR report'],
                    ['pricing_f_listing_corrections', 'Listing corrections'],
                    ['pricing_f_state_sales_report', 'State-wise sales report'],
                    ['pricing_f_return_report', 'Monthly return report']
                ]
            ],
            [
                'name' => 'Gold',
                'title_key' => 'pricing_gold_title',
                'title' => 'Gold Plan',
                'badge_key' => 'pricing_gold_badge',
                'badge' => 'Gold',
                'desc_key' => 'pricing_gold_desc',
                'desc' => 'Expanded account and advertising support.',
                'offer' => '5,999',
                'price' => '2,999',
                'featured' => true,
                'col' => 'col-12 col-md-6 col-xl-4',
                'package' => 'Gold',
                'features' => [
                    ['pricing_f_80_listings', 'Up to 80 listings per month'],
                    ['pricing_f_40_safet_claims', '40 Safe-T claims filed'],
                    ['pricing_f_account_health', 'Account health: LDR, ODR and PCR'],
                    ['pricing_f_sponsored_ads', 'Sponsored ads management'],
                    ['pricing_f_fba_shipment', 'FBA shipment and removal support'],
                    ['pricing_f_ipr', 'IPR filing support'],
                    ['pricing_f_5_a_plus', '5 A+ listings per month'],
                    ['pricing_f_deals_promotions', 'Deals and promotions'],
                    ['pricing_f_prime_sfp', 'Prime enrolment (SFP)'],
                    ['pricing_f_keyword_optimization', 'Keyword optimization'],
                    ['pricing_f_fba_solutions', 'FBA solutions']
                ]
            ],
            [
                'name' => 'Diamond',
                'title_key' => 'pricing_diamond_title',
                'title' => 'Diamond Plan',
                'badge_key' => 'pricing_diamond_badge',
                'badge' => 'Diamond',
                'desc_key' => 'pricing_diamond_desc',
                'desc' => 'Broader marketplace and brand support.',
                'offer' => '7,999',
                'price' => '3,999',
                'featured' => false,
                'col' => 'col-12 col-md-6 col-xl-4',
                'package' => 'Diamond',
                'features' => [
                    ['pricing_f_silver_gold_services', 'All Silver and Gold services'],
                    ['pricing_f_spf_claims', 'All SPF claims filed'],
                    ['pricing_f_account_management', 'Account management support'],
                    ['pricing_f_100_listings', '100+ listings per month'],
                    ['pricing_f_50_feedback_links', '50 feedback link shares'],
                    ['pricing_f_poa', 'All types of POA'],
                    ['pricing_f_10_a_plus', '10 A+ listings per month'],
                    ['pricing_f_basic_store_design', 'Basic store design'],
                    ['pricing_f_asin_discoverability', 'ASIN discoverability support'],
                    ['pricing_f_digital_marketing', 'Digital marketing and promotion'],
                    ['pricing_f_sponsored_brand_store', 'Sponsored brand store support']
                ]
            ],
            [
                'name' => 'Amazon + Flipkart',
                'title_key' => 'pricing_amazon_flipkart_title',
                'title' => 'Amazon + Flipkart',
                'badge_key' => 'pricing_multi_badge',
                'badge' => 'Multi-Marketplace',
                'desc_key' => 'pricing_amazon_flipkart_desc',
                'desc' => 'Marketplace management for two major platforms.',
                'offer' => '7,999',
                'price' => '4,999',
                'featured' => false,
                'col' => 'col-12 col-md-6 col-xl-6',
                'package' => 'Amazon + Flipkart',
                'features' => [
                    ['pricing_f_80_listings', 'Up to 80 listings per month'],
                    ['pricing_f_40_safet_claims', '40 Safe-T claims filed'],
                    ['pricing_f_account_health', 'Account health: LDR, ODR and PCR'],
                    ['pricing_f_sponsored_ads', 'Sponsored ads management'],
                    ['pricing_f_fba_shipment', 'FBA shipment and removal support'],
                    ['pricing_f_ipr', 'IPR filing support'],
                    ['pricing_f_5_a_plus', '5 A+ listings per month'],
                    ['pricing_f_deals_promotions', 'Deals and promotions'],
                    ['pricing_f_prime_sfp', 'Prime enrolment (SFP)'],
                    ['pricing_f_keyword_optimization', 'Keyword optimization'],
                    ['pricing_f_fba_solutions', 'FBA solutions']
                ]
            ],
            [
                'name' => 'Amazon + Flipkart + Meesho',
                'title_key' => 'pricing_all_marketplaces_title',
                'title' => 'Amazon + Flipkart + Meesho',
                'badge_key' => 'pricing_complete_badge',
                'badge' => 'Complete Package',
                'desc_key' => 'pricing_all_marketplaces_desc',
                'desc' => 'Broader support across three marketplaces.',
                'offer' => '11,999',
                'price' => '5,999',
                'featured' => true,
                'col' => 'col-12 col-md-6 col-xl-6',
                'package' => 'Amazon + Flipkart + Meesho',
                'features' => [
                    ['pricing_f_silver_gold_services', 'All Silver and Gold services'],
                    ['pricing_f_spf_claims', 'All SPF claims filed'],
                    ['pricing_f_account_management', 'Account management support'],
                    ['pricing_f_100_listings', '100+ listings per month'],
                    ['pricing_f_50_feedback_links', '50 feedback link shares'],
                    ['pricing_f_poa', 'All types of POA'],
                    ['pricing_f_10_a_plus', '10 A+ listings per month'],
                    ['pricing_f_basic_store_design', 'Basic store design'],
                    ['pricing_f_asin_discoverability', 'ASIN discoverability support'],
                    ['pricing_f_digital_marketing', 'Digital marketing and promotion'],
                    ['pricing_f_sponsored_brand_store', 'Sponsored brand store support']
                ]
            ]
        ];
        ?>

        <div class="row g-4">

            <?php foreach ($pricingPlans as $plan): ?>
                <div class="<?= htmlspecialchars($plan['col']) ?>">
                    <article class="pricing-card <?= $plan['featured'] ? 'featured' : '' ?>">

                        <span class="pricing-badge">
                            <?= htmlspecialchars(t($plan['badge_key'], $plan['badge'])) ?>
                        </span>

                        <h3>
                            <?= htmlspecialchars(t($plan['title_key'], $plan['title'])) ?>
                        </h3>

                        <p class="plan-description">
                            <?= htmlspecialchars(t($plan['desc_key'], $plan['desc'])) ?>
                        </p>

                        <div class="pricing-offer">
                            <?= htmlspecialchars(t('pricing_latest_offer', 'Latest Offer')) ?>
                            <strong>
                                ₹<?= htmlspecialchars($plan['offer']) ?>
                                / <?= htmlspecialchars(t('pricing_offer_duration', '2+1 Month')) ?>
                            </strong>
                        </div>

                        <div class="pricing-price">
                            ₹<?= htmlspecialchars($plan['price']) ?>
                            <small>/ <?= htmlspecialchars(t('pricing_month', 'month')) ?></small>
                        </div>

                        <div class="pricing-billing">
                            <?= htmlspecialchars(t('pricing_billing_note', 'Monthly plan price as provided')) ?>
                        </div>

                        <hr class="pricing-divider">

                        <div class="pricing-features-title">
                            <?= htmlspecialchars(t('pricing_package_includes', 'Package Includes')) ?>
                        </div>

                        <ul class="pricing-features">
                            <?php foreach ($plan['features'] as $feature): ?>
                                <li>
                                    <span>✓</span>
                                    <?= htmlspecialchars(t($feature[0], $feature[1])) ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>

                        
<a
    href="checkout.php?package=<?= rawurlencode($plan['package']) ?>"
    class="pricing-btn <?= $plan['featured'] ? 'pricing-btn-primary' : 'pricing-btn-outline' ?>"
>
    <?= htmlspecialchars(t('pricing_checkout', 'Choose Package')) ?>
    →
</a>


                    </article>
                </div>
            <?php endforeach; ?>

        </div>

        <div class="pricing-note mt-5">
            <strong><?= htmlspecialchars(t('pricing_note_title', 'Please note:')) ?></strong>
            <?= htmlspecialchars(t(
                'pricing_note',
                'The offers and prices displayed are based on the information provided. Confirm the offer duration, service limits, platform coverage, deliverables and applicable terms with Tabish Enterprises before purchasing.'
            )) ?>
        </div>

    </div>
</section>


</main>

<?php require __DIR__ . '/includes/footer.php'; ?>