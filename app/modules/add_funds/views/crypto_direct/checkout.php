<?php
// checkout.php
// Expected variables:
// $transaction_id, $amount, $crypto_amount, $crypto_currency, $network, $wallet_address, $currency_symbol
?>
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card p-4 shadow-sm text-center">
            <h3 class="mb-4">Complete Your Payment</h3>
            <p>Please send exactly the amount below to the provided address.</p>
            
            <div class="mb-4">
                <img src="https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=<?=urlencode($crypto_currency.':'.$wallet_address.'?amount='.$crypto_amount)?>" alt="QR Code">
            </div>

            <div class="mb-3">
                <strong>Amount to send:</strong>
                <div class="input-group mt-2">
                    <input type="text" class="form-control text-center font-weight-bold text-primary" value="<?=$crypto_amount?> <?=$crypto_currency?>" readonly id="cryptoAmount">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="button" onclick="copyToClipboard('cryptoAmount')"><i class="fa fa-copy"></i></button>
                    </div>
                </div>
                <small class="text-danger d-block mt-1">Send EXACTLY this amount or your payment may not be credited!</small>
            </div>

            <div class="mb-3">
                <strong>Network:</strong>
                <div class="badge badge-info p-2 w-100"><?=$network?></div>
            </div>

            <div class="mb-4">
                <strong>Destination Address:</strong>
                <div class="input-group mt-2">
                    <input type="text" class="form-control text-center" value="<?=$wallet_address?>" readonly id="cryptoAddress">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="button" onclick="copyToClipboard('cryptoAddress')"><i class="fa fa-copy"></i></button>
                    </div>
                </div>
            </div>

            <div class="alert alert-warning mb-4">
                <i class="fa fa-info-circle"></i> After sending, please wait for blockchain confirmations. This page will automatically update once the payment is detected. Do not close this page until the payment is confirmed.
            </div>

            <div id="paymentStatus" class="mt-3">
                <i class="fa fa-spinner fa-spin fa-2x text-primary"></i>
                <p class="mt-2 text-muted">Awaiting Payment...</p>
            </div>

            <div class="mt-4">
                <a href="<?=cn('add_funds')?>" class="btn btn-secondary">Cancel or Return</a>
            </div>
        </div>
    </div>
</div>

<script>
function copyToClipboard(elementId) {
    var copyText = document.getElementById(elementId);
    copyText.select();
    copyText.setSelectionRange(0, 99999);
    document.execCommand("copy");
    
    // Fallback to clipboard API if available
    if (navigator.clipboard) {
        navigator.clipboard.writeText(copyText.value);
    }
    
    // Try to find a toast function or fallback to alert
    if(typeof jQuery !== 'undefined' && typeof jQuery.toast === 'function') {
        jQuery.toast({
            heading: 'Copied',
            text: 'Copied to clipboard!',
            icon: 'success',
            position: 'top-right'
        });
    } else {
        alert("Copied to clipboard");
    }
}

// Poll for payment status
setInterval(function() {
    $.ajax({
        url: '<?=cn("add_funds/crypto_direct/check_status/".$transaction_id)?>',
        type: 'GET',
        dataType: 'json',
        success: function(res) {
            if(res.status == 'paid') {
                $('#paymentStatus').html('<i class="fa fa-check-circle fa-3x text-success"></i><p class="mt-2 text-success font-weight-bold">Payment Received! Redirecting...</p>');
                setTimeout(function(){
                    window.location.href = '<?=cn("add_funds")?>';
                }, 2000);
            }
        }
    });
}, 10000); // Check every 10 seconds
</script>