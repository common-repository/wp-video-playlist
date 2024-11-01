<?php
/*
 * @package jPlayer
*/
namespace Inc\Api;

class SettingApi {
	public $fields = array();
	public $settings = array();
	public $sections = array();
	public $adminPages = array();
	public $adminSubPages = array();
	public function register() {
		if(!empty($this->adminPages) || !empty($this->adminSubPages)):
			add_action('admin_menu', array($this, 'adminPages'));
		endif;

		if(!empty($this->settings)):
			add_action('admin_init', array($this, 'adminCPT'));
		endif;
	}
	public function AddPages(array $pages) {
		$this->adminPages = $pages;
		return $this;
	}
	public function withSubPage(string $title = null) {
		if(empty($this->adminPages)):
			return $this;
		endif;

		$adminPage = $this->adminPages[0];
		$subpage = array(
			array(
				'parent_slug'	=> $adminPage['menu_slug'],
				'page_title'	=> $adminPage['page_title'],
				'menu_title'	=> $title ? $title : $adminPage['menu_title'],
				'capability'	=> $adminPage['capability'],
				'menu_slug'		=> $adminPage['menu_slug'],
				'callback'		=> $adminPage['callback'],
			)
		);
		$this->adminSubPages = $subpage;
		return $this;
	}
	public function adminSubPages(array $pages) {
		$this->adminSubPages = array_merge($this->adminSubPages, $pages);
		return $this;
	}
	public function adminPages() {
		foreach($this->adminPages as $page):
			add_menu_page(
				$page['page_title'],
				$page['menu_title'],
				$page['capability'],
				$page['menu_slug'],
				(isset($page['callback']) ? $page['callback'] : ''),
				$page['icon_url'],
				$page['position']
			);
		endforeach;

		foreach($this->adminSubPages as $subPage):
			add_submenu_page(
				$subPage['parent_slug'],
				$subPage['page_title'],
				$subPage['menu_title'],
				$subPage['capability'],
				$subPage['menu_slug'],
				(isset($subPage['callback']) ? $subPage['callback'] : "")
			);
		endforeach;
	}
	public function setSettings(array $settings) {
		$this->settings = $settings;
		return $this;
	}
	public function setSections(array $sections) {
		$this->sections = $sections;
		return $this;
	}
	public function setFields(array $fields) {
		$this->fields = $fields;
		return $this;
	}
	public function adminCPT() {
		foreach($this->settings as $setting):
			register_setting($setting["option_group"], $setting["option_name"], (isset($setting["callback"]) ? $setting["callback"] : ''));
		endforeach;

		foreach($this->sections as $section):
			add_settings_section($section["id"], $section["title"], (isset($section["callback"]) ? $section["callback"] : ''), $section["page"]);
		endforeach;

		foreach($this->fields as $field):
			add_settings_field($field["id"], $field["title"], (isset($field["callback"]) ? $field["callback"] : ''), $field["page"], $field["section"], (isset($field["args"]) ? $field["args"] : ''));
		endforeach;
	}
}