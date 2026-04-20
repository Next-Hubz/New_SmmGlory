
<div class="lists-index-ajax">

  <?php include('ajax_index_overplay.php'); ?>

  <?php 
    // Page header
    $is_show_filter          = TRUE;
    $page_options            = 'add-new';
    $page_options_type       = 'ajax-modal';
    $search_params            = null;
    $button_add_position = 'right';
  
    // page header
    if (in_array($controller_name, ['payments', 'transactions'])) {
      $page_options      = '';
      $page_options_type = '';
    }

    // Add new position
    if (in_array($controller_name, ['tickets'])) {
      $button_add_position      = 'left';
    }
  
    if (in_array($controller_name, ['subscribers', 'tickets', 'users_activity'])) {
      $page_options = 'search';
      $search_params = $params;
    }
  
    if (in_array($controller_name, ['language'])) {
      $page_options_type = '';
    }
  
    // page filter
    if (in_array($controller_name, ['subscribers', 'users_activity', 'tickets'])) {
      $is_show_filter = FALSE;
    }
  
    echo show_page_header($controller_name, ['page-options' => $page_options, 'page-options-type' => $page_options_type, 'button_add_position' => $button_add_position, 'search_params' => $search_params]);
    
    // Page header Filter
    if ($is_show_filter ) {
      echo show_page_header_filter($controller_name, ['items_status_count' => $items_status_count, 'params' => $params]);
    }
  ?>
  <?php $this->load->view('../partials_template/table_blade.php'); ?>
</div>

<?php
  if ($controller_name === 'users') {
    $this->load->view('../partials_template/custom_rate_modal.php');
  }
?>