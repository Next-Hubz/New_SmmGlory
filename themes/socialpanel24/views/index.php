<?php include_once 'blocks/head.blade.php'; ?>
<!-- Navbar -->
<?php include_once 'blocks/navbar.blade.php'; ?>
<!-- Hero Section -->
<header id="home" class="hero-section">
    <div class="container">
        <div class="row align-items-center" style="margin-bottom: 80px;">
            <div class="col-lg-6 hero-content" data-aos="fade-right" data-aos-duration="1000">
                <h1>Resellers' <span class="highlight">#1 Destination</span> for SMM Services</h1>
                <p>Save time managing your social account in one panel. Where people buy SMM services such as Facebook ads management, Instagram, YouTube, Twitter, Soundcloud, Website ads and many more!</p>
                <div class="d-flex">
                    <a href="<?=cn('auth/signup')?>" class="btn btn-hero">Get start now!</a>
                </div>
            </div>
            <div class="col-lg-6 hero-image text-center" data-aos="fade-left" data-aos-duration="1000">
                <img src="<?=BASE?>themes/socialpanel24/assets/images/best_service1.png" alt="SMM Services Illustration" class="img-fluid" style="max-height: 400px; filter: drop-shadow(0 10px 20px rgba(0,0,0,0.1));">
            </div>
        </div>
        <!-- Features/Stats Row (Glassmorphism) -->
        <div class="row features-container" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200">
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="glass-card">
                    <div class="glass-header">
                        <div class="glass-icon icon-dashboard">
                            <i class="fas fa-chart-bar"></i>
                        </div>
                        <h4>All-In-One Dashboard</h4>
                    </div>
                    <div class="glass-content">
                        <p>Manage your ads and social accounts in one powerful and intuitive panel.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="glass-card">
                    <div class="glass-header">
                        <div class="glass-icon icon-star">
                            <i class="fas fa-star"></i>
                        </div>
                        <h4>High-Quality SMM Services</h4>
                    </div>
                    <div class="glass-content">
                        <p>Access a variety of premium SMM services for platforms like Instagram and Youtube.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="glass-card">
                    <div class="glass-header">
                        <div class="glass-icon icon-support">
                            <i class="fas fa-headset"></i>
                        </div>
                        <h4>24/7 Customer Support</h4>
                    </div>
                    <div class="glass-content">
                        <p>Get assistance anytime from our dedicated support team around the clock.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- Features Section -->
<section id="features" class="features-section">
    <div class="container">
        <div class="section-title" data-aos="fade-up">
            <h2>Why Choose Us</h2>
            <p class="text-muted mt-3">We provide the best quality services at the most affordable prices.</p>
        </div>
        <div class="row">
            <div class="col-lg-4 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="100">
                <div class="glass-card">
                    <div class="glass-header">
                        <div class="glass-icon icon-rocket">
                            <i class="fas fa-rocket"></i>
                        </div>
                        <h4>Super Fast Delivery</h4>
                    </div>
                    <div class="glass-content">
                        <p>Our automated system ensures that your orders are processed and delivered instantly without any delay.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="200">
                <div class="glass-card">
                    <div class="glass-header">
                        <div class="glass-icon icon-shield">
                            <i class="fas fa-shield-alt"></i>
                        </div>
                        <h4>Secure & Private</h4>
                    </div>
                    <div class="glass-content">
                        <p>Your data security is our top priority. We use advanced encryption to keep your information safe.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="300">
                <div class="glass-card">
                    <div class="glass-header">
                        <div class="glass-icon icon-support">
                            <i class="fas fa-headset"></i>
                        </div>
                        <h4>24/7 Support</h4>
                    </div>
                    <div class="glass-content">
                        <p>Our dedicated support team is available round the clock to assist you with any queries or issues.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="400">
                <div class="glass-card">
                    <div class="glass-header">
                        <div class="glass-icon icon-wallet">
                            <i class="fas fa-wallet"></i>
                        </div>
                        <h4>Cheapest Prices</h4>
                    </div>
                    <div class="glass-content">
                        <p>We offer the most competitive prices in the market, allowing you to maximize your profit margins.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="500">
                <div class="glass-card">
                    <div class="glass-header">
                        <div class="glass-icon icon-cogs">
                            <i class="fas fa-cogs"></i>
                        </div>
                        <h4>API Support</h4>
                    </div>
                    <div class="glass-content">
                        <p>Integrate our services easily with your own panel or website using our robust and well-documented API.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="600">
                <div class="glass-card">
                    <div class="glass-header">
                        <div class="glass-icon icon-magic">
                            <i class="fas fa-magic"></i>
                        </div>
                        <h4>High Quality</h4>
                    </div>
                    <div class="glass-content">
                        <p>We never compromise on quality. Get premium services that actually help grow your social presence.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- How It Works -->
