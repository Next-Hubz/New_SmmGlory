
<?php
  $website_name = trim(get_option('website_name', 'SocialPanel24'));
  $faq_items = is_array($items) ? $items : [];
  $faq_total = count($faq_items);
  $website_name_safe = htmlspecialchars($website_name, ENT_QUOTES, 'UTF-8');
  $contact_email = trim(get_option('contact_email', 'support@smmglory.com'));
  $contact_phone = trim(get_option('contact_tel', '+12345678'));
  $working_hours = trim(get_option('contact_work_hour', '24/7 Support'));

  $faq_category_map = [
    'account' => ['account', 'login', 'sign', 'password', 'user', 'profile', 'register'],
    'orders' => ['order', 'orders', 'dripfeed', 'cancel', 'start', 'speed', 'refill', 'drop', 'complete'],
    'payments' => ['payment', 'payments', 'fund', 'funds', 'wallet', 'paypal', 'stripe', 'crypto', 'deposit'],
    'services' => ['service', 'services', 'followers', 'likes', 'views', 'seo', 'social', 'media'],
    'api' => ['api', 'reseller', 'panel', 'integration'],
  ];

  if (!function_exists('socialpanel24_detect_faq_category')) {
    function socialpanel24_detect_faq_category($question, $category_map)
    {
      $question_text = function_exists('mb_strtolower') ? mb_strtolower(strip_tags($question), 'UTF-8') : strtolower(strip_tags($question));

      foreach ($category_map as $category_key => $keywords) {
        foreach ($keywords as $keyword) {
          if (strpos($question_text, $keyword) !== false) {
            return $category_key;
          }
        }
      }

      return 'general';
    }
  }

  $faq_category_labels = [
    'all' => 'All Questions',
    'general' => 'General',
    'services' => 'Services',
    'orders' => 'Orders',
    'payments' => 'Payments',
    'account' => 'Account',
    'api' => 'API',
  ];

  $faq_category_counts = array_fill_keys(array_keys($faq_category_labels), 0);
  $faq_prepared_items = [];

  foreach ($faq_items as $item) {
    $category_key = socialpanel24_detect_faq_category($item['question'], $faq_category_map);
    $faq_category_counts['all']++;
    if (isset($faq_category_counts[$category_key])) {
      $faq_category_counts[$category_key]++;
    } else {
      $faq_category_counts['general']++;
      $category_key = 'general';
    }

    $faq_prepared_items[] = [
      'ids' => $item['ids'],
      'question' => $item['question'],
      'answer' => $item['answer'],
      'category' => $category_key,
      'category_label' => $faq_category_labels[$category_key],
    ];
  }

  $visible_categories = [];
  foreach ($faq_category_labels as $category_key => $category_label) {
    if ($category_key === 'all' || !empty($faq_category_counts[$category_key])) {
      $visible_categories[$category_key] = $category_label;
    }
  }
?>

