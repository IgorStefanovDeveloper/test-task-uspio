<?php
ob_start();
?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Main Content</h1>
            <div class="form-group">
                <input type="text" class="form-control" name="js-map" value="" placeholder="Enter address">
                <ul class="suggestions-list list-group">

                </ul>
            </div>
            <img src="<?= $staticMapUrl ?>" alt="Map" class="img-fluid">
        </div>
    </div>
    <?php if (!empty($mapHistoryList)) { ?>
        <div class="row mt-4">
            <div class="col-md-12">
                <h2>Map History</h2>
                <ul class="list-group map-history">
                    <?php foreach ($mapHistoryList as $item) { ?>
                        <li class="list-group-item"><?= $item->address ?></li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    <?php } ?>
</div>
<?php

$content = ob_get_contents();

ob_end_clean();

include_once($_SERVER['DOCUMENT_ROOT'] . getenv('THEME') . 'layout.php');
?>
