<?php
/**
 * Register ACF block: Coupon Code
 */

if (!function_exists('acf_register_block_type')) {
    return;
}

acf_register_block_type([
    'name'              => 'cb-coupon-code',
    'title'             => __('Coupon Code'),
    'description'       => __('A coupon code block with offer details, copyable coupon code, and discount activation button.'),
    'render_template'   => GT_ACF_BLOCKS_DIR . 'blocks/coupon-code/coupon-code.php',
    'category'          => 'common',
    'icon'              => 'tickets',
    'keywords'          => ['coupon', 'discount', 'offer'],
    'enqueue_style'     => GT_ACF_BLOCKS_URL . 'blocks/coupon-code/coupon-code.css?v=06042025',
    'supports'          => [
        'align'  => true,
        'mode'   => true,
        'anchor' => true,
    ],
]);