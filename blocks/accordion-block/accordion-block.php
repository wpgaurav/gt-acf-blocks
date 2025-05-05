<?php
/**
 * Accordion Block Template.
 *
 * @param array       $block      Block settings and attributes.
 * @param string      $content    The block inner HTML (empty).
 * @param bool        $is_preview True during AJAX preview.
 * @param int|string  $post_id    The post ID.
 */

// Global array for footer scripts.
global $gt_accordion_ids;
if ( ! isset( $gt_accordion_ids ) ) {
    $gt_accordion_ids = array();
    if ( ! function_exists( 'output_gt_accordion_scripts' ) ) {
        function output_gt_accordion_scripts() {
            global $gt_accordion_ids;
            if ( ! empty( $gt_accordion_ids ) ) {
                echo "<script>(function(){ var ids=" . json_encode( $gt_accordion_ids ) . "; ids.forEach(function(id){ var accordion=document.getElementById(id); if(!accordion)return; var groups=accordion.getElementsByClassName('gt-accordion-group'); Array.prototype.forEach.call(groups,function(group){ var title=group.getElementsByClassName('gt-accordion-title')[0]; var content=group.getElementsByClassName('gt-accordion-content')[0]; title.setAttribute('role','button'); title.setAttribute('tabindex','0'); var isActive=!content.hidden; title.setAttribute('aria-expanded', String(isActive)); title.addEventListener('click', function(){ var expanded=this.getAttribute('aria-expanded')==='true'; this.setAttribute('aria-expanded', String(!expanded)); content.hidden=expanded; group.classList.toggle('active', !expanded); }); title.addEventListener('keydown', function(e){ if(e.key==='Enter'||e.key===' '){ e.preventDefault(); this.click(); }}); }); });})();</script>\n";
            }
        }
        add_action( 'wp_footer', 'output_gt_accordion_scripts', 999 );
    }
}

// Unique ID for this instance.
$unique_id = 'gt-accordion-' . uniqid();
$gt_accordion_ids[] = $unique_id;

$groups            = get_field( 'acf_accord_groups' );
$enable_faq_schema = (bool) get_field( 'acf_accord_enable_faq_schema' );
$custom_class      = get_field( 'acf_accordion_class' ) ? ' ' . esc_attr( get_field( 'acf_accordion_class' ) ) : '';
$inline_style      = get_field( 'acf_accordion_inline' ) ? ' style="' . esc_attr( get_field( 'acf_accordion_inline' ) ) . '"' : '';
?>

<div id="<?php echo esc_attr( $unique_id ); ?>" class="gt-accordion<?php echo $custom_class; ?>"<?php echo $inline_style; ?>>
    <?php if ( $groups && is_array( $groups ) ) : $index = 1; ?>
        <?php foreach ( $groups as $group ) :
            $is_active    = ( $index === 1 );
            $aria_expanded = $is_active ? 'true' : 'false';
            $active_class = $is_active ? ' active' : '';
            $title_id     = esc_attr( $unique_id . '_title_' . $index );
            $panel_id     = esc_attr( $unique_id . '_panel_' . $index );
        ?>
            <div id="<?php echo esc_attr( $unique_id . '_group_' . $index ); ?>" class="gt-accordion-group<?php echo $active_class; ?>">
                <div class="gt-accordion-title"
                     id="<?php echo $title_id; ?>"
                     role="button"
                     tabindex="0"
                     aria-expanded="<?php echo esc_attr( $aria_expanded ); ?>"
                     aria-controls="<?php echo $panel_id; ?>"
                     data-gt-accordion-index="<?php echo esc_attr( $index ); ?>">
                    <?php echo do_shortcode( $group['acf_accord_group_title'] ); ?>
                </div>
                <div id="<?php echo $panel_id; ?>"
                     class="gt-accordion-content"
                     role="region"
                     aria-labelledby="<?php echo $title_id; ?>"
                     <?php echo $is_active ? '' : 'hidden'; ?> >
                    <?php echo wpautop( do_shortcode( $group['acf_accord_group_content'] ) ); ?>
                </div>
            </div>
        <?php $index++; endforeach; ?>
    <?php elseif ( $is_preview ) : ?>
        <p><em>No accordion groups added. Please add some groups.</em></p>
    <?php endif; ?>
</div>

<?php if ( $enable_faq_schema ) : ?>
    <?php
    $faq_schema = array(
        "@context"   => "https://schema.org",
        "@type"      => "FAQPage",
        "mainEntity" => array(),
    );

    if ( $groups && is_array( $groups ) ) {
        foreach ( $groups as $group ) {
            $faq_schema['mainEntity'][] = array(
                "@type"          => "Question",
                "name"           => do_shortcode( $group['acf_accord_group_title'] ),
                "acceptedAnswer" => array(
                    "@type" => "Answer",
                    "text"  => do_shortcode( $group['acf_accord_group_content'] ),
                ),
            );
        }
    }
    ?>
    <script type="application/ld+json">
        <?php echo wp_json_encode( $faq_schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE ); ?>
    </script>
<?php endif; ?>
