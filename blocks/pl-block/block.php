<?php
/**
 * Register ACF block: Product Block
 */

if (!function_exists('acf_register_block_type')) {
    return;
}

acf_register_block_type([
    'name'              => 'pl_block',
    'title'             => __('Product List Block'),
    'description'       => __('A product block with rank, icon, name, description, pricing, coupons, and offer buttons.'),
    'render_template'   => GT_ACF_BLOCKS_DIR . 'blocks/pl-block/pl-block.php',
    'category'          => 'common',
    'icon'              => 'products',
    'keywords'          => ['product', 'offer', 'pricing', 'coupon'],
    'enqueue_style'     => GT_ACF_BLOCKS_URL . 'blocks/pl-block/pl-block.css',
    'supports'          => [
        'align'  => true,
        'mode'   => true,
        'anchor' => true,
        'multiple' => true,
        'jsx' => true,
    ],
]);