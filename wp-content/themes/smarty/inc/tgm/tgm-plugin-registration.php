<?php
/**
 * This file represents an example of the code that themes would use to register
 * the required plugins.
 *
 * It is expected that theme authors would copy and paste this code into their
 * functions.php file, and amend to suit.
 *
 * @see http://tgmpluginactivation.com/configuration/ for detailed documentation.
 *
 * @package    TGM-Plugin-Activation
 * @subpackage Example
 * @version    2.6.1 for parent theme Smarty for publication on ThemeForest
 * @author     Thomas Griffin, Gary Jones, Juliette Reinders Folmer
 * @copyright  Copyright (c) 2011, Thomas Griffin
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       https://github.com/TGMPA/TGM-Plugin-Activation
 */

/**
 * Include the TGM_Plugin_Activation class.
 *
 * Depending on your implementation, you may want to change the include call:
 *
 * Parent Theme:
 * require_once get_template_directory() . '/path/to/class-tgm-plugin-activation.php';
 *
 * Child Theme:
 * require_once get_stylesheet_directory() . '/path/to/class-tgm-plugin-activation.php';
 *
 * Plugin:
 * require_once dirname( __FILE__ ) . '/path/to/class-tgm-plugin-activation.php';
 */
require_once get_template_directory() . '/inc/tgm/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'smarty_register_required_plugins' );
/**
 * Register the required plugins for this theme.
 *
 * In this example, we register five plugins:
 * - one included with the TGMPA library
 * - two from an external source, one from an arbitrary source, one from a GitHub repository
 * - two from the .org repo, where one demonstrates the use of the `is_callable` argument
 *
 * The variable passed to tgmpa_register_plugins() should be an array of plugin
 * arrays.
 *
 * This function is hooked into tgmpa_init, which is fired within the
 * TGM_Plugin_Activation class constructor.
 */
function smarty_register_required_plugins() {
	/*
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */
	$plugins_path = get_template_directory_uri() . '/inc/tgm/plugins';
	$plugins      = array(
		array(
			'name'         => 'STM Post Type',
			'slug'         => 'stm-post-type',
			'source'       => $plugins_path . '/stm-post-type.zip',
			'version'      => '1.3',
			'required'     => true,
			'force_activation' => true
		),
		array(
			'name'         => 'STM Importer',
			'slug'         => 'stm-importer',
			'source'       => $plugins_path . '/stm-importer.zip',
			'version'      => '1.5',
			'required'     => true,
		),
		array(
            'name'         => 'WPBakery Visual Composer',
            'slug'         => 'js_composer',
            'source'       => $plugins_path . '/js_composer.zip',
            'external_url' => 'http://vc.wpbakery.com',
            'version'      => '5.1.1',
            'required'     => true
        ),
        array(
            'name'         => 'Slider Revolution',
            'slug'         => 'revslider',
            'source'       => $plugins_path . '/revslider.zip',
            'external_url' => 'http://www.revolution.themepunch.com/',
            'version'      => '5.4.1',
            'required'     => true
        ),
		array(
			'name'         => 'Timetable Responsive Schedule For WordPress',
			'slug'         => 'timetable',
			'source'       => $plugins_path . '/timetable.zip',
			'external_url' => 'http://codecanyon.net/item/timetable-responsive-schedule-for-wordpress/',
			'version'      => '3.9'
		),
		array(
			'name'     => 'Contact Form 7',
			'slug'     => 'contact-form-7'
		),
		array(
			'name'     => 'Instagram Feed',
			'slug'     => 'instagram-feed'
		),
		array(
			'name'     => 'MailChimp for WordPress',
			'slug'     => 'mailchimp-for-wp'
		),
		array(
			'name'     => 'WooCommerce',
			'slug'     => 'woocommerce'
		),
		array(
			'name'     => 'TinyMCE Advanced',
			'slug'     => 'tinymce-advanced'
		),
        array(
            'name'     => 'Breadcrumb NavXT',
            'slug'     => 'breadcrumb-navxt'
        ),
		array(
			'name'     => 'Category Order and Taxonomy Terms Order',
			'slug'     => 'taxonomy-terms-order'
		)
	);

	/*
	 * Array of configuration settings. Amend each line as needed.
	 *
	 * TGMPA will start providing localized text strings soon. If you already have translations of our standard
	 * strings available, please help us make TGMPA even better by giving us access to these translations or by
	 * sending in a pull-request with .po file(s) with the translations.
	 *
	 * Only uncomment the strings in the config array if you want to customize the strings.
	 */
	$config = array(
		'id'           => 'smarty',                 // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => true,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.
	);

	tgmpa( $plugins, $config );
}
