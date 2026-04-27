
<?php if (!empty($items)) : ?>
  <div class="glass-card mb-4 p-4">
    <h3 class="title mb-4" style="font-size: 1.25rem;"><?=lang('related_posts')?></h3>
    <?php foreach ($items as $key => $item) : ?>
      <?php
        $item_link_detail = cn('blog/' . $item['url_slug']);
        $limit_string = ($lang_code == 'en') ? 69 : 18;
        $item_title = truncate_string(strip_tags($item['name']), $limit_string);
      ?>
      <div class="blog-item d-flex mb-3 align-items-center">
        <div class="box-image mr-3" style="width: 80px; flex-shrink: 0;">
          <a href="<?=$item_link_detail?>">
            <img class="img-fluid rounded" src="<?= $item['image'] ?>" alt="<?= $item['name'] ?>" style="width: 100%; height: 60px; object-fit: cover;">
          </a>
        </div>
        <div class="content">
          <p class="mb-0" style="line-height: 1.4;">
            <a href="<?= $item_link_detail ?>" class="text-white font-weight-bold" style="font-size: 0.95rem; text-decoration: none;"><?= $item_title; ?></a>
          </p>
        </div>
      </div>
    <?php endforeach ?>
  </div>
<?php endif ?>