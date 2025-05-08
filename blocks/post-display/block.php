<?php
/**
 * Register ACF block: Post Display
 */

if (!function_exists('acf_register_block_type')) {
    return;
}

acf_register_block_type([
    'name'              => 'post-display',
    'title'             => __('Post Display'),
    'description'       => __('Display selected posts in various layouts.'),
    'render_template'   => GT_ACF_BLOCKS_DIR . 'blocks/post-display/post-display.php',
    'category'          => 'common',
    'icon'              => 'admin-post',
    'keywords'          => ['post', 'article', 'display', 'grid'],
    'enqueue_style'     => GT_ACF_BLOCKS_URL . 'blocks/post-display/post-display.css',
    'supports'          => [
        'align'  => true,
        'mode'   => true,
        'anchor' => true,
    ],
]);