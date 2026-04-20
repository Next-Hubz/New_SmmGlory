<!-- Footer -->
<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 mb-4 mb-lg-0">
                <a href="<?=cn()?>" class="d-block mb-4">
                    <img src="<?=get_option('website_logo_white', BASE."assets/images/logo_white.png")?>" alt="Logo" height="40">
                </a>
                <p>The best SMM Panel in the market. We provide high quality social media services for Resellers and Individuals.</p>
                <div class="social-links mt-4">
                    <a href="#"><i class="fab fa-telegram"></i></a>
                    <a href="#"><i class="fab fa-whatsapp"></i></a>
                    <a href="#"><i class="fas fa-envelope"></i></a>
                    <a href="#"><i class="fas fa-comment-dots"></i></a>
                </div>
            </div>
            <div class="col-lg-2 col-md-6 mb-4 mb-lg-0">
                <h5>Quick Links</h5>
                <ul class="list-unstyled footer-links">
                    <li><a href="<?=cn()?>#home">Home</a></li>
                    <li><a href="<?=cn()?>#features">Features</a></li>
                    <li><a href="<?=cn()?>#services">Services</a></li>
                    <li><a href="<?=cn('auth/signup')?>">Sign Up</a></li>
                </ul>
            </div>
            <div class="col-lg-2 col-md-6 mb-4 mb-lg-0">
                <h5>Support</h5>
                <ul class="list-unstyled footer-links">
                    <li><a href="<?=cn()?>#contact">Contact Us</a></li>
                    <li><a href="<?=cn('faq')?>">FAQ</a></li>
                    <li><a href="<?=cn('terms')?>">Terms of Service</a></li>
                    <li><a href="<?=cn('api')?>">API Docs</a></li>
                </ul>
            </div>
            <div class="col-lg-4 col-md-6">
                <h5>Newsletter</h5>
                <p>Subscribe to our newsletter to get the latest updates and offers.</p>
                <form class="mt-3 actionFormWithoutToast" action="<?=cn('client/subscriber')?>" method="POST">
                    <div class="input-group">
                        <input type="email" name="email" class="form-control" placeholder="Enter your email" required style="border-radius: 30px 0 0 30px; border: none; padding: 20px;">
                        <div class="input-group-append">
                            <button class="btn btn-primary btn-submit" type="submit" style="border-radius: 0 30px 30px 0;">Subscribe</button>
                        </div>
                    </div>
                    <div class="mt-3">
                        <div class="alert-message-reponse"></div>
                    </div>
                </form>
            </div>
        </div>
        <div class="copyright">
            <p class="mb-0">&copy; <?=date('Y')?> <?=get_option('website_name', 'SmartPanel')?>. All Rights Reserved.</p>
        </div>
    </div>
</footer>