<link href="<?php echo BASE; ?>themes/socialpanel24/assets/css/socialpanel24.css?v=<?php echo time(); ?>" rel="stylesheet">
<?php
$is_logged_in = session('uid') ? true : false;
$dashboard_class = $is_logged_in ? 'theme-socialpanel24-general--dashboard' : '';
?>
<div class="theme-socialpanel24-general <?php echo $dashboard_class; ?>">
<section class="sp24-faq-hero">
  <div class="sp24-faq-hero__content">
    <span class="sp24-faq-badge">Help Center</span>
    <h1 class="page-title sp24-faq-title"><?=$website_name_safe?> FAQ &amp; Help Center</h1>
    <p class="sp24-faq-subtitle">
      Find quick answers about services, orders, payments, account access, and support for <?=$website_name_safe?>.
    </p>

    <div class="sp24-faq-search">
      <span class="sp24-faq-search__icon"><i class="fa fa-search" aria-hidden="true"></i></span>
      <input
        type="text"
        class="sp24-faq-search__input"
        id="faqSearchInput"
        placeholder="Search questions, keywords, or topics"
        aria-label="Search FAQ"
      >
    </div>

    <div class="sp24-faq-stats">
      <div class="sp24-faq-stat-card">
        <strong><?=$faq_total?></strong>
        <span>Answers Ready</span>
      </div>
      <div class="sp24-faq-stat-card">
        <strong><?=max(count($visible_categories) - 1, 1)?></strong>
        <span>Categories</span>
      </div>
      <div class="sp24-faq-stat-card">
        <strong>24/7</strong>
        <span>Support Access</span>
      </div>
    </div>

    <div class="sp24-faq-actions">
      <a href="<?=cn('tickets')?>" class="btn btn-primary sp24-faq-action">
        <i class="fa fa-life-ring" aria-hidden="true"></i>
        <span>Open Ticket</span>
      </a>
      <a href="mailto:<?=htmlspecialchars($contact_email, ENT_QUOTES, 'UTF-8')?>" class="btn sp24-faq-action sp24-faq-action--ghost">
        <i class="fa fa-envelope" aria-hidden="true"></i>
        <span>Email Support</span>
      </a>
      <?php if (session('uid')) { ?>
    <a href="<?= cn('services') ?>" class="btn sp24-faq-action sp24-faq-action--ghost">
        <i class="fa fa-th-large" aria-hidden="true"></i>
        <span>View Services</span>
    </a>
<?php } else { ?>
    <a href="<?= cn('service-details') ?>" class="btn sp24-faq-action sp24-faq-action--ghost">
        <i class="fa fa-th-large" aria-hidden="true"></i>
        <span>View Services</span>
    </a>
<?php } ?>
    </div>
  </div>

  <div class="sp24-faq-hero__aside">
    <div class="sp24-faq-contact-card">
      <div class="sp24-faq-contact-card__head">
        <span class="sp24-faq-contact-card__status"></span>
        <span>Support details</span>
      </div>

      <div class="sp24-faq-contact-list">
        <div class="sp24-faq-contact-item">
          <span class="sp24-faq-contact-item__label">Brand</span>
          <strong><?=$website_name_safe?></strong>
        </div>
        <div class="sp24-faq-contact-item">
          <span class="sp24-faq-contact-item__label">Email</span>
          <strong><?=htmlspecialchars($contact_email, ENT_QUOTES, 'UTF-8')?></strong>
        </div>
        <div class="sp24-faq-contact-item">
          <span class="sp24-faq-contact-item__label">Phone</span>
          <strong><?=htmlspecialchars($contact_phone, ENT_QUOTES, 'UTF-8')?></strong>
        </div>
        <div class="sp24-faq-contact-item">
          <span class="sp24-faq-contact-item__label">Hours</span>
          <strong><?=htmlspecialchars($working_hours, ENT_QUOTES, 'UTF-8')?></strong>
        </div>
      </div>

      <div class="sp24-faq-contact-card__footer ">
        <i class="fa fa-shield" aria-hidden="true"></i>
        <span>SMMGlory help center experience</span>
      </div>
    </div>
  </div>
</section>

<?php
  $faq_category_cards = [
    'services' => [
      'title' => 'Services',
      'icon' => 'fa-cogs',
      'desc' => 'Quality, safety, refills & how to choose the right service.',
      'bg' => '#e8f5e9',
      'color' => '#2e7d32'
    ],
    'orders' => [
      'title' => 'Orders',
      'icon' => 'fa-shopping-cart',
      'desc' => 'Placing orders, drip feed, mass order, cancellations & statuses.',
      'bg' => '#e3f2fd',
      'color' => '#1565c0'
    ],
    'payments' => [
      'title' => 'Payments',
      'icon' => 'fa-credit-card',
      'desc' => 'Payment methods, crypto, refunds & VIP access.',
      'bg' => '#fff8e1',
      'color' => '#f57f17'
    ],
    'account' => [
      'title' => 'Account',
      'icon' => 'fa-user-circle-o',
      'desc' => 'Security, API keys, 2FA & VIP status.',
      'bg' => '#e0f2f1',
      'color' => '#00695c'
    ],
    'api' => [
      'title' => 'Child Panel',
      'icon' => 'fa-cubes',
      'desc' => 'Reselling, pricing, domain setup & panel customization.',
      'bg' => '#e8f5e9',
      'color' => '#2e7d32'
    ]
  ];
?>
<div class="sp24-faq-category-cards" id="faqCategoryFilters">
  <?php foreach ($faq_category_cards as $cat_key => $cat_info) { ?>
    <div class="sp24-faq-category-card sp24-faq-filter" data-category="<?=$cat_key?>">
      <div class="sp24-faq-category-card__icon" style="background-color: <?=$cat_info['bg']?>; color: <?=$cat_info['color']?>;">
        <i class="fa <?=$cat_info['icon']?>"></i>
      </div>
      <div class="sp24-faq-category-card__content">
        <h4><?=$cat_info['title']?></h4>
        <p><?=$cat_info['desc']?></p>
      </div>
      <div class="sp24-faq-category-card__arrow">
        <i class="fa fa-arrow-right"></i>
      </div>
    </div>
  <?php } ?>
</div>

