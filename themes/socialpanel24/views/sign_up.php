    <?php 
  include_once 'blocks/head.blade.php';
?>
<?php include_once 'blocks/navbar.blade.php'; ?>

<div class="auth-wrapper">
    <div class="container">
        <div class="row justify-content-center">
            <div id="star-container"></div> <!-- Container for JS stars -->
            <div class="col-lg-8 col-xl-6">
                <div class="auth-card">
                    <div class="auth-header text-center">
                        <a href="<?=cn()?>">
                            <img src="<?=get_option('website_logo', BASE."assets/images/logo.png")?>" alt="Logo" height="50" class="mb-4">
                        </a>
                        <h2>Create Account</h2>
                        <p>Join thousands of users boosting their social media presence.</p>
                    </div>

                    <form class="auth-form actionFormWithoutToast" action="<?=cn("auth/ajax_sign_up")?>" data-redirect="<?=cn('statistics')?>" method="POST">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="first_name"><?=lang("first_name")?></label>
                                    <input type="text" class="form-control" name="first_name" id="first_name" placeholder="John" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="last_name"><?=lang("last_name")?></label>
                                    <input type="text" class="form-control" name="last_name" id="last_name" placeholder="Doe" required>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email"><?=lang("Email")?></label>
                            <input type="email" class="form-control" name="email" id="email" placeholder="name@example.com" required>
                        </div>

                        <?php if (get_option('enable_signup_skype_field')) { ?>
                        <div class="form-group">
                            <label for="skype_id"><?=lang("Skype_id")?></label>
                            <input type="text" class="form-control" name="skype_id" id="skype_id" placeholder="Skype ID (Optional)">
                        </div>
                        <?php } ?>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="password"><?=lang("Password")?></label>
                                    <input type="password" class="form-control" name="password" id="password" placeholder="Min 8 characters" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="re_password"><?=lang("Confirm_password")?></label>
                                    <input type="password" class="form-control" name="re_password" id="re_password" placeholder="Repeat password" required>
                                </div>
                            </div>
                        </div>

                        <!-- <div class="form-group">
                            <label for="timezone">Timezone</label>
                            <select name="timezone" id="timezone" class="form-control">
                                <?php 
                                $time_zones = tz_list();
                                if (!empty($time_zones)) {
                                    $location = get_location_info_by_ip(get_client_ip());
                                    $user_timezone = $location->timezone;
                                    if ($user_timezone == "" || $user_timezone == 'Unknow') {
                                        $user_timezone = get_option("default_timezone", 'UTC');
                                    }
                                    foreach ($time_zones as $key => $time_zone) {
                                ?>
                                <option value="<?=$time_zone['zone']?>" <?=($user_timezone == $time_zone["zone"])? 'selected': ''?>><?=$time_zone['time']?></option>
                                <?php }} ?>
                            </select>
                        </div> -->

                        <?php if (get_option('enable_goolge_recapcha') &&  get_option('google_capcha_site_key') != "" && get_option('google_capcha_secret_key') != "") { ?>
                        <div class="form-group text-center">
                            <div class="g-recaptcha d-inline-block" data-sitekey="<?=get_option('google_capcha_site_key')?>"></div>
                        </div>
                        <?php } ?>

                        <div class="form-group">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="terms" name="terms" required>
                                <label class="custom-control-label" for="terms">
                                    <?=lang("i_agree_the")?> <a href="<?=cn('terms')?>" target="_blank"><?=lang("terms__policy")?></a>
                                </label>
                            </div>
                        </div>

                        <div class="mt-3">
                            <div id="alert-message" class="alert-message-reponse"></div>
                        </div>

                        <button type="submit" class="btn btn-primary auth-btn btn-submit btn-spinner-border">
                            <span class="auth-btn__label"><?=lang("create_new_account")?></span>
                            <span class="auth-btn__spinner" aria-hidden="true"></span>
                        </button>
                        
                        <?php if(isset($social_login_html)) echo $social_login_html; ?>
                    </form>

                    <div class="auth-footer">
                        <p><?=lang("already_have_account")?> <a href="<?=cn('auth/login')?>"><?=lang("Login")?></a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php 
  include_once 'blocks/footer.blade.php';
  include_once 'blocks/script.blade.php';
?>
