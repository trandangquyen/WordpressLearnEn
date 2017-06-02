<?php
/*
Plugin Name: STM Importer
Plugin URI: http://stylemixthemes.com/
Description: STM Importer
Author: Stylemix Themes
Author URI: http://stylemixthemes.com/
Text Domain: stm_importer
Version: 1.5
*/
$plugin_url = plugin_dir_url( __FILE__ );

// Demo Import - Styles
function stm_demo_import_styles() {
	$plugin_url = plugin_dir_url( __FILE__ );

	wp_enqueue_style( 'stm-demo-import-style', $plugin_url . '/assets/css/style.css', null, null, 'all' );
}

add_action( 'admin_enqueue_scripts', 'stm_demo_import_styles' );


// Demo Import - Add page
add_action('admin_menu', 'stm_add_demo_import_page');

if ( ! function_exists('stm_add_demo_import_page'))
{
	function stm_add_demo_import_page()
	{
		/*add_theme_page( esc_html__( 'Demo Import', 'stm_importer' ) , esc_html__( 'STM Demo Import', 'stm_importer' ) , 'manage_options' , 'stm_demo_import' , 'stm_demo_import' );*/
	}
}

// Demo Import
if ( !function_exists('stm_demo_import'))
{
	function stm_demo_import()
	{
		?>
		<div class="stm_message content" style="display:none;">
			<img src="<?php echo plugin_dir_url( __FILE__ ); ?>assets/images/spinner.gif" alt="spinner">
			<h1 class="stm_message_title"><?php esc_html_e('Importing Demo Content...', 'stm_importer'); ?></h1>
			<p class="stm_message_text"><?php esc_html_e('Duration of demo content importing depends on your server speed.', 'stm_importer'); ?></p>
		</div>

		<div class="stm_message success" style="display:none;">
			<p class="stm_message_text"><?php echo wp_kses( sprintf(__('Congratulations and enjoy <a href="%s" target="_blank">your website</a> now!', 'stm_importer'), esc_url( home_url() )), array( 'a' => array( 'href' => array(), 'target' => array() ) ) ); ?></p>
		</div>

		<form class="stm_importer" id="import_demo_data_form" action="?page=stm_demo_import" method="post">

			<div class="stm_importer_options">

				<div class="stm_importer_note">
					<strong><?php esc_html_e('Before installing the demo content, please NOTE:', 'stm_importer'); ?></strong>
					<p><?php echo wp_kses( sprintf(__('Install the demo content only on a clean WordPress. Use <a href="%s" target="_blank">Reset WP</a> plugin to clean the current Theme.', 'motors'), 'https://wordpress.org/plugins/reset-wp/', esc_url( home_url() )), array( 'a' => array( 'href' => array(), 'target' => array() ) ) ); ?></p>
					<p><?php esc_html_e('Remember that you will NOT get the images from live demo due to copyright / license reason.', 'stm_importer'); ?></p>
				</div>
                <label>
                    <img src="<?php echo plugin_dir_url( __FILE__ ) ?>assets/images/smart-school-preview.png" />
						<span class="stm_choice_radio_button">
							<input type="radio" name="smarty_layout_demo" value="school" checked/>
                            <?php esc_html_e('School', 'stm-importer'); ?>
						</span>
                </label>
                <label>
                    <img src="<?php echo plugin_dir_url( __FILE__ ) ?>assets/images/smart-university-preview.png" />
						<span class="stm_choice_radio_button">
							<input type="radio" name="smarty_layout_demo" value="university" />
                            <?php esc_html_e('University', 'stm-importer'); ?>
						</span>
                </label>
                <label>
                    <img src="<?php echo plugin_dir_url( __FILE__ ) ?>assets/images/smart-kindergarten-preview.png" />
						<span class="stm_choice_radio_button">
							<input type="radio" name="smarty_layout_demo" value="kindergarten" />
                            <?php esc_html_e('Kindergarten', 'stm-importer'); ?>
						</span>
                </label>
				<p>
					<input class="button-primary size_big" type="submit" value="Import" id="import_demo_data">
				</p>
			</div>

		</form>
		<script type="text/javascript">
			jQuery(document).ready(function() {
				jQuery('#import_demo_data_form').on('submit', function() {
					jQuery("html, body").animate({
						scrollTop: 0
					}, {
						duration: 300
					});
					jQuery('.stm_importer').slideUp(null, function(){
						jQuery('.stm_message.content').slideDown();
					});

					// Importing Content
					jQuery.ajax({
						type: 'POST',
						url: '<?php echo admin_url('admin-ajax.php'); ?>',
						data: jQuery(this).serialize()+'&action=stm_demo_import_content',
						success: function(){

							jQuery('.stm_message.content').slideUp();
							jQuery('.stm_message.success').slideDown();

						}
					});
					return false;
				});
			});
		</script>
		<?php
	}

	// Content Import
	function stm_demo_import_content() {

		set_time_limit( 0 );

		if ( ! defined( 'WP_LOAD_IMPORTERS' ) ) {
			define( 'WP_LOAD_IMPORTERS', true );
		}

        $layout = 'school';

        if(!empty($_POST['smarty_layout_demo'])) {
            $layout = $_POST['smarty_layout_demo'];
        }

        update_option('stm_layout_mode', $layout);

		require_once( 'wordpress-importer/wordpress-importer.php' );

		$wp_import                    = new WP_Import();
		$wp_import->fetch_attachments = true;

		ob_start();
            if($layout === 'school') {
			    $wp_import->import( get_template_directory() . '/inc/demo/demo_content.xml' );
            }
            if($layout === 'university') {
                $wp_import->import( get_template_directory() . '/inc/demo/demo_content_university.xml' );
            }
            if($layout === 'kindergarten') {
                $wp_import->import( get_template_directory() . '/inc/demo/demo_content_kindergarten.xml' );
            }
        ob_end_clean();

		do_action( 'stm_importer_done' );


		echo 'done';
		die();

	}

	add_action( 'wp_ajax_stm_demo_import_content', 'stm_demo_import_content' );

}