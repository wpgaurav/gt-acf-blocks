<?php
// Accordion Block
acf_register_block_type([
    'name'              => 'accordion',
    'title'             => __('Accordion'),
    'description'       => __('A customizable accordion block with FAQ schema support.'),
    'render_template'   => GT_ACF_BLOCKS_DIR . 'blocks/accordion-block/accordion-block.php',
    'category'          => 'common',
    'icon'              => 'list-view',
    'keywords'          => ['accordion', 'faq', 'toggle'],
    'enqueue_style'     => GT_ACF_BLOCKS_URL . 'blocks/accordion-block/accordion.css',
    'supports'          => [
        'align'  => true,
        'mode'   => true,
        'jsx' => true,
    ],
]);