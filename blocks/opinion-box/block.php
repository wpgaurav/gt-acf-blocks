<?php
/**
 * Register ACF block: Opinion Box
 */

if (!function_exists('acf_register_block_type')) {
    return;
}

acf_register_block_type([
    'name'              => 'opinion-box',
    'title'             => __('Opinion Box'),
    'description'       => __('A custom opinion box block for sharing thoughts'),
    'render_template'   => GT_ACF_BLOCKS_DIR . 'blocks/opinion-box/opinion-box.php',
    'category'          => 'common',
    'icon'              => 'admin-comments',
    'keywords'          => ['opinion', 'box', 'feedback'],
    'enqueue_style'     => GT_ACF_BLOCKS_URL . 'blocks/opinion-box/opinion-box.css',
    'supports'          => [
        'align'  => true,
        'mode'   => true,
        'anchor' => true,
        'jsx'    => true,
    ],
]);