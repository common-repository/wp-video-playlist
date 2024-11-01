<?php
/*
 * Trigger Uninstall process only if WP_UNINSTALL_PLUGIN is defined
 * @package jPlayer
*/

if(!(defined('WP_UNINSTALL_PLUGIN'))):
	exit();
endif;

function mediaplayer_delete_plugin() {
	// Clear the DB
	global $wpdb;

	delete_option('videoFields');
}
mediaplayer_delete_plugin();