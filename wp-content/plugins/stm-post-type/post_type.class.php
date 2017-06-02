<?php

add_action( 'init', array( 'STM_PostType', 'init' ), 1 );

class STM_PostType {

	protected static $PostTypes = array();
	protected static $Metaboxes = array();
	protected static $Metaboxes_fields = array();
	protected static $Taxonomies = array();

	public static function init() {

		self::register_custom_post_types();
		self::register_taxonomies();

		add_action( 'save_post', array( get_class(), 'save_metaboxes' ) );
		add_action( 'add_meta_boxes', array( get_class(), 'add_metaboxes' ) );

	}

	public static function registerPostType( $postType, $title, $args ) {

		$pluralTitle = empty( $args['pluralTitle'] ) ? $title . 's' : $args['pluralTitle'];
		$labels      = array(
			'name'               => __( $pluralTitle, STM_POST_TYPE ),
			'singular_name'      => __( $title, STM_POST_TYPE ),
			'add_new'            => __( 'Add New', STM_POST_TYPE ),
			'add_new_item'       => __( 'Add New ' . $title, STM_POST_TYPE ),
			'edit_item'          => __( 'Edit ' . $title, STM_POST_TYPE ),
			'new_item'           => __( 'New ' . $title, STM_POST_TYPE ),
			'all_items'          => __( 'All ' . $pluralTitle, STM_POST_TYPE ),
			'view_item'          => __( 'View ' . $title, STM_POST_TYPE ),
			'search_items'       => __( 'Search ' . $pluralTitle, STM_POST_TYPE ),
			'not_found'          => __( 'No ' . $pluralTitle . ' found', STM_POST_TYPE ),
			'not_found_in_trash' => __( 'No ' . $pluralTitle . '  found in Trash', STM_POST_TYPE ),
			'parent_item_colon'  => '',
			'menu_name'          => __( $pluralTitle, STM_POST_TYPE )
		);

		$defaults = array(
			'labels'             => $labels,
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'show_in_nav_menus'  => false,
			'query_var'          => true,
			'has_archive'        => true,
			'hierarchical'       => false,
			'menu_position'      => null,
			'menu_icon'          => null,
			'supports'           => array( 'title', 'editor' )
		);

		$args                         = wp_parse_args( $args, $defaults );
		self::$PostTypes[ $postType ] = $args;

	}

	public static function register_custom_post_types() {
		foreach ( self::$PostTypes as $postType => $args ) {
			register_post_type( $postType, $args );
		}
	}

	public static function addMetaBox( $id, $title, $post_types, $callback = '', $context = '', $priority = '', $callback_args = '' ) {

		foreach ( $post_types as $post_type ) {
			$title                                     = empty( $title ) ? __( 'Options', STM_POST_TYPE ) : $title;
			self::$Metaboxes[ $post_type . '_' . $id ] = array(
				'title'         => $title,
				'callback'      => $callback,
				'post_type'     => $post_type,
				'context'       => empty( $context ) ? 'normal' : $context,
				'priority'      => $priority,
				'callback_args' => $callback_args,
			);
			self::$Metaboxes_fields[$id] = $callback_args['fields'];
		}

	}

	public static function add_metaboxes() {

		foreach ( self::$Metaboxes as $boxId => $args ) {
			add_meta_box(
				$boxId,
				$args['title'],
				empty( $args['callback'] ) ? array( get_class(), 'display_metaboxes' ) : $args['callback'],
				$args['post_type'],
				$args['context'],
				$args['priority'],
				$args['callback_args']
			);
		}

	}

