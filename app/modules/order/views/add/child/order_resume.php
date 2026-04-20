
<style>
    .order_resume {
        max-width: 592px;
        width: 100%;
        border: 1px solid #eaecf0;
        border-radius: 10px;
        padding: 25px;
        background: #fafaff;
    }
    .order_resume .service-title {
        margin-left: -10px;
    }

    .order_resume .service-name {
        font-weight: 700;
    }

    .order_resume .service-id-title { 
        font-weight: 600;
        font-size: 14px;
    }

    .order_resume .service-details {
        white-space: pre-line;
        word-break: break-word;
        line-height: 21px;
        border: 1px solid #eaecf0;
        border-radius: 10px;
        padding: 10px;
        min-height: 300px;
    }

    body.theme-dark .order_resume { 
        background: #0b1739;
        border: 1px solid #0b1739;
    }
    
    body.theme-dark .order_resume .service-details { 
        border: 1px solid #2f2f2f;
    }

</style>

<div class="col-md-5 order_resume" id="order_resume">
    <div class="service-title m-b-20">
        <div class="d-flex align-items-center">
            <img src="<?php echo BASE; ?>/assets/images/media-icon/instagram.png" alt="Instagram" class="mr-3 service-media-logo" alt="Icon" width="55" height="55">
            <div>
                <h5 class="mb-1 badge bg-indigo service-id-title">ID: <span class="service-id-val">687</span></h5>
                <p class="mb-0 fs-16 service-name">[𝐒𝐮𝐩𝐞𝐫 𝐂𝐡𝐞𝐚𝐩] Twitter Followers [5K] [5K/D - R30] [Instant - No Drop]</p>
            </div>
        </div>
    </div>

    <div class="row m-b-30">
        <div class="col-md-12 m-b-20">
            <div class="d-flex align-items-center">
                <img src="<?php echo BASE; ?>assets/images/new-order/good-quality-64.png" class="rounded-circle mr-3" alt="Icon" width="40" height="40">
                <div>
                    <h5 class="mb-1 text-muted"><?= lang('rate_per_1000') ?></h5>
                    <p class="mb-0 fs-18 text-info">$<span class="service-price">3.8836</span></p>
                </div>
            </div>
        </div>
        <?php if ((get_option("enable_average_time", 0) == 1)) : ?>
            <div class="col-md-12 m-b-20">
                <div class="d-flex align-items-center">
                    <img src="<?php echo BASE; ?>assets/images/new-order/delivery-time.png" class="rounded-circle mr-3" alt="Icon" width="40" height="40">
                    <div>
                        <h5 class="mb-1"><?= lang('Average_time') ?> 
                            <?= render_tooltip_popover_html(lang("avegrage_time_details"), 'Tooltip', 'top'); ?>
                        </h5>
                        <p class="mb-0 fs-16"><span class="service-avg-time text-info">-:-</span></p>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        <div class="col-md-6">
            <div class="d-flex align-items-center">
                <img src="<?php echo BASE; ?>assets/images/new-order/min.png" class="rounded-circle mr-3" alt="Icon" width="40" height="40">
                <div>
                    <h5 class="mb-1 text-muted"><?= lang('min') ?></h5>
                    <p class="mb-0 fs-16 service-min-val badge badge-default">1000</p>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="d-flex align-items-center">
                <img src="<?php echo BASE; ?>assets/images/new-order/max.png" class="rounded-circle mr-3" alt="Icon" width="40" height="40">
                <div>
                    <h5 class="mb-1 text-muted"><?= lang('max') ?></h5>
                    <p class="mb-0 fs-16 service-max-val badge badge-default">1000000</p>
                </div>
            </div>
        </div>
    </div>  
        
    <div class="description">
        <h5 class="mb-1 text-muted"><?=lang("Description")?></h5>
        <div class="service-details">
            ✅Worldwide Likes
            <br>✅Start time - Instant
            <br>✅Quality - Real
            <br>✅Non Drop - Less drop
            <br>✅No Refill
            <br>
            <br>⚠ Link: Facebook Post /Video/ Photo Link
        </div>
    </div>
</div>