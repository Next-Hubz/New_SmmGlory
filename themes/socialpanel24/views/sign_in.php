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
                        <h2><?=lang("login_to_your_account")?></h2>
                        <p class="mb-4">Welcome back! Please enter your details.</p>
                    </div>

                    <form class="auth-form actionForm" action="<?=cn("auth/ajax_sign_in")?>" data-redirect="<?=cn('home')?>" method="POST">
                        <?php
                            if (isset($_COOKIE["cookie_email"])) {
                                $cookie_email = encrypt_decode($_COOKIE["cookie_email"]);
                            }
                            if (isset($_COOKIE["cookie_pass"])) {
                                $cookie_pass = encrypt_decode($_COOKIE["cookie_pass"]);
                            }
                        ?>
                        
                        <div class="form-group">
                            <label><?=lang("Email")?></label>
                            <input type="email" class="form-control" name="email" placeholder="Enter your email" value="<?=(isset($cookie_email) && $cookie_email != "") ? $cookie_email : ""?>" required>
                        </div>

                        <div class="form-group">
                            <label><?=lang("Password")?></label>
                            <input type="password" class="form-control" name="password" placeholder="Enter your password" value="<?=(isset($cookie_pass) && $cookie_pass != "") ? $cookie_pass : ""?>" required>
                        </div>

                        <div class="form-group d-flex justify-content-between align-items-center">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="remember" name="remember" <?=(isset($cookie_email) && $cookie_email != "") ? "checked" : ""?>>
                                <label class="custom-control-label" for="remember"><?=lang("remember_me")?></label>
                            </div>
                            <a href="<?=cn("auth/forgot_password")?>" class="small" style="color: var(--secondary); font-weight: 600;"><?=lang("forgot_password")?></a>
                        </div>

                        <?php
                            if (get_option('enable_goolge_recapcha') &&  get_option('google_capcha_site_key') != "" && get_option('google_capcha_secret_key') != "") {
                        ?>
                        <div class="form-group">
                            <div class="g-recaptcha" data-sitekey="<?=get_option('google_capcha_site_key')?>"></div>
                        </div>
                        <?php } ?>

                        <div class="form-footer">
                            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                            <button type="submit" class="auth-btn btn-spinner-border">
                                <span class="auth-btn__label"><?=lang("Login")?></span>
                                <span class="auth-btn__spinner" aria-hidden="true"></span>
                            </button>
                        </div>
                        
                        <?php echo $social_login_html; ?>
                    </form>

                    <?php if(!get_option('disable_signup_page')){ ?>
                    <div class="auth-footer">
                        <?=lang("dont_have_account_yet")?> <a href="<?=cn('auth/signup')?>"><?=lang("Sign_Up")?></a>
                    </div>
                    <?php }; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php 
  include_once 'blocks/footer.blade.php';
  include_once 'blocks/script.blade.php';
?>
