
<?php if (!empty($count_items_by_category)) : ?>
  <div class="glass-card mb-4 p-4">
    <h3 class="title mb-4" style="font-size: 1.25rem;"><?=lang('Categories')?></h3>
    <div class="widget-category">
      <ul class="list-unstyled mb-0">
      <?php foreach ($count_items_by_category as $key => $items) : ?>
        <?php
          $item_link_related_category = cn('blog/category/' . $key);
          $item_category_name = show_category_name_by_lang_code($items[0], $lang_code);
        ?>
          <li class="mb-2 pb-2 border-bottom" style="border-color: rgba(255,255,255,0.05) !important;">
            <a href="<?= $item_link_related_category; ?>" class="text-white text-decoration-none d-flex justify-content-between align-items-center">
              <span><?= $item_category_name; ?></span> 
              <span class="badge badge-light text-dark badge-pill"><?=count($items); ?></span>
            </a>
          </li>
        <?php endforeach ?>
      </ul>
    </div>
  </div>
<?php endif ?>