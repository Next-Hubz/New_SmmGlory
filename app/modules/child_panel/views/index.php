<div class="row justify-content-center">
  <div class="col-md-8">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Order Child Panel</h3>
      </div>
      <div class="card-body">
        <p>Submit your details below to request a child panel. Once submitted, our team will review and process your request via the Support Tickets system.</p>
        
        <div class="alert alert-info" role="alert">
          <p class="mb-2"><strong>Important:</strong> Please update your domain nameservers to ours before submitting this form.</p>
          <ul class="mb-0">
            <li><strong>Nameserver 1:</strong> dns1.namecheaphosting.com</li>
            <li><strong>Nameserver 2:</strong> dns2.namecheaphosting.com</li>
          </ul>
        </div>
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