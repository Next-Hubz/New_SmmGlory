<div class="lists-index-ajax">
    <?php $this->load->view('common_block/ajax_index_overplay'); ?>
    
    <div class="page-title m-b-20">
        <?php 
          // Page header
          $is_add_new_btn = (staff_has_permission($controller_name, 'add')) ? 'add-new' : '';
          echo show_page_header($controller_name, ['page-options' => $is_add_new_btn, 'page-options-type' => 'ajax-modal']);
        ?>
    </div>
    
    <?php
      // Page header Filter
      echo show_page_header_filter($controller_name, ['items_status_count' => $items_status_count, 'params' => $params]);
    ?>
    
    <?php $this->load->view('partials_template/table_blade'); ?>
</div>
