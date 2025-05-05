<?php
/**
 * Register ACF block: Product Cards
 */

if (!function_exists('acf_register_block_type')) {
    return;
}

acf_register_block_type([
    'name'              => 'product_cards',
    'title'             => __('Product Cards'),
    'description'       => __('A customizable product card block.'),
    'render_template'   => GT_ACF_BLOCKS_DIR . 'blocks/product-cards/product-cards.php',
    'category'          => 'formatting',
    'icon'              => 'grid-view',
    'keywords'          => ['product', 'card', 'custom'],
    'enqueue_style'     => GT_ACF_BLOCKS_URL . 'blocks/product-cards/product-cards.css',
    'supports'          => ['align' => true,]
]);