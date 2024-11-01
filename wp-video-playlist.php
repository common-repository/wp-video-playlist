<?php
/*
 * @package jPlayer
 * Plugin Name: WP Video Playlist
 * Plugin URI: https://wordpress.org/plugins/wp-video-playlist/
 * Description: This plugin allow you to add mp4, ogv and Youtube videos.
 * Version: 1.1.1
 * Tags: Video, Videos, Video Player, Video Playlist, Playlist, Youtube Playlist
 * Author: Sandeep Kumar(Sean)
 * Author URI: https://www.Src.one/
 * License: GPLv2 or later
 * Text Domain: wp-video-playlist
 * 
 * Elementor tested up to: 3.5.0
 * Elementor Pro tested up to: 3.5.0
 * 
 * This plugin is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 2 of the License, or
 * any later version.
 *  
 * This plugin is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License
 * along with this.
*/

// Prevent direct call this file.
defined('ABSPATH') or die("You don\'t have access of this file. Batter luck next time!");

// Composer Autoload. 
if(file_exists(dirname(__FILE__) . '/vendor/autoload.php')):
	require_once dirname(__FILE__) . '/vendor/autoload.php';
endif;

function wp_mediaActive()
{
	$default = array();

	flush_rewrite_rules();
	if(!get_option('videoFields')):
		update_option('videoFields', $default);
	endif;
}
function wp_mediaDeactive()
{
	flush_rewrite_rules();
}

register_activation_hook(__FILE__, 'wp_mediaActive');
register_deactivation_hook(__FILE__, 'wp_mediaDeactive');

if(class_exists('Inc\\Init')):
	Inc\Init::register_services();
endif;