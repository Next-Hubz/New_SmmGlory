<?php include_once dirname(__DIR__) . '/blocks/head.blade.php'; ?>

<?php include_once dirname(__DIR__) . '/blocks/navbar.blade.php'; ?>

<div class="page theme-socialpanel24-user">
    <div class="page-main">
        <div class="my-3 my-md-5">
            <div class="container theme-socialpanel24-general">
                <div class="general-page-shell">
                    <?=$template['body']?>
                </div>
            </div>
        </div>
        <div id="modal-ajax" class="modal fade" tabindex="-1"></div>
    </div>
</div>

<?php include_once dirname(__DIR__) . '/blocks/footer.blade.php'; ?>
<?php include_once dirname(__DIR__) . '/blocks/script.blade.php'; ?>
