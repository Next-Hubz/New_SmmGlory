
<?php
  if ($active_payments) : ?>
<section class="add-funds m-t-30">   
  <div class="container-fluid">
    <div class="row justify-content-md-center" id="result_ajaxSearch">
      <div class="col-md-8">
        
        <h4 class="mb-4">Method</h4>
        <!-- Payment Method Cards -->
        <div class="row payment-method-selection">
          <?php
            // Ensure Cryptomus is first, then Crypto Direct, then others
            usort($active_payments, function($a, $b) {
                if ($a['type'] == 'cryptomus' && $b['type'] != 'cryptomus') return -1;
                if ($b['type'] == 'cryptomus' && $a['type'] != 'cryptomus') return 1;
                if ($a['type'] == 'crypto_direct' && $b['type'] != 'crypto_direct') return -1;
                if ($b['type'] == 'crypto_direct' && $a['type'] != 'crypto_direct') return 1;
                return $a['sort'] <=> $b['sort'];
            });

            $card_index = 0;
            foreach ($active_payments as $key => $row) {
              if ($row) {
                // Set custom icon and subtext based on payment type
                $icon_class = "fa-credit-card";
                $subtext = "Credit/Debit Cards";
                $icon_color = "#6c5ce7";
                $icon_bg = "#f3f0ff";
                
                if ($row['type'] == 'crypto_direct') {
                    $crypto_coins = [
                        ['val' => 'BTC|BTC', 'name' => 'Bitcoin', 'subtext' => 'BTC Network', 'icon_class' => 'fa-bitcoin', 'icon_bg' => '#f7931a', 'icon_color' => '#fff'],
                        ['val' => 'ETH|ETH', 'name' => 'Ethereum', 'subtext' => 'ERC20 Network', 'icon_class' => 'fa-connectdevelop', 'icon_bg' => '#627eea', 'icon_color' => '#fff'],
                        ['val' => 'BNB|BSC', 'name' => 'BNB', 'subtext' => 'BEP20 Network', 'icon_class' => 'fa-viacoin', 'icon_bg' => '#f3ba2f', 'icon_color' => '#fff'],
                        ['val' => 'SOL|SOL', 'name' => 'Solana', 'subtext' => 'SOL Network', 'icon_class' => 'fa-gg', 'icon_bg' => '#14f195', 'icon_color' => '#000'],
                        ['val' => 'USDT|TRON', 'name' => 'USDT', 'subtext' => 'TRC20 Network', 'icon_class' => 'fa-usd', 'icon_bg' => '#26a17b', 'icon_color' => '#fff'],
                    ];
                    
                    foreach ($crypto_coins as $coin) {
                        $card_index++;
                        ?>
                        <div class="col-md-6 m-b-20">
                          <a class="payment-method-item crypto-method-item <?php echo ($card_index == 1) ? 'active' : ''?>" href="#crypto_direct" data-coin="<?=$coin['val']?>">
                            <div class="card h-100 payment-card">
                              <div class="card-body text-center d-flex flex-column align-items-center justify-content-center p-4">
                                <div class="payment-icon-wrapper mb-3" style="background-color: <?=$coin['icon_bg']?>; color: <?=$coin['icon_color']?>; font-size: <?=(isset($coin['text_icon']) ? '14px' : '24px')?>; font-weight: bold;">
                                  <?php if(isset($coin['text_icon'])): ?>
                                    <?=$coin['text_icon']?>
                                  <?php else: ?>
                                    <i class="fa <?=$coin['icon_class']?>"></i>
                                  <?php endif; ?>
                                </div>
                                <h5 class="payment-name font-weight-bold mb-1">
                                  <?=$coin['name']?>
                                </h5>
                                <div class="text-muted small">
                                  <?=$coin['subtext']?>
                                </div>
                              </div>
                            </div>
                          </a>
                        </div>
                        <?php
                    }
                } else {
                    if ($row['type'] == 'cryptomus') {
                        $icon_class = "fa-bitcoin";
                        $subtext = "Bitcoin & Cryptocurrencies";
                        $icon_color = "#f7931a";
                        $icon_bg = "#fff4e6";
                    } elseif ($row['type'] == 'paypal') {
                        $icon_class = "fa-paypal";
                        $subtext = "PayPal & Cards";
                        $icon_color = "#003087";
                        $icon_bg = "#e6f2ff";
                    }
                    $card_index++;
          ?>
          <div class="col-md-6 m-b-20">
            <a class="payment-method-item <?php echo ($card_index == 1) ? 'active' : ''?>" href="#<?php echo $row['type'] ?>">
              <div class="card h-100 payment-card">
                <div class="card-body text-center d-flex flex-column align-items-center justify-content-center p-4">
                  <div class="payment-icon-wrapper mb-3" style="background-color: <?=$icon_bg?>; color: <?=$icon_color?>;">
                    <i class="fa <?=$icon_class?>"></i>
                  </div>
                  <h5 class="payment-name font-weight-bold mb-1">
                    <?= esc($row['name']); ?>
                  </h5>
                  <div class="text-muted small">
                    <?=$subtext?>
                  </div>
                </div>
              </div>
            </a>
          </div>
          <?php } } } ?>
        </div>

        <h4 class="mt-4 mb-3">Amount</h4>
        <div class="card">
          <div class="card-body">
            <div class="tab-content">
              <?php
                $i = 0;
                foreach ($active_payments as $key => $row) {
                  $i++;
              ?>
                <div id="<?php echo $row['type']; ?>" class="tab-pane fade  <?php echo ($i == 1) ? 'in active show' : ''?>">
                  <?php
                    $this->load->view($row['type'].'/index', ['payment_id' => $row['id'], 'payment_params' => $row['params']]);
                  ?>
                </div>  
              <?php } ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<?php endif; ?>