<section id="how-it-works" class="features-section">
    <div class="container">
        <div class="section-title" data-aos="fade-up">
            <h2>How It Works</h2>
            <p class="text-muted mt-3">Follow these simple steps to start growing your social media presence.</p>
        </div>
        <div class="row position-relative">
            <!-- Connecting Line (Desktop) -->
            <div class="step-connector d-none d-lg-block"></div>

            <div class="col-lg-3 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="100">
                <div class="step-card">
                    <div class="step-icon">
                        <i class="fas fa-user-plus"></i>
                        <span class="step-badge">1</span>
                    </div>
                    <h4>Register Account</h4>
                    <p>Create your account and join our platform to access premium services.</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="200">
                <div class="step-card">
                    <div class="step-icon">
                        <i class="fas fa-wallet"></i>
                        <span class="step-badge">2</span>
                    </div>
                    <h4>Add Funds</h4>
                    <p>Deposit money securely into your wallet using our various payment methods.</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="300">
                <div class="step-card">
                    <div class="step-icon">
                        <i class="fas fa-shopping-cart"></i>
                        <span class="step-badge">3</span>
                    </div>
                    <h4>Select Service</h4>
                    <p>Browse through our services and pick the one that fits your needs.</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="400">
                <div class="step-card">
                    <div class="step-icon">
                        <i class="fas fa-rocket"></i>
                        <span class="step-badge">4</span>
                    </div>
                    <h4>Receive Results</h4>
                    <p>Place your order and watch your social media presence grow instantly.</p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Testimonials Section -->
<section id="testimonials" class="features-section">
    <div class="container">
        <div class="section-title" data-aos="fade-up">
            <h2>What Our Clients Say</h2>
            <p class="text-muted mt-3">Trusted by thousands of resellers worldwide.</p>
        </div>
        <div class="row">
            <div class="col-lg-4 col-md-6 mb-4" data-aos="zoom-in" data-aos-delay="100">
                <div class="testimonial-card">
                    <div class="quote-icon"><i class="fas fa-quote-right"></i></div>
                    <div class="testimonial-header">
                        <div class="testimonial-avatar-placeholder">
                            <i class="fas fa-user"></i>
                        </div>
                        <div class="testimonial-info">
                            <h5>John Doe</h5>
                            <div class="testimonial-rating">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                        </div>
                    </div>
                    <p class="testimonial-text">"The best SMM panel I've ever used. The delivery is instant and the support is very helpful. Highly recommended!"</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-4" data-aos="zoom-in" data-aos-delay="200">
                <div class="testimonial-card">
                    <div class="quote-icon"><i class="fas fa-quote-right"></i></div>
                    <div class="testimonial-header">
                        <div class="testimonial-avatar-placeholder" style="background: linear-gradient(135deg, #ff9966, #ff5e62);">
                            <i class="fas fa-user-tie"></i>
                        </div>
                        <div class="testimonial-info">
                            <h5>Sarah Smith</h5>
                            <div class="testimonial-rating">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                            </div>
                        </div>
                    </div>
                    <p class="testimonial-text">"Great services at very affordable prices. I've been using this panel for months and I'm very satisfied."</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-4" data-aos="zoom-in" data-aos-delay="300">
                <div class="testimonial-card">
                    <div class="quote-icon"><i class="fas fa-quote-right"></i></div>
                    <div class="testimonial-header">
                        <div class="testimonial-avatar-placeholder" style="background: linear-gradient(135deg, #56ab2f, #a8e063);">
                            <i class="fas fa-user-circle"></i>
                        </div>
                        <div class="testimonial-info">
                            <h5>Michael Brown</h5> 
                            <div class="testimonial-rating">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                        </div>
                    </div>
                    <p class="testimonial-text">"Excellent API integration and fast delivery. My clients are very happy with the results. Thank you!"</p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Services Section -->
