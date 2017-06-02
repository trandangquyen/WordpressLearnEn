<?php
/** Variables **/
$output = '';
$title = '';
$descr = '';

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

/** Styles **/
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );

// Box styles
$action_box_classes = '';

$action_box_inline_styles = array(
  'text-align:' . esc_attr( $text_alignment )
);

$action_box_inline_style = smarty_element_style( $action_box_inline_styles );

// Title styles
$title_inline_styles = array(
    'font-size:' . esc_attr( $title_font_size ),
    'color:' . esc_attr( $title_color )
);

if( $title_color === 'custom' && !empty( $title_color_custom ) ) {
    $title_inline_styles[] = 'color:' . $title_color_custom;
}

$title_inline_style = smarty_element_style( $title_inline_styles );

// Icon styles
$icon_inline_styles = array(
    'font-size:' . esc_attr( $icon_font_size ),
    'color:' . esc_attr( $icon_color )
);

if( $icon_color === 'custom' && !empty( $icon_color_custom ) ) {
    $icon_inline_styles[] = 'color:' . $icon_color_custom;
}

$icon_inline_style = smarty_element_style( $icon_inline_styles );

// Description styles
$description_inline_styles = array(
    'font-size:' . esc_attr( $description_font_size ),
    'color:' . esc_attr( $description_color )
);

if( $description_color === 'custom' && !empty( $description_color_custom ) ) {
    $description_inline_styles[] = 'color:' . $description_color_custom;
}

$description_inline_style = smarty_element_style( $description_inline_styles );

// Content styles
$action_box__content_styles = array(
    'background-color:' . esc_attr( $cta_bg_color )
);

if( $cta_bg_color === 'custom' && !empty( $content_bg_color_custom ) ) {
    $action_box__content_styles[] = 'background-color:' . $content_bg_color_custom;
}

$action_box__content_style = smarty_element_style( $action_box__content_styles );

$action_box__content_caption_styles[] = 'background-color:' . $content_bg_color_caption;
$action_box__content_caption_style = smarty_element_style( $action_box__content_caption_styles );

// Link
$action_box_link = vc_build_link($action_box_link);
?>

<div class="stm-action-box<?php echo esc_attr( $action_box_classes ); ?><?php echo esc_attr( $css_class ); ?>" <?php echo sanitize_text_field( $action_box_inline_style ); ?>>
    <?php if( $style === 'caption' ): ?>
    <figure class="stm-action-box__figure">
        <?php if( !empty( $img_id ) ) : ?>
              <?php
                  $img = wpb_getImageBySize(array(
                      'attach_id' => $img_id,
                      'thumb_size' => '350x250'
                  ));

                  echo wp_kses_post( $img['thumbnail'] );
              ?>
        <?php endif; ?>
        <figcaption class="stm-action-box__figcaption" <?php echo sanitize_text_field( $action_box__content_caption_style ); ?>>
            <?php if( !empty( $title ) ) : ?>
                <div class="stm-action-box__figcaption-title" <?php echo sanitize_text_field( $title_inline_style ); ?>>
                    <?php if( !empty( ${'icon_' . $icon_library} )) : ?>
                        <div class="stm-icon-box__ic-container">
                            <span class="<?php echo esc_attr( ${'icon_' . $icon_library} ) ?>" <?php echo sanitize_text_field( $icon_inline_style ); ?>></span>
                        </div>
                    <?php endif; ?>
                    <span class="stm-action-box__title-text"><?php echo esc_html( $title ); ?></span>
                </div>
            <?php endif; ?>
            <?php if( !empty( $content ) ) : ?>
                <div class="stm-action-box__content-text" <?php echo sanitize_text_field( $description_inline_style ); ?>>
                    <?php echo esc_html( $content ); ?>
                </div>
            <?php endif; ?>
            <?php if( $action_box_link['url'] ) : ?>
                <?php
                if( ! $action_box_link['target'] ) {
                    $action_box_link['target'] = '_self';
                }
                ?>
                <div class="stm-action-box__figcaption-link-title" <?php echo sanitize_text_field( $description_inline_style ); ?>><a href="<?php echo esc_url( $action_box_link['url'] ); ?>" target="<?php echo esc_attr( $action_box_link['target'] ); ?>"><?php echo esc_attr( $action_box_link['title'] ); ?></a></div>
            <?php endif; ?>
        </figcaption>
    </figure>
    <?php elseif( $style === 'box' ): ?>
        <figure class="stm-action-box__figure_box">
            <?php if( !empty( $img_id ) ) : ?>
                <?php if( $action_box_link['url'] ) : ?>
                    <a href="<?php echo esc_url( $action_box_link['url'] ); ?>" <?php echo sanitize_text_field( $title_inline_style ); ?> target="<?php echo esc_attr( $action_box_link['target'] ); ?>">
                <?php endif; ?>
                    <span class="stm-action-box__thumbnail">
                        <?php
                        $img = wpb_getImageBySize(array(
                            'attach_id' => $img_id,
                            'thumb_size' => '390x390'
                        ));

                        echo wp_kses_post( $img['thumbnail'] );
                        ?>
                    </span>
                    <?php if( !empty( $title ) ) : ?>
                        <span class="stm-action-box__figcaption-title">
                            <span class="stm-action-box__title-text"><?php echo esc_html( $title ); ?></span>
                        </span>
                    <?php endif; ?>
                    <?php if( $action_box_link['url'] ) : ?>
                </a>
                <?php endif; ?>
            <?php endif; ?>
            <?php if( !empty( $content ) ) : ?>
                <figcaption class="stm-action-box__figcaption_box" <?php echo sanitize_text_field( $action_box__content_style ); ?>>
                    <div class="stm-action-box__content-text" <?php echo sanitize_text_field( $description_inline_style ); ?>>
                        <?php echo esc_html( $content ); ?>
                    </div>
                </figcaption>
            <?php endif; ?>
            <?php if( $action_box_link['url'] ) : ?>
                <?php
                if( ! $action_box_link['target'] ) {
                    $action_box_link['target'] = '_self';
                }
                ?>
            <?php endif; ?>
        </figure>
    <?php endif; ?>
</div>
