<?php
$uid = session('uid');
$affiliate = $this->db->get_where(AFFILIATE, ['uid' => $uid])->row();
$visitors = isset($affiliate->visitors) ? $affiliate->visitors : 0;
$signups = isset($affiliate->signups) ? $affiliate->signups : 0;
$total_earnings = isset($affiliate->total_earnings) ? $affiliate->total_earnings : 0;
$available_earnings = isset($affiliate->available_earnings) ? $affiliate->available_earnings : 0;
$min_payout = get_option('affiliate_minimum_payout', 10);
$rate = get_option('affiliate_commission_rate', 10);
?>
<div class="row">
  <div class="col-sm-6 col-lg-3">
    <div class="card p-3">
      <div class="d-flex align-items-center">
        <span class="stamp stamp-md bg-blue mr-3">
          <i class="fe fe-users"></i>
        </span>
        <div>
          <h4 class="m-0"><a href="javascript:void(0)"><?= $visitors ?></a></h4>
          <small class="text-muted">Total Visits</small>
        </div>
      </div>
    </div>
  </div>
  <div class="col-sm-6 col-lg-3">
    <div class="card p-3">
      <div class="d-flex align-items-center">
        <span class="stamp stamp-md bg-green mr-3">
          <i class="fe fe-user-plus"></i>
        </span>
        <div>
          <h4 class="m-0"><a href="javascript:void(0)"><?= $signups ?></a></h4>
          <small class="text-muted">Total Signups</small>
        </div>
      </div>
    </div>
  </div>
  <div class="col-sm-6 col-lg-3">
    <div class="card p-3">
      <div class="d-flex align-items-center">
        <span class="stamp stamp-md bg-red mr-3">
          <i class="fe fe-dollar-sign"></i>
        </span>
        <div>
          <h4 class="m-0"><a href="javascript:void(0)"><?= get_option("currency_symbol", "$") . number_format($total_earnings, 2) ?></a></h4>
          <small class="text-muted">Total Earnings</small>
        </div>
      </div>
    </div>
  </div>
  <div class="col-sm-6 col-lg-3">
    <div class="card p-3">
      <div class="d-flex align-items-center">
        <span class="stamp stamp-md bg-yellow mr-3">
          <i class="fe fe-dollar-sign"></i>
        </span>
        <div>
          <h4 class="m-0"><a href="javascript:void(0)"><?= get_option("currency_symbol", "$") . number_format($available_earnings, 2) ?></a></h4>
          <small class="text-muted">Available Earnings</small>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-6">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Your Referral Link</h3>
      </div>
      <div class="card-body">
        <p>Share this link to earn <?= $rate ?>% commission on every fund added by your referrals!</p>
        <div class="input-group">
          <input type="text" class="form-control" value="<?= cn('ref/' . $uid) ?>" readonly id="referral_link">
          <span class="input-group-append">
            <button class="btn btn-primary" type="button" onclick="copyToClipboard('referral_link')">Copy</button>
          </span>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-6">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Request Payout</h3>
      </div>
      <div class="card-body">
        <form class="form actionForm" action="<?= cn('affiliates/payout') ?>" method="POST" data-redirect="<?= cn('affiliates') ?>">
          <div class="form-group">
            <label>Amount to withdraw (Min: <?= get_option("currency_symbol", "$") . $min_payout ?>)</label>
            <input type="number" class="form-control" name="amount" step="0.01" max="<?= $available_earnings ?>">
          </div>
          <button type="submit" class="btn btn-primary btn-block">Request Payout</button>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Payout History</h3>
      </div>
      <div class="table-responsive">
        <table class="table table-hover table-bordered table-vcenter card-table">
          <thead>
            <tr>
              <th class="text-center w-1">No.</th>
              <th>Amount</th>
              <th>Status</th>
              <th>Date Requested</th>
            </tr>
          </thead>
          <tbody>
            <?php if (!empty($payouts)): ?>
              <?php foreach ($payouts as $key => $item): ?>
                <?php $item = (object)$item; ?>
                <tr>
                  <td class="text-center"><?= $key + 1 ?></td>
                  <td><?= get_option("currency_symbol", "$") . number_format($item->amount, 2) ?></td>
                  <td>
                    <?php if ($item->status == 0): ?>
                      <span class="badge badge-warning">Pending</span>
                    <?php elseif ($item->status == 1): ?>
                      <span class="badge badge-success">Approved</span>
                    <?php else: ?>
                      <span class="badge badge-danger">Rejected</span>
                    <?php endif; ?>
                  </td>
                  <td><?= $item->created ?></td>
                </tr>
              <?php endforeach; ?>
            <?php else: ?>
              <tr>
                <td colspan="4" class="text-center">No payouts requested yet.</td>
              </tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<script>
function copyToClipboard(elementId) {
  var copyText = document.getElementById(elementId);
  copyText.select();
  document.execCommand("copy");
  alert("Link copied to clipboard!");
}
</script>
