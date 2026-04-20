<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <!-- <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests"> -->
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta name="description"
        content="<?= get_option('website_desc', 'SocialPanel24 is the best SMM Reseller Panel services provider to grow your Business. We are the Cheap SMM Panel services provider who can increase your audience and social network with real users.') ?>">
    <meta name="keywords"
        content="<?= get_option('website_keywords', 'smm panel, SocialPanel24, smm reseller panel, smm provider panel, reseller panel, instagram panel, resellerpanel, social media reseller panel, smmpanel, panelsmm, smm, panel, socialmedia, instagram reseller panel') ?>">
    <title><?= get_option('website_title', 'Best SMM Panel services provider to grow your Business - SocialPanel24') ?>
    </title>
    <link rel="shortcut icon" type="image/x-icon"
        href="<?= get_option('website_favicon', BASE . 'assets/images/favicon.png') ?>">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="HandheldFriendly" content="True">
    <meta name="MobileOptimized" content="320">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,400i,700&display=swap&subset=latin-ext"
        rel="stylesheet">
    <script src="<?php echo BASE; ?>assets/js/vendors/jquery-3.2.1.min.js"></script>
    <link href="<?php echo BASE; ?>themes/socialpanel24/assets/css/bootstrap.css" rel="stylesheet">
    <link href="<?php echo BASE; ?>themes/socialpanel24/assets/css/fontawesome-all.css" rel="stylesheet">
    <link href="<?php echo BASE; ?>themes/socialpanel24/assets/css/swiper.css" rel="stylesheet">
    <link href="<?php echo BASE; ?>themes/socialpanel24/assets/css/socialpanel24.css" rel="stylesheet">
    <link href="<?php echo BASE; ?>themes/socialpanel24/assets/css/styles.css" rel="stylesheet">
    <!-- AOS -->
    <link rel="stylesheet" href="<?php echo BASE; ?>assets/plugins/aos/dist/aos.css" />
    <script type="text/javascript">
        var token = '<?= $this->security->get_csrf_hash() ?>',
            PATH = '<?php echo PATH; ?>',
            BASE = '<?php echo BASE; ?>';
        var deleteItem = '<?php echo lang('Are_you_sure_you_want_to_delete_this_item'); ?>';
        var deleteItems = '<?php echo lang('Are_you_sure_you_want_to_delete_all_items'); ?>';
    </script>
    <?php echo htmlspecialchars_decode(get_option('embed_head_javascript', ''), ENT_QUOTES); ?>
</head>

<body data-spy="scroll" data-target=".fixed-top">
