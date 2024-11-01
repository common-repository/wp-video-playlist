<?php
/*
 * @package jPlayer
*/
namespace Inc\Base;

class BaseController {
	public $plugin;
	public $pluginPath;
	public $cptsarray = array();
	public $managerArray = array();
	public function __construct() {
		$this->plugin = plugin_basename(dirname(__FILE__, 3) . '/' . plugin_basename( dirname( __FILE__, 3)) . '.php');
		$this->assets = plugin_dir_url(dirname(__FILE__, 2));
		$this->pluginPath = plugin_dir_path(dirname(__FILE__, 2));

		$this->magagersArray = array(
			"vedioManager" => "Activate Vedio CPT",
			"audioManager" => "Activate Audio CPT",
		);
	}
}