<?php
  $payment_option = get_value($payment_params, 'option');
?>
<div class="form-group col-md-12">
  <label class="form-label">Merchant ID</label>
  <input type="text" name="payment_params[option][merchant_id]" value="<?php echo get_value($payment_option, 'merchant_id'); ?>" class="form-control">
</div>
<div class="form-group col-md-12">
  <label class="form-label">Payment Key</label>
  <input type="text" name="payment_params[option][payment_key]" value="<?php echo get_value($payment_option, 'payment_key'); ?>" class="form-control">
</div>
