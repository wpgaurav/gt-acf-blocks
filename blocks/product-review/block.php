<?php
/**
 * Register ACF block: Product Review
 */

if (!function_exists('acf_register_block_type')) {
    return;
}

acf_register_block_type([
    'name'              => 'product-review',
    'title'             => __('Product Review'),
    'description'       => __('A custom product review block with structured data'),
    'render_template'   => GT_ACF_BLOCKS_DIR . 'blocks/product-review/product-review.php',
    'category'          => 'common',
    'icon'              => 'admin-comments',
    'keywords'          => ['review', 'product', 'rating'],
    'enqueue_style'     => GT_ACF_BLOCKS_URL . 'blocks/product-review/product-review.css',
    'supports'          => [
        'align'  => true,
        'mode'   => true,
        'anchor' => true,
    ],
]);