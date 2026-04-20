    <?php 
  include_once 'blocks/head.blade.php';
?>
<?php include_once 'blocks/navbar.blade.php'; ?>


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
                        <h2><?=lang("forgot_password")?></h2>
                        <p class="mb-4"><?=lang("enter_your_registration_email_address_to_receive_password_reset_instructions")?></p>
                    </div>

                    <form class="auth-form actionFormWithoutToast" action="<?=cn("auth/ajax_forgot_password")?>" data-redirect="<?=cn('auth/login')?>" method="POST">
                        <div class="form-group">
                            <label><?=lang("Email")?></label>
                            <input type="email" class="form-control" name="email" placeholder="Enter your email" required>
                        </div>

                        <div class="form-group mt-3">
                            <div id="alert-message" class="alert-message-reponse"></div>
                        </div>

                        <?php
                            if (get_option('enable_goolge_recapcha') &&  get_option('google_capcha_site_key') != "" && get_option('google_capcha_secret_key') != "") {
                        ?>
                        <div class="form-group">
                            <div class="g-recaptcha" data-sitekey="<?=get_option('google_capcha_site_key')?>"></div>
                        </div>
                        <?php } ?> 

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

