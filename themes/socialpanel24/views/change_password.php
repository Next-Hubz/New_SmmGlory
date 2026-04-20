<?php 
  include_once 'blocks/head.blade.php';
?>

<div class="auth-wrapper">
    <div id="star-container"></div> <!-- Sparkling Stars -->
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8">
                <div class="auth-card">
                    <div class="auth-header text-center">
                        <div class="site-logo mb-4">
                            <a href="<?=cn()?>">
                                <img src="<?=get_option('website_logo', BASE."assets/images/logo.png")?>" alt="website-logo" style="max-height: 50px;">
                            </a>
                        </div>
                        <h2><?=lang("new_password")?></h2>
                        <p class="mb-4"><?=lang("enter_new_password")?></p>
                    </div>

                    <form class="auth-form actionFormWithoutToast" action="<?=cn("auth/ajax_reset_password/".$reset_key)?>" data-redirect="<?=cn('auth/login')?>" method="POST">
                        <div class="form-group">
                            <label><?=lang("new_password")?></label>
                            <input type="password" class="form-control" name="password" placeholder="Enter new password" required>
                        </div>

                        <div class="form-group">
                            <label><?=lang("Confirm_password")?></label>
                            <input type="password" class="form-control" name="re_password" placeholder="Confirm new password" required>
                        </div>

                        <div class="form-group mt-3">
                            <div id="alert-message" class="alert-message-reponse"></div>
                        </div>

                        <div class="form-footer">
                            <button type="submit" class="auth-btn"><?=lang("Submit")?></button>
                        </div>
                    </form>

                    <div class="auth-footer">
                        <a href="<?=cn('auth/login')?>">Back to Login</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php 
  include_once 'blocks/script.blade.php';
?>


