<?php
/**
 * Register ACF block: Product Box
 */

if (!function_exists('acf_register_block_type')) {
    return;
}

acf_register_block_type([
    'name'              => 'product-box',
    'title'             => __('Product Box'),
    'description'       => __('A product box with image, title, rating, and description.'),
    'render_template'   => GT_ACF_BLOCKS_DIR . 'blocks/product-box/product-box.php',
    'category'          => 'common',
    'icon'              => 'cart',
    'keywords'          => ['product', 'box', 'rating'],
    'enqueue_style'     => GT_ACF_BLOCKS_URL . 'blocks/product-box/product-box.css',
    'supports'          => [
        'align'  => true,
        'mode'   => true,
        'anchor' => true,
    ],
]);