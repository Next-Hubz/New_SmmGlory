<div class="row justify-content-center">
  <div class="col-md-8">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Order Child Panel</h3>
      </div>
      <div class="card-body">
        <p>Submit your details below to request a child panel. Once submitted, our team will review and process your request via the Support Tickets system.</p>
        <p><strong>Note:</strong> Please make sure your domain nameservers are pointed to ours before submitting.</p>
        <br>
        <form class="form actionForm" action="<?= cn($module . '/submit') ?>" data-redirect="<?= cn('tickets') ?>" method="POST">
          <div class="form-group">
            <label class="form-label">Domain Name <span class="form-required">*</span></label>
            <input type="text" class="form-control" name="domain" placeholder="e.g. yourpanel.com" required>
          </div>
          <div class="form-group">
            <label class="form-label">Admin Username <span class="form-required">*</span></label>
            <input type="text" class="form-control" name="admin_user" placeholder="admin" required>
          </div>
          <div class="form-group">
            <label class="form-label">Admin Password <span class="form-required">*</span></label>
            <input type="password" class="form-control" name="admin_password" placeholder="Password" required>
          </div>
          <div class="form-footer">
            <button type="submit" class="btn btn-primary btn-block">Submit Request</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>