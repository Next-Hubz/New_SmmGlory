<?php
  $item_link_related_category = cn('blog/category/'                    . $item['category_url_slug']);
  $item_released              = show_item_post_released_time($item['released']);
  $author                     = get_option('website_name');
  $item_category_name         = show_category_name_by_lang_code($item, $lang_code);
?>
<div class="glass-card sp24-blog-single-card mb-4 p-4">
  <div class="image-thumbnail text-center mb-4">
    <img src="<?= $item['image']; ?>" alt="<?= esc($item['name']); ?>" class="img-fluid rounded" style="width: 100%; max-height: 450px; object-fit: cover;">
  </div>
  <div class="d-flex align-items-center mb-3">
    <a href="<?= $item_link_related_category; ?>" class="badge badge-primary text-white p-2 px-3 mr-3" style="background: linear-gradient(135deg, var(--primary), var(--secondary)); font-size: 0.9rem;"><?= $item_category_name; ?></a>
    <span class="text-muted mr-3"><i class="far fa-calendar-alt"></i> <?= $item_released; ?></span>
    <span class="text-muted"><i class="far fa-user"></i> <?= esc($author); ?></span>
  </div>
  <h1 class="title text-white mb-4"><?= esc($item['name']); ?></h1>
  
  <div class="details text-white" style="line-height: 1.8; font-size: 1.05rem;">
    <?= $item['content']; ?>
  </div>
</div>
<div class="blog-back text-center mt-5 mb-5">
  <a href="<?= cn('blog'); ?>" class="btn btn-signup btn-round">
    <span>
      <i class="fe fe-arrow-left"></i>
    </span> <?=lang('back_to_blog')?> </a>
</div>