<section id="services" class="services-section">
    <div class="container">
        <div class="section-title" data-aos="fade-up">
            <h2>Popular Services</h2>
            <p class="text-muted mt-3">Check out our most popular services loved by thousands of customers.</p>
        </div>
        <?php $popular_services = isset($popular_services) && is_array($popular_services) ? $popular_services : []; ?>
        <div class="row">
            <div class="col-lg-12">
                <div class="table-responsive" data-aos="fade-up" data-aos-delay="200">
                    <table class="table table-hover glass-table">
                        <thead>
                            <tr>
                                <th scope="col" class="text-center">ID</th>
                                <th scope="col">Service Name</th>
                                <th scope="col" class="text-center">Rate per 1000</th>
                                <th scope="col" class="text-center">Min / Max</th>
                                <th scope="col" class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($popular_services)) { ?>
                                <?php foreach ($popular_services as $service) { ?>
                                    <tr>
                                        <th scope="row" class="text-center"><?=esc($service['id'])?></th>
                                        <td class="sp24-service-name">
                                            <a href="<?=cn('service-details?service=' . $service['id'])?>">
                                                <?=esc($service['name'])?>
                                            </a>
                                        </td>
                                        <td class="text-center"><?=show_price_format($service['price'], true)?></td>
                                        <td class="text-center"><?=esc($service['min'])?> / <?=esc($service['max'])?></td>
                                        <td class="text-center">
                                            <div class="sp24-service-table-actions">
                                                <a href="<?=cn('service-details?service=' . $service['id'])?>" class="btn btn-service-outline">Details</a>
                                                <a href="<?=cn((session('uid') ? 'new_order?service=' : 'auth/signup?service=') . $service['id'])?>" class="btn btn-service-buy">Buy Now</a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php } ?>
                            <?php } else { ?>
                                <tr>
                                    <td colspan="5" class="text-center sp24-service-table-empty">No services available right now.</td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                <div class="text-center mt-4" data-aos="fade-up" data-aos-delay="300">
                    <a href="<?=cn('service-details')?>" class="btn btn-signup">View All Services</a>
                    <p class="sp24-service-preview-note mt-3 mb-0">Browse the full service details page for live descriptions, limits, and direct buy buttons.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Blog Section -->
<section id="blog" class="blog-section">
    <div class="container">
        <div class="section-title" data-aos="fade-up">
            <h2>Latest News</h2>
            <p class="text-muted mt-3">Read our latest blog posts, news, and tips.</p>
        </div>
        <div class="row">
            <?php if (!empty($latest_posts)) { ?>
                <?php foreach ($latest_posts as $post) { 
                    $post_link = cn('blog/' . $post['url_slug']);
                    $post_title = truncate_string(strip_tags($post['name']), 69);
                    $post_content = truncate_string(strip_tag_css($post['content'], 'html'), 150);
                    $post_date = date('M d, Y', strtotime($post['released']));
                ?>
                    <div class="col-lg-4 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="100">
                        <div class="glass-card sp24-blog-card h-100 d-flex flex-column">
                            <div class="sp24-blog-img">
                                <a href="<?=$post_link?>">
                                    <img src="<?=esc($post['image'])?>" alt="<?=esc($post['name'])?>" class="img-fluid rounded" style="width: 100%; height: 200px; object-fit: cover;">
                                </a>
                            </div>
                            <div class="sp24-blog-content p-3 d-flex flex-column flex-grow-1">
                                <span class="text-muted small mb-2"><i class="far fa-calendar-alt"></i> <?=$post_date?></span>
                                 <h5 class="mb-3"><a href="<?=$post_link?>" class="text-white"><?=$post_title?></a></h5>
                                 <p class="text-muted mb-4 flex-grow-1"><?=$post_content?></p>
                                <a href="<?=$post_link?>" class="btn btn-signup">Read More</a>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            <?php } else { ?>
                <div class="col-12 text-center text-muted">
                    <p>No blog posts available at the moment.</p>
                </div>
            <?php } ?>
        </div>
        <div class="text-center mt-4" data-aos="fade-up">
            <a href="<?=cn('blog')?>" class="btn btn-signup">View All Posts</a>
        </div>
    </div>
</section>

<!-- Contact Section -->
<section id="contact" class="contact-section">
    <div class="container">
        <div class="section-title" data-aos="fade-up">
            <h2>Contact Us</h2>
            <p class="text-muted mt-3">Have questions? We're here to help.</p>
        </div>
        <div class="row">
            <div class="col-lg-5 mb-4 mb-lg-0" data-aos="fade-right" data-aos-delay="200">
                <div class="glass-card contact-info-card">
                    <h4 class="mb-4">Get in Touch</h4>
                    <p class="mb-4 text-muted">Whether you have a question about our services, pricing, or anything else, our team is ready to answer all your questions.</p>
                    <div class="contact-item d-flex align-items-center mb-4">
                        <div class="feature-icon">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div>
                            <h6 class="mb-1">Email Us</h6>
                            <p class="text-muted mb-0">support@smmglory.com</p>
                        </div>
                    </div>
                    
                    <div class="contact-item d-flex align-items-center mb-4">
                        <div class="feature-icon">
                            <i class="fab fa-whatsapp"></i>
                        </div>
                        <div>
                            <h6 class="mb-1">WhatsApp</h6>
                            <p class="text-muted mb-0">+1 234 567 8900</p>
                        </div>
                    </div>
                    <div class="contact-item d-flex align-items-center">
                        <div class="feature-icon">
                            <i class="fab fa-telegram"></i>
                        </div>
                        <div>
                            <h6 class="mb-1">Telegram</h6>
                           
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-7" data-aos="fade-left" data-aos-delay="400">
                <div class="contact-form glass-card">
                    <form class="actionFormWithoutToast" action="<?=cn('client/contact')?>" method="POST">
                        <div class="row">
                            <div class="col-md-6">
                                <input type="text" name="name" class="form-control" placeholder="Your Name" required>
                            </div>
                            <div class="col-md-6">
                                <input type="email" name="email" class="form-control" placeholder="Your Email" required>
                            </div>
                        </div>
                        <input type="text" name="subject" class="form-control" placeholder="Subject" required>
                        <textarea name="message" class="form-control" rows="5" placeholder="Message" required></textarea>
                        <div class="alert-message-reponse mb-3"></div>
                        <button type="submit" class="btn btn-primary btn-submit">Send Message</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<?php 
  include_once 'blocks/footer.blade.php';
  include_once 'blocks/script.blade.php';
?>
