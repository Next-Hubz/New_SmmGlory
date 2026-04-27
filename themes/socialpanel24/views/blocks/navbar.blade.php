<div id="star-container"></div> <!-- Container for JS stars -->
<nav class="navbar navbar-expand-lg navbar-custom fixed-top">
    <div class="container">
        <a class="navbar-brand" href="<?php echo cn(); ?>">
            <img src="<?=get_option('website_logo', BASE."themes/socialpanel24/assets/images/logo.svg")?>" alt="SmartPanel">
        </a> 
        
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarsExampleDefault">
            <ul class="navbar-nav ml-auto align-items-center">
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo cn()?>"><?= lang('Home') ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo cn('blog'); ?>">Blog</a>    
                </li> 
                <li class="nav-item">
                   <a class="nav-link" href="<?php echo cn(); ?>#services">Services</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo cn(); ?>#contact">Contact Us</a>
                </li>
                <?php if (session('uid')) { ?>
                <li class="nav-item">
                    <a class="nav-link" href="<?=cn('statistics')?>">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?=cn('new_order')?>">New Order</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?=cn('affiliates')?>">Affiliates</a>
                </li>
                <li class="nav-item ml-3">
                    <a class="btn btn-signup" href="<?=cn('auth/logout')?>">Logout</a>
                </li>
                <?php } else { ?>
                <li class="nav-item">
                    <a class="nav-link" href="<?=cn('auth/login')?>">LOGIN</a>
                </li>
                <li class="nav-item ml-3">
                    <a class="btn btn-signup" href="<?=cn('auth/signup')?>">Sign Up</a>
                </li>
                <?php } ?>
            </ul>
        </div>
    </div>
</nav>