<section class="sp24-faq-section">
  <div class="sp24-faq-section__head">
    <h2><i class="fa fa-comments-o" aria-hidden="true"></i> Frequently Asked Questions</h2>
    <p>Search or filter the topics below to find the right answer faster.</p>
  </div>

  <div class="row sp24-faq-grid" id="result_ajaxSearch">
    <?php if (!empty($faq_prepared_items)) { ?>
      <?php foreach ($faq_prepared_items as $item) { ?>
        <div
          class="col-md-12 col-xl-6 tr_<?=$item['ids']?> sp24-faq-item"
          data-category="<?=$item['category']?>"
          data-search="<?=htmlspecialchars(strtolower(strip_tags($item['question'] . ' ' . html_entity_decode($item['answer'], ENT_QUOTES))), ENT_QUOTES, 'UTF-8')?>"
        >
          <div class="card faq-card-public">
            <button type="button" class="card-header faq-card-trigger" aria-expanded="false">
              <span class="card-title">
                <span>
                  <span class="faq-question-text"><?=htmlspecialchars($item['question'], ENT_QUOTES, 'UTF-8')?></span>
                </span>
                <span class="card-options">
                  <span class="faq-chevron">
                    <i class="fa fa-angle-down" aria-hidden="true"></i>
                  </span>
                </span>
              </span>
            </button>
            <div class="card-body faq-answer-panel" style="display: none;">
              <?=html_entity_decode($item['answer'], ENT_QUOTES)?>
            </div>
          </div>
        </div>
      <?php } ?>
    <?php } else { ?>
      <div class="col-12">
        <?=show_empty_item()?>
      </div>
    <?php } ?>
  </div>

  <?php if (!empty($faq_prepared_items)) { ?>
    <div class="sp24-faq-empty-search" id="faqEmptySearch" style="display: none;">
      <i class="fa fa-search" aria-hidden="true"></i>
      <h3>No matching questions found</h3>
      <p>Try another keyword or switch to a different category.</p>
    </div>
  <?php } ?>
</section>

<section class="sp24-faq-help-footer">
  <h3>Still need help?</h3>
  <p>Our team is ready to help you with orders, billing, services, and account questions.</p>
  <div class="sp24-faq-actions sp24-faq-actions--center">
    <a href="<?=cn('tickets')?>" class="btn btn-primary sp24-faq-action">
      <i class="fa fa-comments-o" aria-hidden="true"></i>
      <span>Contact Support</span>
    </a>
    <a href="mailto:<?=htmlspecialchars($contact_email, ENT_QUOTES, 'UTF-8')?>" class="btn sp24-faq-action sp24-faq-action--ghost">
      <i class="fa fa-paper-plane" aria-hidden="true"></i>
      <span><?=$contact_email?></span>
    </a>
  </div>
</section>

<script>
  $(function() {
    var activeCategory = 'all';

    function normalizeText(value) {
      return $.trim((value || '').toLowerCase());
    }

    function runFaqFilter() {
      var keyword = normalizeText($('#faqSearchInput').val());
      var visibleCount = 0;

      $('.sp24-faq-item').each(function() {
        var $item = $(this);
        var itemCategory = $item.data('category');
        var itemSearch = normalizeText($item.data('search'));
        var categoryMatch = activeCategory === 'all' || itemCategory === activeCategory;
        var searchMatch = keyword === '' || itemSearch.indexOf(keyword) !== -1;
        var shouldShow = categoryMatch && searchMatch;

        $item.toggle(shouldShow);

        if (!shouldShow) {
          var $card = $item.find('.faq-card-public');
          $card.removeClass('is-open');
          $card.find('.faq-card-trigger').attr('aria-expanded', 'false');
          $card.find('.faq-answer-panel').stop(true, true).slideUp(0);
        } else {
          visibleCount++;
        }
      });

      $('#faqEmptySearch').toggle(visibleCount === 0);
    }

    $(document).on('click', '.faq-card-trigger', function() {
      var $trigger = $(this);
      var $card = $trigger.closest('.faq-card-public');
      var $panel = $card.find('.faq-answer-panel').first();
      var isOpen = $card.hasClass('is-open');

      $('.faq-card-public.is-open').not($card).each(function() {
        var $openCard = $(this);
        $openCard.removeClass('is-open');
        $openCard.find('.faq-card-trigger').attr('aria-expanded', 'false');
        $openCard.find('.faq-answer-panel').stop(true, true).slideUp(250);
      });

      if (isOpen) {
        $card.removeClass('is-open');
        $trigger.attr('aria-expanded', 'false');
        $panel.stop(true, true).slideUp(250); 
      } else {
        $card.addClass('is-open');
        $trigger.attr('aria-expanded', 'true');
        $panel.stop(true, true).slideDown(280);
      }
    });

    $(document).on('click', '.sp24-faq-filter', function() {
      activeCategory = $(this).data('category');
      $('.sp24-faq-filter').removeClass('is-active');
      $(this).addClass('is-active');
      runFaqFilter();
    });

    $(document).on('input', '#faqSearchInput', function() {
      runFaqFilter();
    });
  });
</script>
</div>

