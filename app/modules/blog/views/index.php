<section class="blog blog-section theme-socialpanel24-general">
  <div class="container">
    <div class="row ">
      <div class="col-md-12 row justify-content-md-center">
        <div class="col-md-8 text-center mb-5">
          <div class="blog-header section-title" data-aos="fade-up">
              <h2><?=lang('Blog')?></h2>
              <p class="text-muted mt-3"><?php echo lang("we_bring_you_the_best_stories_and_articles_youll_find_tips_on_all_social_networks_growth_and_general_social_media_advice_as_well_as_latest_updates_related_to_our_services"); ?></p>
          </div>
        </div>
      </div>
      <?php
        $author = get_option('website_name');
      ?>
      <?php if (!empty($items)) : ?>
        <div class="row w-100">
        <?php foreach ($items as $key => $item) : ?>
          <?php 
            $item_link_detail = cn('blog/' . $item['url_slug']);
            $item_link_related_category = cn('blog/category/' . strip_tags($item['category_url_slug']));
            $limit_string = ($lang_code == 'en') ? 69 : 18;
            $item_title = truncate_string(strip_tags($item['name']), $limit_string);
            $limit_string = ($lang_code == 'en') ? 150 : 50;
            $item_content = truncate_string(strip_tag_css($item['content'], 'html'), $limit_string);
            $item_released = show_item_post_released_time($item['released']);
            $item_category_name = show_category_name_by_lang_code($item, $lang_code);
          ?>
          <div class="col-lg-4 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="<?=($key%3)*100?>">
            <div class="glass-card sp24-blog-card h-100 d-flex flex-column">
                <div class="sp24-blog-img">
                    <a href="<?=$item_link_detail?>">
                        <img src="<?=esc($item['image'])?>" alt="<?=esc($item['name'])?>" class="img-fluid rounded" style="width: 100%; height: 200px; object-fit: cover;">
                    </a>
                </div>
                <div class="sp24-blog-content p-3 d-flex flex-column flex-grow-1">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span class="text-muted small"><i class="far fa-calendar-alt"></i> <?=$item_released?></span>
                        <a href="<?=$item_link_related_category?>" class="btn-sm text-white"><?=$item_category_name?></a>
                    </div>
                    <h5 class="mb-3"><a href="<?=$item_link_detail?>" class="text-white"><?=$item_title?></a></h5>
                    <p class="text-muted mb-4 flex-grow-1"><?=$item_content?></p>
                    <div class="d-flex justify-content-between align-items-center mt-auto">
                        <span class="text-muted small">By <?=$author?></span>
                        <a href="<?=$item_link_detail?>" class="btn btn-signup btn-sm">Read More</a>
                    </div>
                </div>
            </div>
          </div>
        <?php endforeach ?>
        </div>
        <!-- Pagination -->
        <div class="col-md-12 m-t-30 d-flex justify-content-center">
          <?php echo show_pagination($pagination, ''); ?>
        </div> 
      <?php else : ?>
        <div class="col-12 text-center">
            <?= show_empty_item(); ?>  
        </div>
      <?php endif ?>
    </div>
  </div>
</section>