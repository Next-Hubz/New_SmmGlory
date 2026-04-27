<!-- Footer -->
<style>
/* Footer isolated styles for socialpanel24 theme design */
.sp24-footer {
  --primary: #7e56ebff;
  --primary-dark: #683ae7ff;
  --secondary: #00d2ff;
  background: rgba(77, 77, 228, 0.95);
  color: #d1d5db;
  padding: 80px 0 40px;
  position: relative;
  overflow: hidden;
  border-top: 1px solid rgba(255, 255, 255, 0.1);
  text-align: left;
}

.sp24-footer::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: radial-gradient(circle at 50% 100%, rgba(114, 76, 218, 1), transparent 100%);
  pointer-events: none;
  z-index: 0;
}

.sp24-footer .container {
  position: relative;
  z-index: 1;
  max-width: 1140px;
  margin: 0 auto;
}

.sp24-footer h5 {
  color: #ffffff;
  margin-bottom: 30px;
  font-size: 1.2rem;
  letter-spacing: 1px;
  font-weight: 700;
  text-transform: uppercase;
  background: linear-gradient(90deg, #fff, #e0e0e0);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  text-shadow: 0 2px 4px rgba(0,0,0,0.3);
}

.sp24-footer p {
  color: #d1d5db;
  line-height: 1.6;
  font-size: 15px;
}

.sp24-footer-links {
  padding-left: 0;
  list-style: none;
}

.sp24-footer-links li {
  margin-bottom: 15px;
}

.sp24-footer-links a {
  color: #d1d5db;
  font-weight: 500;
  font-size: 0.95rem;
  transition: all 0.3s ease;
  display: inline-block;
  text-decoration: none;
}

.sp24-footer-links a:hover {
  color: #ffffff;
  padding-left: 8px;
  text-shadow: 0 0 10px rgba(255,255,255,0.6);
}

.sp24-social-links {
  display: flex;
  gap: 15px;
  margin-top: 20px;
}

.sp24-social-links a {
  width: 45px;
  height: 45px;
  background: rgba(255, 255, 255, 0.1);
  font-size: 1.1rem;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  transition: all 0.3s ease;
  border: 1px solid rgba(255, 255, 255, 0.1);
  color: #fff;
  text-decoration: none;
}

.sp24-social-links a:hover {
  background: var(--primary);
  transform: translateY(-5px);
  box-shadow: 0 10px 20px rgba(95, 46, 234, 0.4);
  color: #fff;
  border-color: transparent;
}

.sp24-footer .input-group {
    display: flex;
    flex-wrap: wrap;
    align-items: stretch;
    width: 100%;
}

.sp24-footer .input-group .form-control {
  background: rgba(255, 255, 255, 0.1);
  border: 1px solid rgba(255, 255, 255, 0.2);
  color: #fff;
  height: 50px;
  border-radius: 30px 0 0 30px;
  padding: 10px 20px;
  flex: 1 1 auto;
  width: 1%;
  margin-bottom: 0;
}

.sp24-footer .input-group .form-control::placeholder {
  color: rgba(255, 255, 255, 0.7);
}

.sp24-footer .input-group .form-control:focus {
  background: rgba(255, 255, 255, 0.95);
  border-color: var(--primary);
  box-shadow: 0 0 0 4px rgba(95, 46, 234, 0.2);
  outline: none;
}

.sp24-footer .btn-submit {
  background: linear-gradient(90deg, var(--primary), var(--secondary));
  border: none;
  padding: 0 25px;
  font-weight: 700;
  transition: all 0.3s ease;
  height: 50px;
  border-radius: 0 30px 30px 0;
  box-shadow: 0 5px 15px rgba(0, 0, 0, 0.02);
  color: #fff;
  cursor: pointer;
  display: inline-block;
  white-space: nowrap;
}

.sp24-footer .btn-submit:hover {
  background:  var(--primary);
  box-shadow: 0 10px 20px rgba(127, 88, 235, 0.75);
  transform: translateY(-2px);
  color: #fff;
}

.sp24-copyright {
  border-top: 1px solid rgba(255, 255, 255, 0.1);
  padding-top: 30px;
  margin-top: 50px;
  color: #9ca3af;
  font-size: 0.9rem;
  text-align: center;
}
</style>

<footer class="sp24-footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 mb-4 mb-lg-0">
                <a href="<?=cn()?>" class="d-block mb-4">
                    <img src="<?=get_option('website_logo_white', BASE."assets/images/logo_white.png")?>" alt="Logo" height="40">
                </a>
                <p>The best SMM Panel in the market. We provide high quality social media services for Resellers and Individuals.</p>
                <div class="sp24-social-links">
                    <a href="#"><i class="fa fa-telegram"></i></a>
                    <a href="#"><i class="fa fa-whatsapp"></i></a>
                    <a href="mailto:<?=get_option('email')?>"><i class="fa fa-envelope"></i></a>
                    <a href="<?=cn('auth/login')?>"><i class="fa fa-comments"></i></a>
                </div>
            </div>
            <div class="col-lg-2 col-md-6 mb-4 mb-lg-0">
                <h5>Quick Links</h5>
                <ul class="sp24-footer-links">
                     <?php if (!session('uid')) { ?>
                    <li><a href="<?=cn()?>#home">Home</a></li>
                    <li><a href="<?=cn()?>#features">Features</a></li>
                    <li><a href="<?=cn()?>#services">Services</a></li>
                    <li><a href="<?=cn('auth/signup')?>">Sign Up</a></li>
                    <?php } else { ?>
                    <li><a href="<?=cn('new_order')?>">New Order</a></li>
                    <li><a href="<?=cn('mass_order')?>">Mass Order</a></li>
                    <li><a href="<?=cn('services')?>">Services</a></li>
                    <li><a href="<?=cn('tickets')?>">Tickets</a></li>
                    <?php } ?>
                </ul>
            </div>
            <div class="col-lg-2 col-md-6 mb-4 mb-lg-0">
                <h5>Support</h5>
                <ul class="sp24-footer-links">
                    <?php if (!session('uid')) { ?>
                    <li><a href="<?=cn()?>#contact">Contact Us</a></li>
                    <?php } else { ?>
                    <li><a href="<?=cn('tickets')?>">Contact Us</a></li>
                    <?php } ?>
                    <li><a href="<?=cn('faq')?>">FAQ</a></li>
                    <li><a href="<?=cn('terms')?>">Terms of Service</a></li>
                    <li><a href="<?=cn('api/docs')?>">API Docs</a></li>
                </ul>
            </div>
            <div class="col-lg-4 col-md-6">
                <h5>Newsletter</h5>
                <p>Subscribe to our newsletter to get the latest updates and offers.</p>
                <form class="mt-3 actionFormWithoutToast" action="<?=cn('client/subscriber')?>" method="POST">
                    <div class="input-group">
                        <input type="email" name="email" class="form-control" placeholder="Enter your email" required>
                        <div class="input-group-append">
                            <button class="btn-submit" type="submit">Subscribe</button>
                        </div>
                    </div>
                    <div class="mt-3">
                        <div class="alert-message-reponse"></div>
                    </div>
                </form>
            </div>
        </div>
        <div class="sp24-copyright">
            <p class="mb-0">&copy; <?=date('Y')?> <?=get_option('website_name', 'SmartPanel')?>. All Rights Reserved.</p>
        </div>
    </div>
</footer>