	public static function display_metaboxes( $post, $metabox ) {

		$fields = $metabox['args']['fields'];

		echo '<input type="hidden" name="stm_custom_nonce" value="' . wp_create_nonce( basename( __FILE__ ) ) . '" />';
		echo '<table class="form-table stm">';
		foreach ( $fields as $key => $field ) {
			$meta = get_post_meta( $post->ID, $key, true );
			if( $field['type'] != 'separator'){
				echo '<tr><th><label for="' . $key . '">' . $field['label'] . '</label></th><td>';
			}else{
				echo '<tr><th><h3>' . $field['label'] . '</h3></th><td>';
			}
			switch ( $field['type'] ) {
				case 'text':
					if( empty( $meta ) && ! empty( $field['default'] ) && $post->post_status == 'auto-draft' ){
						$meta = $field['default'];
					}
					echo '<input type="text" name="' . $key . '" id="' . $key . '" value="' . $meta . '" />';
					if(isset($field['description'])) {
						echo '<p class="textfield-description">'.$field['description'].'</p>';
					}
					break;
				case 'spacing':
					if( empty( $meta ) && ! empty( $field['default'] ) && $post->post_status == 'auto-draft' ){
						$meta = $field['default'];
					}
					echo '<div class="stm-metabox-spacing">';
					if( $spacing_sides = $field['sides'] ) {
						foreach( $spacing_sides as $spacing_side => $spacing_side_name ) {

							echo '<div class="stm-metabox-spacing__field">';
							echo '<label class="stm-metabox-spacing__field-label">'. $spacing_side_name .':';
							echo '<input class="stm-metabox-spacing__field-input" type="text" name="' . $key . '[' . $spacing_side . ']' . '" id="' . $key . '" value="' . ( ($meta) ? $meta[$spacing_side] : '' ) . '" /></label>';
							echo '</div>';
						}
					}
					echo '</div>';
					if(isset($field['description'])) {
						echo '<p class="textfield-description">'.$field['description'].'</p>';
					}
					break;
				case 'textarea':
					echo '<textarea name="' . $key . '" id="' . $key . '" cols="60" rows="4">' . $meta . '</textarea>';
					break;
				case 'checkbox':
					if( empty( $meta ) && ! empty( $field['default'] ) && $post->post_status == 'auto-draft' ){
						$meta = $field['default'];
					}
					echo '<input type="checkbox" name="' . $key . '" id="' . $key . '" ', $meta ? ' checked="checked"' : '', '/>';
					break;
				case 'select':
					echo '<select name="' . $key . '" id="' . $key . '">';
					if( empty( $meta ) && ! empty( $field['default'] ) && $post->post_status == 'auto-draft' ){
						$meta = $field['default'];
					}
					foreach ( $field['options'] as $key => $value ) {
						echo '<option', $meta == $key ? ' selected="selected"' : '', ' value="' . $key . '">' . $value . '</option>';
					}
					echo '</select>';
					break;
                case 'multi-select':
                    $currentValues = explode(',', $meta);
                    echo '<select class="stm-multiselect" multiple="multiple" name="' . $key . '[]" id="' . $key . '">';
                    foreach ( $field['options'] as $key => $value ) {
                        $disabled = '';
                        if($key == 'none') {
                            $disabled = 'disabled';
                        }
                        echo '<option', in_array($key, $currentValues) ? ' selected="selected"' : '', ' value="' . $key . '" '. $disabled .'>' . $value . '</option>';
                    }
                    echo '</select>';
                    break;
				case 'color_picker':
					if( empty( $meta ) && ! empty( $field['default'] ) && $post->post_status == 'auto-draft' ){
						$meta = $field['default'];
					}
					echo '<input type="text" class="colorpicker-'.$key.'" name="' . $key . '" id="' . $key . '" value="' . $meta . '" />
						<script type="text/javascript">
							jQuery(function($) {
							    $(function() {
							        $(".colorpicker-'.$key.'").wpColorPicker();
							    });

							});
						</script>
					';
					break;
				case 'datetimepicker':
					$date_format = get_option('date_format');
					$time_format = get_option('time_format');
					echo '<input class="form-control" id="stm-datetimepicker-'.$key.'" name="' . $key . '"  value="' . $meta . '" />
					     <script type="text/javascript">
						     jQuery(document).ready(function($){
								$("#stm-datetimepicker-'.$key.'").datetimepicker({
									format: "'.$date_format.' '.$time_format.'"
								});
							});
						</script>
						';
					break;
				case 'datepicker':
					$date_format = "d-m-Y";
					$meta = (!empty($meta)) ? date( $date_format, $meta ) : "";
					echo '<input class="form-control" id="stm-datepicker-'.$key.'" name="' . $key . '"  value="' . $meta . '" />
					     <script type="text/javascript">
						     jQuery(document).ready(function($){
								$("#stm-datepicker-'.$key.'").datetimepicker({
									timepicker:false,
									format: "'.$date_format.'",
									minDate: 0
								});
							});		
						</script>
						';
					break;
				case 'timepicker':
					$time_format = get_option('time_format');
					echo '<input class="form-control" id="stm-timepicker-'.$key.'" name="' . $key . '"  value="' . $meta . '" />
					     <script type="text/javascript">
						     jQuery(document).ready(function($){
								$("#stm-timepicker-'.$key.'").datetimepicker({
									datepicker:false,
									format: "'.$time_format.'"
								});
							});
						</script>
						';
					break;
				case 'iconpicker':
					$icons = json_decode( file_get_contents( get_template_directory() . '/assets/js/icomoon-selection.json' ), true );
					foreach ( $icons['icons'] as $icon ) {
						$fonts[] = 'stm-icon-' . $icon['properties']['name'];
					}
					echo '<input type="text" id="stm-iconpicker-' . $key . '" name="' . $key . '" value="' . $meta . '"/>
							<script type="text/javascript">
								jQuery(document).ready(function ($) {
									$("#stm-iconpicker-' . $key . '").fontIconPicker({
										theme: "fip-darkgrey",
										emptyIcon: false,
										source: ' . json_encode( $fonts ) . '
									});
								});
							</script>
						';
					break;
				case 'image':
					$default_image = plugin_dir_url( __FILE__ ) . 'assets/images/default_170x50.gif';
					$image = '';
					if( empty( $meta ) && ! empty( $field['default'] ) && $post->post_status == 'auto-draft' ){
						$meta = $field['default'];
					}
					if ($meta) {
						$image = wp_get_attachment_image_src($meta, 'medium');
						$image = $image[0];
					}
					if( empty($image) ){
						$image = $default_image;
					}
					echo '
						<div class="stm_metabox_image">
							<input name="'. $key .'" type="hidden" class="custom_upload_image" value="'. $meta .'" />
							<img src="'. $image .'" class="custom_preview_image" alt="" />
							<input class="stm_upload_image upload_button_'. $key .' button-primary" type="button" value="' . __( 'Choose Image', STM_POST_TYPE ). '" />
							<a href="#" class="stm_remove_image button">' . __( 'Remove Image', STM_POST_TYPE ). '</a>
						</div>
						<script type="text/javascript">
							jQuery(function($) {
								$(".upload_button_'. $key .'").click(function(){
									var btnClicked = $(this);
									var custom_uploader = wp.media({
										title   : "' . __( 'Select image', STM_POST_TYPE ) . '",
										button  : {
											text: "' . __( 'Attach', STM_POST_TYPE ) . '"
										},
										multiple: true
									}).on("select", function () {
										var attachment = custom_uploader.state().get("selection").first().toJSON();
										btnClicked.closest(".stm_metabox_image").find(".custom_upload_image").val(attachment.id);
										btnClicked.closest(".stm_metabox_image").find(".custom_preview_image").attr("src", attachment.url);

									}).open();
								});
								$(".stm_remove_image").click(function(){
									$(this).closest(".stm_metabox_image").find(".custom_upload_image").val("");
									$(this).closest(".stm_metabox_image").find(".custom_preview_image").attr("src", "' . $default_image . '");
									return false;
								});
							});
						</script>
					';
					break;
			}
			echo '</td></tr>';
		}
		echo '</table>';

	}

