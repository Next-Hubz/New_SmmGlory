
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
                        ['val' => 'BTC|BTC', 'name' => 'Bitcoin', 'subtext' => 'BTC Network', 'svg_icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 4091.27 4091.73"> <g id="Layer_x0020_1"> <path fill="#F7931A" fill-rule="nonzero" d="M4030.06 2540.77c-273.24,1096.01 -1383.32,1763.02 -2479.46,1489.71 -1095.68,-273.24 -1762.69,-1383.39 -1489.33,-2479.31 273.12,-1096.13 1383.2,-1763.19 2479,-1489.95 1096.06,273.24 1763.03,1383.51 1489.76,2479.57l0.02 -0.02z"/> <path fill="white" fill-rule="nonzero" d="M2947.77 1754.38c40.72,-272.26 -166.56,-418.61 -450,-516.24l91.95 -368.8 -224.5 -55.94 -89.51 359.09c-59.02,-14.72 -119.63,-28.59 -179.87,-42.34l90.16 -361.46 -224.36 -55.94 -92 368.68c-48.84,-11.12 -96.81,-22.11 -143.35,-33.69l0.26 -1.16 -309.59 -77.31 -59.72 239.78c0,0 166.56,38.18 163.05,40.53 90.91,22.69 107.35,82.87 104.62,130.57l-104.74 420.15c6.26,1.59 14.38,3.89 23.34,7.49 -7.49,-1.86 -15.46,-3.89 -23.73,-5.87l-146.81 588.57c-11.11,27.62 -39.31,69.07 -102.87,53.33 2.25,3.26 -163.17,-40.72 -163.17,-40.72l-111.46 256.98 292.15 72.83c54.35,13.63 107.61,27.89 160.06,41.3l-92.9 373.03 224.24 55.94 92 -369.07c61.26,16.63 120.71,31.97 178.91,46.43l-91.69 367.33 224.51 55.94 92.89 -372.33c382.82,72.45 670.67,43.24 791.83,-303.02 97.63,-278.78 -4.86,-439.58 -206.26,-544.44 146.69,-33.83 257.18,-130.31 286.64,-329.61l-0.07 -0.05zm-512.93 719.26c-69.38,278.78 -538.76,128.08 -690.94,90.29l123.28 -494.2c152.17,37.99 640.17,113.17 567.67,403.91zm69.43 -723.3c-63.29,253.58 -453.96,124.75 -580.69,93.16l111.77 -448.21c126.73,31.59 534.85,90.55 468.94,355.05l-0.02 0z"/> </g> </svg>', 'icon_bg' => 'transparent', 'icon_color' => '#fff'],
                        ['val' => 'LTC|LTC', 'name' => 'LiteCoin', 'subtext' => 'LTC Network', 'svg_icon' => '<svg id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 82.6 82.6" width="40" height="40"><title>litecoin-ltc-logo</title><circle cx="41.3" cy="41.3" r="36.83" style="fill:#fff"/><path d="M41.3,0A41.3,41.3,0,1,0,82.6,41.3h0A41.18,41.18,0,0,0,41.54,0ZM42,42.7,37.7,57.2h23a1.16,1.16,0,0,1,1.2,1.12v.38l-2,6.9a1.49,1.49,0,0,1-1.5,1.1H23.2l5.9-20.1-6.6,2L24,44l6.6-2,8.3-28.2a1.51,1.51,0,0,1,1.5-1.1h8.9a1.16,1.16,0,0,1,1.2,1.12v.38L43.5,38l6.6-2-1.4,4.8Z" style="fill:#345d9d"/></svg>', 'icon_bg' => 'transparent', 'icon_color' => '#fff'],
                        ['val' => 'BNB|BSC', 'name' => 'BNB', 'subtext' => 'BEP20 Network', 'svg_icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 2496 2496"><g><path style="fill-rule:evenodd;clip-rule:evenodd;fill:#F0B90B;" d="M1248,0c689.3,0,1248,558.7,1248,1248s-558.7,1248-1248,1248S0,1937.3,0,1248S558.7,0,1248,0L1248,0z"/><path style="fill:#FFFFFF;" d="M685.9,1248l0.9,330l280.4,165v193.2l-444.5-260.7v-524L685.9,1248L685.9,1248z M685.9,918v192.3l-163.3-96.6V821.4l163.3-96.6l164.1,96.6L685.9,918L685.9,918z M1084.3,821.4l163.3-96.6l164.1,96.6L1247.6,918L1084.3,821.4L1084.3,821.4z"/><path style="fill:#FFFFFF;" d="M803.9,1509.6v-193.2l163.3,96.6v192.3L803.9,1509.6L803.9,1509.6z M1084.3,1812.2l163.3,96.6l164.1-96.6v192.3l-164.1,96.6l-163.3-96.6V1812.2L1084.3,1812.2z M1645.9,821.4l163.3-96.6l164.1,96.6v192.3l-164.1,96.6V918L1645.9,821.4L1645.9,821.4L1645.9,821.4z M1809.2,1578l0.9-330l163.3-96.6v524l-444.5,260.7v-193.2L1809.2,1578L1809.2,1578L1809.2,1578z"/><polygon style="fill:#FFFFFF;" points="1692.1,1509.6 1528.8,1605.3 1528.8,1413 1692.1,1316.4 1692.1,1509.6"/><path style="fill:#FFFFFF;" d="M1692.1,986.4l0.9,193.2l-281.2,165v330.8l-163.3,95.7l-163.3-95.7v-330.8l-281.2-165V986.4L968,889.8l279.5,165.8l281.2-165.8l164.1,96.6H1692.1L1692.1,986.4z M803.9,656.5l443.7-261.6l444.5,261.6l-163.3,96.6l-281.2-165.8L967.2,753.1L803.9,656.5L803.9,656.5z"/></g></svg>', 'icon_bg' => 'transparent', 'icon_color' => '#fff'],
                        ['val' => 'SOL|SOL', 'name' => 'Solana', 'subtext' => 'SOL Network', 'svg_icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 397.7 311.7"><linearGradient id="SVGID_1_" gradientUnits="userSpaceOnUse" x1="360.8791" y1="351.4553" x2="141.213" y2="-69.2936" gradientTransform="matrix(1 0 0 -1 0 314)"><stop offset="0" style="stop-color:#00FFA3"/><stop offset="1" style="stop-color:#DC1FFF"/></linearGradient><path style="fill:url(#SVGID_1_);" d="M64.6,237.9c2.4-2.4,5.7-3.8,9.2-3.8h317.4c5.8,0,8.7,7,4.6,11.1l-62.7,62.7c-2.4,2.4-5.7,3.8-9.2,3.8H6.5c-5.8,0-8.7-7-4.6-11.1L64.6,237.9z"/><linearGradient id="SVGID_2_" gradientUnits="userSpaceOnUse" x1="264.8291" y1="401.6014" x2="45.163" y2="-19.1475" gradientTransform="matrix(1 0 0 -1 0 314)"><stop offset="0" style="stop-color:#00FFA3"/><stop offset="1" style="stop-color:#DC1FFF"/></linearGradient><path style="fill:url(#SVGID_2_);" d="M64.6,3.8C67.1,1.4,70.4,0,73.8,0h317.4c5.8,0,8.7,7,4.6,11.1l-62.7,62.7c-2.4,2.4-5.7,3.8-9.2,3.8H6.5c-5.8,0-8.7-7-4.6-11.1L64.6,3.8z"/><linearGradient id="SVGID_3_" gradientUnits="userSpaceOnUse" x1="312.5484" y1="376.688" x2="92.8822" y2="-44.061" gradientTransform="matrix(1 0 0 -1 0 314)"><stop offset="0" style="stop-color:#00FFA3"/><stop offset="1" style="stop-color:#DC1FFF"/></linearGradient><path style="fill:url(#SVGID_3_);" d="M333.1,120.1c-2.4-2.4-5.7-3.8-9.2-3.8H6.5c-5.8,0-8.7,7-4.6,11.1l62.7,62.7c2.4,2.4,5.7,3.8,9.2,3.8h317.4c5.8,0,8.7-7,4.6-11.1L333.1,120.1z"/></svg>', 'icon_bg' => 'transparent', 'icon_color' => '#000'],
                        ['val' => 'USDT|TRON', 'name' => 'USDT', 'subtext' => 'TRC20 Network', 'svg_icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 339.43 295.27"><path d="M62.15,1.45l-61.89,130a2.52,2.52,0,0,0,.54,2.94L167.95,294.56a2.55,2.55,0,0,0,3.53,0L338.63,134.4a2.52,2.52,0,0,0,.54-2.94l-61.89-130A2.5,2.5,0,0,0,275,0H64.45a2.5,2.5,0,0,0-2.3,1.45h0Z" style="fill:#50af95;fill-rule:evenodd"/><path d="M191.19,144.8v0c-1.2.09-7.4,0.46-21.23,0.46-11,0-18.81-.33-21.55-0.46v0c-42.51-1.87-74.24-9.27-74.24-18.13s31.73-16.25,74.24-18.15v28.91c2.78,0.2,10.74.67,21.74,0.67,13.2,0,19.81-.55,21-0.66v-28.9c42.42,1.89,74.08,9.29,74.08,18.13s-31.65,16.24-74.08,18.12h0Zm0-39.25V79.68h59.2V40.23H89.21V79.68H148.4v25.86c-48.11,2.21-84.29,11.74-84.29,23.16s36.18,20.94,84.29,23.16v82.9h42.78V151.83c48-2.21,84.12-11.73,84.12-23.14s-36.09-20.93-84.12-23.15h0Zm0,0h0Z" style="fill:#fff;fill-rule:evenodd"/></svg>', 'icon_bg' => 'transparent', 'icon_color' => '#fff'],
                    ];
                    
                    foreach ($crypto_coins as $coin) {
                        $card_index++;
                        ?>
                        <div class="col-md-6 m-b-1">
                          <a class="payment-method-item crypto-method-item <?php echo ($card_index == 1) ? 'active' : ''?>" href="#crypto_direct" data-coin="<?=$coin['val']?>">
                            <div class="card h-100 payment-card">
                              <div class="card-body text-center d-flex flex-column align-items-center justify-content-center p-4">
                                <div class="payment-icon-wrapper mb-3" style="background-color: <?=$coin['icon_bg']?>; color: <?=$coin['icon_color']?>; font-size: <?=(isset($coin['text_icon']) ? '14px' : '24px')?>; font-weight: bold; border-radius: 50%; width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;">
                                  <?php if(isset($coin['svg_icon'])): ?>
                                    <?=$coin['svg_icon']?>
                                  <?php elseif(isset($coin['text_icon'])): ?>
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
                    $use_image = false;
                    if ($row['type'] == 'cryptomus') {
                        $icon_class = "fa-bitcoin";
                        $subtext = "Bitcoin & Cryptocurrencies";
                        $icon_color = "transparent";
                        $icon_bg = "transparent";
                        $use_image = BASE . "assets/images/payments/cryptomus.png";
                    } elseif ($row['type'] == 'paypal') {
                        $icon_class = "fa-paypal";
                        $subtext = "PayPal & Cards";
                        $icon_color = "#003087";
                        $icon_bg = "#e6f2ff";
                    }
                    $card_index++;
          ?>
          <div class="col-md-6 m-b-1">
            <a class="payment-method-item <?php echo ($card_index == 1) ? 'active' : ''?>" href="#<?php echo $row['type'] ?>">
              <div class="card h-100 payment-card">
                <div class="card-body text-center d-flex flex-column align-items-center justify-content-center p-4">
                  <div class="payment-icon-wrapper mb-3" style="background-color: <?=$icon_bg?>; color: <?=$icon_color?>; <?=$use_image ? 'width: 110px; height: 40px;' : ''?>">
                    <?php if ($use_image): ?>
                        <img src="<?=$use_image?>" alt="Cryptomus" style="width: 100%; height: 100%; object-fit: contain;">
                    <?php else: ?>
                        <i class="fa <?=$icon_class?>"></i>
                    <?php endif; ?>
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