<style>
  /* Payment Cards Styling */
  .payment-method-selection .payment-method-item {
    display: block;
    color: inherit;
    text-decoration: none;
    transition: all 0.3s ease;
  }
  .payment-method-selection .payment-method-item:hover {
    text-decoration: none;
  }
  .payment-method-selection .payment-card {
    border: 1px solid rgba(0,0,0,0.08);
    border-radius: 12px;
    background: #f8f9fa;
    box-shadow: none;
    transition: all 0.3s ease;
  }
  .payment-method-selection .payment-method-item.active .payment-card {
    border: 2px solid #5f2eea; /* matching primary color */
    background-color: #f0edff;
    box-shadow: 0 8px 15px rgba(95, 46, 234, 0.1);
  }
  .payment-method-selection .payment-icon-wrapper {
    width: 50px;
    height: 50px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 24px;
  }
  
  .page-title h1{
    margin-bottom: 5px; }
    .page-title .border-line {
      height: 5px;
      width: 270px;
      background: #eca28d;
      background: -webkit-linear-gradient(45deg, #eca28d, #f98c6b) !important;
      background: -moz- oldlinear-gradient(45deg, #eca28d, #f98c6b) !important;
      background: -o-linear-gradient(45deg, #eca28d, #f98c6b) !important;
      background: linear-gradient(45deg, #eca28d, #f98c6b) !important;
      position: relative;
      border-radius: 30px; }
    .page-title .border-line::before {
      content: '';
      position: absolute;
      left: 0;
      top: -2.7px;
      height: 10px;
      width: 10px;
      border-radius: 50%;
      background: #fa6d7e;
      -webkit-animation-duration: 6s;
      animation-duration: 6s;
      -webkit-animation-timing-function: linear;
      animation-timing-function: linear;
      -webkit-animation-iteration-count: infinite;
      animation-iteration-count: infinite;
      -webkit-animation-name: moveIcon;
      animation-name: moveIcon; }

  @-webkit-keyframes moveIcon {
    from {
      -webkit-transform: translateX(0);
    }
    to { 
      -webkit-transform: translateX(215px);
    }
  }
</style>

<script>
  $(document).ready(function() {
    // Initialize the active crypto method if any is active on page load
    var activeCrypto = $('.crypto-method-item.active');
    if(activeCrypto.length > 0) {
        $('#crypto_coin').val(activeCrypto.data('coin'));
    }

    $(document).on('click', '.payment-method-item', function(e) {
        // Don't prevent default if clicking inside the form or inputs inside the tab
        if ($(e.target).closest('.tab-pane').length > 0) {
            return;
        }
        
        // Prevent default only for the actual card click to stop jumping to top of page
        e.preventDefault();
        
        // Update Active Card Visual
        $('.payment-method-item').removeClass('active');
        $(this).addClass('active');
        
        // Update Tab Content Manually
        var targetPane = $(this).attr('href');
        $('.tab-pane').removeClass('in active show');
        $(targetPane).addClass('in active show');

        // Set the crypto coin value if it's a crypto method
        if ($(this).hasClass('crypto-method-item')) {
            var coinVal = $(this).data('coin');
            $('#crypto_coin').val(coinVal).trigger('change');
        }
    });
  });
</script>
<?php
  if (get_option("is_active_manual")) {
?>
<section class="add-funds m-t-30">   
  <div class="container-fluid">
    <div class="row justify-content-center m-t-50">
      <div class="col-md-8">
        <div class="page-title m-b-30">
          <h1><i class="fa fa-hand-o-right"></i> 
            <?php echo lang('manual_payment'); ?>
          </h1>
          <div class="border-line"></div>
        </div>
        <div class="content m-t-30">
          <?php echo htmlspecialchars_decode(get_option('manual_payment_content', ''), ENT_QUOTES)?>
        </div>
      </div> 
    </div>

  </div>
</section>
<?php }?>