	public static function save_metaboxes( $post_id ) {

		if ( ! isset( $_POST['stm_custom_nonce'] ) ) {
			return $post_id;
		}
		if ( ! wp_verify_nonce( $_POST['stm_custom_nonce'], basename( __FILE__ ) ) ) {
			return $post_id;
		}
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return $post_id;
		}
		if ( ! current_user_can( 'edit_page', $post_id ) ) {
			return $post_id;
		}
		$metaboxes = self::$Metaboxes_fields;

		foreach ( $metaboxes as $fields ) {
			foreach ( $fields as $field => $data ) {
				if( $data['type'] == 'datepicker' ) {
					$old = strtotime( get_post_meta( $post_id, $field, true ) );
				} else {
					$old = get_post_meta( $post_id, $field, true );
				}
				if( isset( $_POST[ $field ] ) ){
					if( $data['type'] == 'datepicker' ) {
                        $new = strtotime($_POST[$field]);
                    } elseif($data['type'] == 'multi-select') {
                        update_post_meta( $post_id, $field, implode(',', $_POST[$field]) );
					} else {
						$new = $_POST[ $field ];
					}
					if ( $new && $new != $old ) {
						update_post_meta( $post_id, $field, $new );
					} elseif ( '' == $new && $old ) {
						delete_post_meta( $post_id, $field, $old );
					}
				}else{
					delete_post_meta( $post_id, $field, $old );
				}
			}
		}

	}

	public static function addTaxonomy( $slug, $taxonomyName, $post_type, $args = '' ) {

		$pluralName = empty( $args['plural'] ) ? $taxonomyName . 's' : $args['plural'];
		$labels     = array(
			'name'              => _x( $taxonomyName, 'taxonomy general name', 'stm_theme' ),
			'singular_name'     => _x( $taxonomyName, 'taxonomy singular name', 'stm_theme' ),
			'search_items'      => __( 'Search ' . $pluralName, 'stm_theme' ),
			'all_items'         => __( 'All ' . $pluralName, 'stm_theme' ),
			'parent_item'       => __( 'Parent ' . $taxonomyName, 'stm_theme' ),
			'parent_item_colon' => __( 'Parent ' . $taxonomyName . ':', 'stm_theme' ),
			'edit_item'         => __( 'Edit ' . $taxonomyName, 'stm_theme' ),
			'update_item'       => __( 'Update ' . $taxonomyName, 'stm_theme' ),
			'add_new_item'      => __( 'Add New ' . $taxonomyName, 'stm_theme' ),
			'new_item_name'     => __( 'New ' . $taxonomyName . 'Name', 'stm_theme' ),
			'menu_name'         => __( $taxonomyName, 'stm_theme' )
		);

		$defaults = array(
			'hierarchical'      => true,
			'labels'            => $labels,
			'show_in_nav_menus' => true,
			'show_ui'           => null,
			'show_admin_column' => true,
			'query_var'         => true,
			'rewrite'           => array( 'slug' => $slug )
		);

		$args                      = wp_parse_args( $defaults, $args );
		self::$Taxonomies[ $slug ] = array( 'post_type' => $post_type, 'args' => $args );

	}


	public static function register_taxonomies() {

		foreach ( self::$Taxonomies as $taxonomyName => $taxonomy ) {
			register_taxonomy( $taxonomyName, $taxonomy['post_type'], $taxonomy['args'] );
		}

	}

}