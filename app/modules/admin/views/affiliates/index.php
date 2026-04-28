<div class="page-header">
  <h1 class="page-title">
    Affiliate Payout Requests
  </h1>
</div>

<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Payouts</h3>
      </div>
      <div class="table-responsive">
        <table class="table table-hover table-bordered table-vcenter card-table">
          <thead>
            <tr>
              <th class="text-center w-1">No.</th>
              <th>User</th>
              <th>Email</th>
              <th>Amount</th>
              <th>Status</th>
              <th>Created</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php if (!empty($payouts)): ?>
              <?php foreach ($payouts as $key => $item): ?>
                <?php $item = (object)$item; ?>
                <tr>
                  <td class="text-center"><?= $key + 1 ?></td>
                  <td><?= $item->first_name . ' ' . $item->last_name ?></td>
                  <td><?= $item->email ?></td>
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
                  <td>
                    <?php if ($item->status == 0): ?>
                      <a href="<?= admin_url('affiliates/payout_update?type=approve&ids=' . $item->id) ?>" class="btn btn-icon btn-outline-success" data-toggle="tooltip" data-placement="bottom" title="Approve"><i class="fe fe-check"></i></a>
                      <a href="<?= admin_url('affiliates/payout_update?type=reject&ids=' . $item->id) ?>" class="btn btn-icon btn-outline-danger" data-toggle="tooltip" data-placement="bottom" title="Reject"><i class="fe fe-x"></i></a>
                    <?php endif; ?>
                  </td>
                </tr>
              <?php endforeach; ?>
            <?php else: ?>
              <tr>
                <td colspan="7" class="text-center">No payouts found</td>
              </tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
