<?php
  $option           = get_value($payment_params, 'option');
  $min_amount       = get_value($payment_params, 'min');
  $max_amount       = get_value($payment_params, 'max');
  $type             = get_value($payment_params, 'type');
  $tnx_fee          = get_value($option, 'tnx_fee');

  // Load individual limits into JS variables for dynamic updates
  $crypto_limits = [
      'BTC|BTC' => ['min' => get_value($option, 'btc_min', false, $min_amount), 'max' => get_value($option, 'btc_max', false, $max_amount)],
      'ETH|ETH' => ['min' => get_value($option, 'eth_min', false, $min_amount), 'max' => get_value($option, 'eth_max', false, $max_amount)],
      'LTC|LTC' => ['min' => get_value($option, 'ltc_min', false, $min_amount), 'max' => get_value($option, 'ltc_max', false, $max_amount)],
      'USDT|TRC20' => ['min' => get_value($option, 'usdt_min', false, $min_amount), 'max' => get_value($option, 'usdt_max', false, $max_amount)],
      'BNB|BSC' => ['min' => get_value($option, 'bnb_min', false, $min_amount), 'max' => get_value($option, 'bnb_max', false, $max_amount)],
      'SOL|SOL' => ['min' => get_value($option, 'sol_min', false, $min_amount), 'max' => get_value($option, 'sol_max', false, $max_amount)],
  ];
?>

<div class="add-funds-form-content">
  <form class="form actionAddFundsForm" action="#" method="POST">
    <div class="row">
      <div class="col-md-12">
        <div class="form-group">
          <label><?=sprintf(lang("amount_usd"), $currency_code)?></label>
          <input class="form-control square" type="number" name="amount" id="crypto_amount_input" placeholder="<?php echo $min_amount; ?>" step="0.01" required>
        </div>

        <input type="hidden" name="crypto_coin" id="crypto_coin" required>

        <div class="form-group">
          <label><?php echo lang("note"); ?></label>
          <ul>
            <?php if ($tnx_fee > 0) { ?>
            <li><?=lang("transaction_fee")?>: <strong><?php echo $tnx_fee; ?>%</strong></li>
            <?php } ?>
            <li><?=lang("Minimal_payment")?>: <strong id="dynamic_min_payment"><?php echo $currency_symbol.$min_amount; ?></strong></li>
            <li><?=lang("Maximal_payment")?>: <strong id="dynamic_max_payment"><?php echo ($max_amount > 0 ? $currency_symbol.$max_amount : 'No Limit'); ?></strong></li>
            <li>Ensure you select the correct network. Sending on the wrong network will result in lost funds.</li>
          </ul>
        </div>

        <div class="form-group">
          <label class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input" name="agree" value="1" required>
            <span class="custom-control-label text-uppercase"><strong><?=lang("yes_i_understand_after_the_funds_added_i_will_not_ask_fraudulent_dispute_or_chargeback")?></strong></span>
          </label>
        </div>
        
        <div class="form-actions left">
          <input type="hidden" name="payment_id" value="<?php echo $payment_id; ?>">
          <input type="hidden" name="payment_method" value="<?php echo $type; ?>">
          <button type="submit" class="btn round btn-primary btn-min-width mr-1 mb-1">
            <?=lang("Pay")?>
          </button>
        </div>
      </div>  
    </div>
  </form>
</div>

<script>
  $(document).ready(function() {
    var cryptoLimits = <?php echo json_encode($crypto_limits); ?>;
    var currencySymbol = '<?php echo $currency_symbol; ?>';

    // Function to update min/max display based on selected coin
    function updateCryptoLimits(coinVal) {
        if(cryptoLimits[coinVal]) {
            var min = cryptoLimits[coinVal].min;
            var max = cryptoLimits[coinVal].max;
            
            $('#dynamic_min_payment').text(currencySymbol + min);
            $('#dynamic_max_payment').text(max > 0 ? currencySymbol + max : 'No Limit');
            $('#crypto_amount_input').attr('placeholder', min);
            $('#crypto_amount_input').attr('min', min);
            if(max > 0) {
                $('#crypto_amount_input').attr('max', max);
            } else {
                $('#crypto_amount_input').removeAttr('max');
            }
        }
    }

    // Listen for changes to the hidden input (triggered by clicking cards in index.php)
    $('#crypto_coin').on('change', function() {
        updateCryptoLimits($(this).val());
    });

    // Initialize on page load if a coin is already selected
    if($('#crypto_coin').val()) {
        updateCryptoLimits($('#crypto_coin').val());
    }

    $('.actionAddFundsForm').on('submit', function(e) {
        if(!$('#crypto_coin').val()) {
            e.preventDefault();
            alert('Please select a cryptocurrency method first.');
        }
    });
  });
</script>