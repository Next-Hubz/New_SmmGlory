<?php 
// Check if table_thead_html is passed, if not, show empty
if (!isset($table_thead_html)) $table_thead_html = ''; 
?>
<div class="card">
    <?php $this->load->view('../partials_template/list_card_header.php'); ?>
    <div class="table-responsive">
        <table class="<?= get_table_class(); ?>">
            <?php echo $table_thead_html; ?>
            <tbody id="table-body">
            </tbody>
        </table>
    </div>
</div>
<div id="pagination"></div>
