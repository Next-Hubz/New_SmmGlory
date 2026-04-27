<?php
  $head_title = (isset($page_title) && $page_title != "") ? strip_tags($page_title) : get_option('website_title', "SmartPanel - SMM Panel Reseller Tool");
  $head_meta_keywords = (isset($page_meta_keywords) && $page_meta_keywords != "") ? strip_tags($page_meta_keywords) : get_option('website_keywords', "smm panel, SmartPanel, smm reseller panel, smm provider panel, reseller panel, instagram panel, resellerpanel, social media reseller panel, smmpanel, panelsmm, smm, panel, socialmedia, instagram reseller panel");
  $head_meta_description = (isset($page_meta_description) && $page_meta_description != "") ? strip_tags($page_meta_description) : get_option('website_desc', "SmartPanel - #1 SMM Reseller Panel - Best SMM Panel for Resellers. Also well known for TOP SMM Panel and Cheap SMM Panel for all kind of Social Media Marketing Services. SMM Panel for Facebook, Instagram, YouTube and more services!");
?>
<?php include_once APPPATH . '../themes/socialpanel24/views/blocks/head.blade.php'; ?>

<!-- Navbar -->
<?php include_once APPPATH . '../themes/socialpanel24/views/blocks/navbar.blade.php'; ?>

<div class="page p-t-70 theme-socialpanel24-general">
  <div class="page-main">
    <div class="my-3 my-md-5">
      <div class="container">
        <?=$template['body']?>
      </div>
    </div>
    <div id="modal-ajax" class="modal fade" tabindex="-1"></div>
  </div>
</div>

<?php 
  include_once APPPATH . '../themes/socialpanel24/views/blocks/footer.blade.php';
  include_once APPPATH . '../themes/socialpanel24/views/blocks/script.blade.php';
?>


