<?php
/**
 * Register ACF block: Compare Block
 */

if (!function_exists('acf_register_block_type')) {
    return;
}

acf_register_block_type([
    'name'              => 'compare',
    'title'             => __('Compare Block'),
    'description'       => __('A customizable compare card block.'),
    'render_template'   => GT_ACF_BLOCKS_DIR . 'blocks/compare-block/compare-block.php',
    'category'          => 'formatting',
    'icon'              => 'grid-view',
    'keywords'          => ['compare', 'vs', 'custom'],
    'enqueue_style'     => GT_ACF_BLOCKS_URL . 'blocks/compare-block/compare-block.css',
    'supports'          => ['align' => true,]
]);