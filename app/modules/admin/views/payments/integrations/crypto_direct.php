<?php
  $payment_option = get_value($payment_params, 'option');
  
  // Defaults
  $btc_min = get_value($payment_option, 'btc_min', '5');
  $btc_max = get_value($payment_option, 'btc_max', '1000');
  $eth_min = get_value($payment_option, 'eth_min', '5');
  $eth_max = get_value($payment_option, 'eth_max', '1000');
  $ltc_min = get_value($payment_option, 'ltc_min', '5');
  $ltc_max = get_value($payment_option, 'ltc_max', '1000');
  $usdt_min = get_value($payment_option, 'usdt_min', '5');
  $usdt_max = get_value($payment_option, 'usdt_max', '1000');
  $bnb_min = get_value($payment_option, 'bnb_min', '5');
  $bnb_max = get_value($payment_option, 'bnb_max', '1000');
  $sol_min = get_value($payment_option, 'sol_min', '5');
  $sol_max = get_value($payment_option, 'sol_max', '1000');
?>
<div class="form-group col-md-12">
  <label class="form-label">Cryptomus Merchant ID</label>
  <input type="text" name="payment_params[option][merchant_id]" value="<?php echo get_value($payment_option, 'merchant_id'); ?>" class="form-control">
  <small class="form-text text-muted">This uses the Cryptomus API under the hood to generate white-label crypto invoices directly on your site.</small>
</div>
<div class="form-group col-md-12">
  <label class="form-label">Cryptomus Payment Key</label>
  <input type="text" name="payment_params[option][payment_key]" value="<?php echo get_value($payment_option, 'payment_key'); ?>" class="form-control">
</div>

<h5 class="col-md-12 mt-3 mb-2">Individual Crypto Limits</h5>
<div class="row col-md-12">
    <!-- BTC -->
    <div class="col-md-6 form-group">
        <label class="form-label">BTC Minimum</label>
        <input type="text" name="payment_params[option][btc_min]" value="<?php echo $btc_min; ?>" class="form-control">
    </div>
    <div class="col-md-6 form-group">
        <label class="form-label">BTC Maximum</label>
        <input type="text" name="payment_params[option][btc_max]" value="<?php echo $btc_max; ?>" class="form-control">
    </div>

    <!-- ETH -->
    <div class="col-md-6 form-group">
        <label class="form-label">ETH Minimum</label>
        <input type="text" name="payment_params[option][eth_min]" value="<?php echo $eth_min; ?>" class="form-control">
    </div>
    <div class="col-md-6 form-group">
        <label class="form-label">ETH Maximum</label>
        <input type="text" name="payment_params[option][eth_max]" value="<?php echo $eth_max; ?>" class="form-control">
    </div>

    <!-- LTC -->
    <div class="col-md-6 form-group">
        <label class="form-label">LTC Minimum</label>
        <input type="text" name="payment_params[option][ltc_min]" value="<?php echo $ltc_min; ?>" class="form-control">
    </div>
    <div class="col-md-6 form-group">
        <label class="form-label">LTC Maximum</label>
        <input type="text" name="payment_params[option][ltc_max]" value="<?php echo $ltc_max; ?>" class="form-control">
    </div>

    <!-- USDT -->
    <div class="col-md-6 form-group">
        <label class="form-label">USDT (TRC20) Minimum</label>
        <input type="text" name="payment_params[option][usdt_min]" value="<?php echo $usdt_min; ?>" class="form-control">
    </div>
    <div class="col-md-6 form-group">
        <label class="form-label">USDT (TRC20) Maximum</label>
        <input type="text" name="payment_params[option][usdt_max]" value="<?php echo $usdt_max; ?>" class="form-control">
    </div>

    <!-- BNB -->
    <div class="col-md-6 form-group">
        <label class="form-label">BNB (BEP20) Minimum</label>
        <input type="text" name="payment_params[option][bnb_min]" value="<?php echo $bnb_min; ?>" class="form-control">
    </div>
    <div class="col-md-6 form-group">
        <label class="form-label">BNB (BEP20) Maximum</label>
        <input type="text" name="payment_params[option][bnb_max]" value="<?php echo $bnb_max; ?>" class="form-control">
    </div>

    <!-- SOL -->
    <div class="col-md-6 form-group">
        <label class="form-label">SOL Minimum</label>
        <input type="text" name="payment_params[option][sol_min]" value="<?php echo $sol_min; ?>" class="form-control">
    </div>
    <div class="col-md-6 form-group">
        <label class="form-label">SOL Maximum</label>
        <input type="text" name="payment_params[option][sol_max]" value="<?php echo $sol_max; ?>" class="form-control">
    </div>
</div>