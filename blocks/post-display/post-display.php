<?php
/**
 * Post Display Block Template.
 *
 * @var array $block The block settings and attributes.
 */

// Get ACF fields
$selected_posts = get_field('pd_selected_posts');
$layout = get_field('pd_layout') ?: 'text_links';
$columns = get_field('pd_columns') ?: 2;
$show_excerpt = get_field('pd_show_excerpt') ?: false;
$show_date = get_field('pd_show_date') ?: false;
$show_author = get_field('pd_show_author') ?: false;
$title_tag = get_field('pd_title_tag') ?: 'h3';
$custom_class = get_field('pd_custom_class') ?: '';

// Block unique ID
$block_id = 'post-display-' . $block['id'];

// Begin output
if (!$selected_posts) {
    if (is_admin()) {
        echo '<p>Please select at least one post.</p>';
    }
    return;
}

// CSS classes based on layout
$container_classes = [
    'post-display',
    'layout-' . $layout,
];

if ($layout === 'grid') {
    $container_classes[] = 'grid-columns-' . $columns;
}

if ($custom_class) {
    $container_classes[] = $custom_class;
}

$container_class = implode(' ', $container_classes);
?>

<div id="<?php echo esc_attr($block_id); ?>" class="<?php echo esc_attr($container_class); ?>">
    <?php if ($layout === 'text_links'): ?>
        
        <ul class="post-display-list">
            <?php foreach ($selected_posts as $post): ?>
                <li class="post-item">
                    <a href="<?php echo esc_url(get_permalink($post->ID)); ?>" class="post-link">
                        <?php echo esc_html(get_the_title($post->ID)); ?>
                    </a>
                    
                    <?php if ($show_date): ?>
                        <span class="post-date">
                            <?php echo get_the_date('', $post->ID); ?>
                        </span>
                    <?php endif; ?>
                </li>
            <?php endforeach; ?>
        </ul>
        
    <?php elseif ($layout === 'thumbnail'): ?>
    
        <div class="post-display-thumbnail">
            <?php foreach ($selected_posts as $post): ?>
                <div class="post-item">
                    <div class="post-thumbnail">
                        <?php if (has_post_thumbnail($post->ID)): ?>
                            <a href="<?php echo esc_url(get_permalink($post->ID)); ?>">
                                <?php echo get_the_post_thumbnail($post->ID, 'thumbnail', ['class' => 'post-thumb']); ?>
                            </a>
                        <?php endif; ?>
                    </div>
                    
                    <div class="post-content">
                        <<?php echo esc_attr($title_tag); ?> class="post-title">
                            <a href="<?php echo esc_url(get_permalink($post->ID)); ?>">
                                <?php echo esc_html(get_the_title($post->ID)); ?>
                            </a>
                        </<?php echo esc_attr($title_tag); ?>>
                        
                        <?php if ($show_date || $show_author): ?>
                            <div class="post-meta">
                                <?php if ($show_date): ?>
                                    <span class="post-date">
                                        <?php echo get_the_date('', $post->ID); ?>
                                    </span>
                                <?php endif; ?>
                                
                                <?php if ($show_author): ?>
                                    <span class="post-author">
                                        by <?php echo get_the_author_meta('display_name', $post->post_author); ?>
                                    </span>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                        
                        <?php if ($show_excerpt): ?>
                            <div class="post-excerpt">
                                <?php echo get_the_excerpt($post->ID); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        
    <?php elseif ($layout === 'grid'): ?>
    
        <div class="post-display-grid">
            <?php foreach ($selected_posts as $post): ?>
                <div class="grid-item">
                    <?php if (has_post_thumbnail($post->ID)): ?>
                        <div class="post-thumbnail">
                            <a href="<?php echo esc_url(get_permalink($post->ID)); ?>">
                                <?php echo get_the_post_thumbnail($post->ID, 'medium', ['class' => 'post-thumb']); ?>
                            </a>
                        </div>
                    <?php endif; ?>
                    
                    <<?php echo esc_attr($title_tag); ?> class="post-title">
                        <a href="<?php echo esc_url(get_permalink($post->ID)); ?>">
                            <?php echo esc_html(get_the_title($post->ID)); ?>
                        </a>
                    </<?php echo esc_attr($title_tag); ?>>
                    
                    <?php if ($show_date || $show_author): ?>
                        <div class="post-meta">
                            <?php if ($show_date): ?>
                                <span class="post-date">
                                    <?php echo get_the_date('', $post->ID); ?>
                                </span>
                            <?php endif; ?>
                            
                            <?php if ($show_author): ?>
                                <span class="post-author">
                                    by <?php echo get_the_author_meta('display_name', $post->post_author); ?>
                                </span>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                    
                    <?php if ($show_excerpt): ?>
                        <div class="post-excerpt">
                            <?php echo get_the_excerpt($post->ID); ?>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
        
    <?php endif; ?>
</div>