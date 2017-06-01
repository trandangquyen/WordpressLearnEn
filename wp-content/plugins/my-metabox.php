<?php
/*
Plugin Name: Demo metabox
Author: Khoazero123
Description: ....
*/
function my_metabox() {
	add_meta_box('link-download','Link download','my_box_html','post');
}
add_action('add_meta_boxes','my_metabox');

function my_box_html($post) {
	echo '<label for="link_download" >Link download: </label>';
	echo '<input type="text" name="link_download" value="">';
}
function my_metabox_save($post_id) {

}