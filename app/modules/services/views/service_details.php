<?php
  $items = is_array($items) ? $items : [];
  $items_category = is_array($items_category) ? $items_category : [];
  $focus_service_id = isset($focus_service_id) ? (int) $focus_service_id : 0;
  $buy_base_link = session('uid') ? 'new_order?service=' : 'auth/signup?service=';
  $has_average_time = (get_option("enable_average_time", 0) == 1);
  $grouped_items = [];

  foreach ($items as $item) {
    $group_name = !empty($item['category_name']) ? $item['category_name'] : 'General Services';
    if (!isset($grouped_items[$group_name])) {
      $grouped_items[$group_name] = [];
    }
    $grouped_items[$group_name][] = $item;
  }
?>

<section class="sp24-service-details-page">
  <div class="sp24-service-details-hero">
    <div class="sp24-service-details-hero__content">
      <span class="sp24-service-details-badge">Service Details</span>
      <h1 class="page-title sp24-service-details-title">Explore All Service Details</h1>
      <p class="sp24-service-details-subtitle">
        Browse live pricing, delivery limits, categories, and service descriptions before placing your next order.
      </p>

      <div class="sp24-service-details-actions">
        <a href="<?=cn(session('uid') ? 'new_order' : 'auth/signup')?>" class="btn btn-primary sp24-service-details-btn">
          <i class="fa fa-shopping-cart" aria-hidden="true"></i>
          <span><?=session('uid') ? 'Start New Order' : 'Create Account'?></span>
        </a>
        <a href="<?=cn()?>" class="btn sp24-service-details-btn sp24-service-details-btn--ghost">
          <i class="fa fa-home" aria-hidden="true"></i>
          <span>Back To Home</span>
        </a>
      </div>
    </div>

    <div class="sp24-service-details-hero__stats">
      <div class="sp24-service-stat-box">
        <strong><?=count($items)?></strong>
        <span>Active Services</span>
      </div>
      <div class="sp24-service-stat-box">
        <strong><?=count($items_category)?></strong>
        <span>Categories</span>
      </div>
      <div class="sp24-service-stat-box">
        <strong><?=session('uid') ? 'Live' : 'Sign Up'?></strong>
        <span><?=session('uid') ? 'Buy Instantly' : 'To Buy Services'?></span>
      </div>
    </div>
  </div>

  <div class="sp24-service-details-toolbar">
    <div class="row align-items-center">
      <div class="col-lg-5 mb-3 mb-lg-0">
        <div class="sp24-service-search">
          <i class="fa fa-search" aria-hidden="true"></i>
          <input type="text" id="serviceDetailsSearch" placeholder="Search by service name, ID, or keyword">
        </div>
      </div>
      <div class="col-lg-4 mb-3 mb-lg-0">
        <select class="form-control sp24-service-select" id="serviceDetailsCategory">
          <option value="0">All Categories</option>
          <?php foreach ($items_category as $category) { ?>
            <option value="<?=esc($category['id'])?>"><?=esc($category['name'])?></option>
          <?php } ?>
        </select>
      </div>
      <div class="col-lg-3">
        <div class="sp24-service-details-count">
          <strong id="serviceDetailsVisibleCount"><?=count($items)?></strong>
          <span>services shown</span>
        </div>
      </div>
    </div>
  </div>

  <div class="sp24-service-details-grid" id="serviceDetailsGrid">
    <div class="sp24-service-group">
      <div class="table-responsive sp24-service-details-table-wrap">
        <table class="table sp24-service-details-table">
          <thead>
            <tr>
              <th>ID</th>
              <th>Service</th>
              <th>Rate Per 1000</th>
              <th>Min Order</th>
              <th>Max Order</th>
              <?php if ($has_average_time) { ?>
                <th>Average Time</th>
                <?php } ?>
                <th>Description</th>
              </tr>
            </thead>
            <tbody>
                <?php if (!empty($grouped_items)) { ?>
              <?php foreach ($grouped_items as $group_name => $group_items) { ?>
                <?php foreach ($group_items as $item) { ?>
                  <?php
                    $item_id = (int) $item['id'];
                    $item_name = esc($item['name']);
                    $item_type = ucwords(str_replace('_', ' ', service_type_format($item['type'])));
                    $item_description = trim((string) html_entity_decode($item['desc'], ENT_QUOTES));
                    $search_text = strtolower(strip_tags($item['id'] . ' ' . $item['name'] . ' ' . $item['category_name'] . ' ' . $item['type'] . ' ' . $item_description));
                    $details_link = cn('service-details?service=' . $item_id);
                    $buy_link = cn($buy_base_link . $item_id);
                  ?>
                  <tr
                    class="sp24-service-details-item<?=$focus_service_id === $item_id ? ' is-featured' : ''?>"
                    id="service-<?=$item_id?>"
                    data-category-id="<?=esc($item['cate_id'])?>"
                    data-search="<?=htmlspecialchars($search_text, ENT_QUOTES, 'UTF-8')?>"
                  >
                    <td class="sp24-service-col-id">
                      <strong>#<?=$item_id?></strong>
                    </td>
                    <td class="sp24-service-col-service">
                      <div class="sp24-service-table-title"><?=$item_name?></div>
                      <div class="sp24-service-table-meta">
                        <span class="sp24-service-table-chip"><?=$item_type?></span>
                        <span class="sp24-service-table-chip"><?=$item['dripfeed'] ? 'Dripfeed: Yes' : 'Dripfeed: No'?></span>
                        <span class="sp24-service-table-chip"><?=!empty($item['refill']) ? 'Refill: Yes' : 'Refill: No'?></span>
                      </div>
                    </td>
                    <td class="sp24-service-col-price">
                      <strong><?=show_price_format($item['price'], true)?></strong>
                    </td>
                    <td><?=esc($item['min'])?></td>
                    <td><?=esc($item['max'])?></td>
                    <?php if ($has_average_time) { ?>
                      <td><?=format_avg_time($item['avg_time'])?></td>
                    <?php } ?>
                    <td class="sp24-service-col-description">
                      <?php if ($item_description !== '') { ?>
                        <div class="sp24-service-table-description"><?=$item_description?></div>
                      <?php } else { ?>
                        <span class="sp24-service-table-description--empty">No description has been added for this service yet.</span>
                      <?php } ?>
                    </td>
                  </tr>
                <?php } ?>
                <?php } ?>
                <?php } else { ?>
                  <div class="col-12">
                    <?=show_empty_item()?>
                  </div>
                <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
  </div>

  <?php if (!empty($items)) { ?>
    <div class="sp24-service-details-empty" id="serviceDetailsEmpty" style="display: none;">
      <i class="fa fa-search" aria-hidden="true"></i>
      <h3>No services match your search</h3>
      <p>Try a different keyword or switch to another category.</p>
    </div>
  <?php } ?>
</section>

<script>
  $(function() {
    function filterServiceDetails() {
      var keyword = $.trim($('#serviceDetailsSearch').val().toLowerCase());
      var categoryId = $('#serviceDetailsCategory').val();
      var visibleCount = 0;

      $('.sp24-service-details-item').each(function() {
        var $item = $(this);
        var itemCategoryId = String($item.data('category-id'));
        var itemSearch = String($item.data('search') || '').toLowerCase();
        var categoryMatch = categoryId === '0' || itemCategoryId === categoryId;
        var searchMatch = keyword === '' || itemSearch.indexOf(keyword) !== -1;
        var shouldShow = categoryMatch && searchMatch;

        $item.toggle(shouldShow);
        if (shouldShow) {
          visibleCount++;
        }
      });

      $('.sp24-service-group').each(function() {
        var $group = $(this);
        $group.toggle($group.find('.sp24-service-details-item:visible').length > 0);
      });

      $('#serviceDetailsVisibleCount').text(visibleCount);
      $('#serviceDetailsEmpty').toggle(visibleCount === 0);
    }

    $('#serviceDetailsSearch').on('input', filterServiceDetails);
    $('#serviceDetailsCategory').on('change', filterServiceDetails);

    <?php if ($focus_service_id > 0) { ?>
      var $focusedCard = $('#service-<?=$focus_service_id?>');
      if ($focusedCard.length) {
        setTimeout(function() {
          $('html, body').animate({
            scrollTop: Math.max($focusedCard.offset().top - 120, 0)
          }, 400);
        }, 150);
      }
    <?php } ?>
  });
</script>
