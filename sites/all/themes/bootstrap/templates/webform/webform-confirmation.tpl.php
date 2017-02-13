<?php

/**
 * @file
 * Customize confirmation screen after successful submission.
 *
 * This file may be renamed "webform-confirmation-[nid].tpl.php" to target a
 * specific webform e-mail on your site. Or you can leave it
 * "webform-confirmation.tpl.php" to affect all webform confirmations on your
 * site.
 *
 * Available variables:
 * - $node: The node object for this webform.
 * - $progressbar: The progress bar 100% filled (if configured). This may not
 *   print out anything if a progress bar is not enabled for this node.
 * - $confirmation_message: The confirmation message input by the webform
 *   author.
 * - $sid: The unique submission ID of this submission.
 * - $url: The URL of the form (or for in-block confirmations, the same page).
 */
?>

<?php
if (arg(1) == 21) {
    $language = $GLOBALS['language']->language;
    module_load_include('inc', 'webform', 'includes/webform.submissions');
    $sid = (int)$_GET['sid'];
    $submission = webform_get_submissions(array('sid' => $sid));
    $submission = array_shift($submission);
    print_r($submission->data);
    $data = json_decode($submission->data[2][0], true);
    $products = array();
    if (isset($data)) {
        foreach ($data as $item) {
            if (isset($item['nid'])) {
                $item['product'] = node_load($item['nid']);
                $products[] = $item;
            }
        }
    }

    ?>
    <div id="cart-done">
        <div class="product-cart-view add_tocart_popup">
            <div class="product-cart-popup">
                <div class="cart-icon"><img class="img_scroll"
                                            src="<?php print '/sites/all/themes/bootstrap/images/icon_poup_cart.png'; ?>">
                </div>
                <div class="product-cart-popup-title comfirm">
                    <span><?php echo t('Cảm ơn quý khách đã đặt dịch vụ tại Hoàng Việt Travel') ?></span>
                </div>
                <div class="info"><?php echo t('Quý khách vui lòng đến trụ sở Hoàng việt Travel hoàn tất giao dịch ') ?></div>
                <div class="result_title"><?php echo t('Hãy hoàn tất thanh toán tại Hoàng Việt Travel') ?></div>
                <ul class="product-cart-lists">
                    <?php
                    foreach ($products as $item) {
                        $node = $item['product'];
                        ?>
                        <li class="product-title">
                           <span><?php echo $node->title ?> (<?php echo number_format($node->field_price['und'][0]['value'])?>đ)</span>
                            <span class="quantity"> x <?php echo $item['quantity'] ?> (<?php echo number_format($node->field_price['und'][0]['value']*$item['quantity'])?>)</span>
                        </li>
                    <?php
                    }

                    ?>
                    <?php
                    foreach ($options as $item) {
                        ?>
                        <li class="product-title">
                            <?php echo $item['category_product'][$language]['name'] ?> <span
                                class="quantity"> x <?php echo $item['quantity'] ?></span>
                        </li>
                    <?php
                    }

                    ?>
                </ul>
            </div>
        </div>
    </div>
<?php
}
?>



