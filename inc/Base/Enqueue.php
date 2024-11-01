<?php
/*
 * @package jPlayer
*/
namespace Inc\Base;
use \Inc\Base\BaseController;

class Enqueue extends BaseController {
	public function register() {
		add_action('admin_enqueue_scripts', array($this, 'wp_enqueue'));
		add_action('wp_enqueue_scripts', array($this, 'enqueue'));
	}
	function wp_enqueue() {
		wp_enqueue_style("VideoPlayerStyle", $this->assets . "assets/css/wp-style.css");
		wp_enqueue_script('media-upload');
		wp_enqueue_media();
		wp_enqueue_script("PlayerScript", $this->assets . "assets/js/wp-app.js", '', '', true);
	}

	function enqueue() {
		wp_enqueue_style("VideoPlayerStyle", $this->assets . "assets/css/style.css");
		wp_enqueue_script("jPlayer", $this->assets . "assets/js/jquery.jplayer.min.js", array('jquery'), '', true);
		wp_enqueue_script("jPlayerPlaylist", $this->assets . "assets/js/jplayer.playlist.min.js", array('jquery'), '', true);
		wp_enqueue_script("PlayerScript", $this->assets . "assets/js/app.js", array('jquery'), '', true);
	}
}