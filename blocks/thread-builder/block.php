<?php
/**
 * Register ACF block: Thread Builder
 */

if (!function_exists('acf_register_block_type')) {
    return;
}

// Register the block
acf_register_block_type([
    'name'              => 'thread-builder',
    'title'             => __('Thread Builder'),
    'description'       => __('Create Twitter X-style conversation threads.'),
    'render_template'   => GT_ACF_BLOCKS_DIR . 'blocks/thread-builder/thread-builder.php',
    'category'          => 'formatting',
    'icon'              => 'format-chat',
    'keywords'          => ['twitter', 'thread', 'conversation', 'social', 'tweet'],
    'enqueue_style'     => GT_ACF_BLOCKS_URL . 'blocks/thread-builder/thread-builder.css',
    'supports'          => [
        'align'  => true,
        'mode'   => true,
        'anchor' => true,
    ],
]);
