<?php
/* - Includes
 *
 * Path
 *
 * 1. Setup
 * 2. Scripts & Styles
 * 3. TGM
 * 4. Custom Post Type
 * 5. Customizer
 * 6. Custom
 * 7. Visual Composer
 * 8. Widgets
 * 9. Print Styles
 *
*/

// Product Registration
if(is_admin()) {
    require_once(get_template_directory() . '/admin/admin.php');
}

// Path
$inc_path = get_template_directory() . '/inc';

// 1. Setup
require_once $inc_path . '/setup.php';

// 2. Scripts & Styles
require_once $inc_path . '/scripts_styles.php';

// 3. TGM
require_once $inc_path . '/tgm/tgm-plugin-registration.php';

// 4. Custom Post Type
if( class_exists('STM_PostType') ) {
	require_once $inc_path . '/custom-post-types/'.smarty_get_layout_mode().'/custom-post-types.php';
}

// 5. Customizer
require_once $inc_path . '/customizer/'.smarty_get_layout_mode().'/customizer.class.php';

// 6. Custom
require_once $inc_path . '/custom.php';

// 7. Visual Composer
if( defined( 'WPB_VC_VERSION' ) ) {
	require_once $inc_path . '/visual-composer/'.smarty_get_layout_mode().'/visual-composer.php';
    $dir = get_template_directory() . '/vc_templates/'.smarty_get_layout_mode();
    vc_set_shortcodes_templates_dir( $dir );
}

// 8. Widgets
require_once $inc_path . '/widgets/widgets.php';

// 9. Print Styles
require_once $inc_path . '/print_styles.php';