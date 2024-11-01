<?php
/*
 * @package jPlayer
*/
namespace Inc\Pages;
use \Inc\Api\SettingApi;
use \Inc\Base\BaseController;
use \Inc\Api\AdminCallBacks;

class Dashboard extends BaseController {
	public $settings;
	public $callbacks;
	public $pages = array();
	public $subPagesVideo = array();
	public $subPagesAudio = array();
	public function register() {
		$this->settings = new SettingApi();
		$this->callbacks = new AdminCallBacks();
		$this->setPages();

		$this->setSettingsPageCPT();
		$this->setSectionsPageCPT();
		$this->setFieldsPageCPT();

		$this->settings->AddPages($this->pages)->register();

		add_shortcode('videoplayer', array($this, 'video_player'));

		add_action('init', array($this, 'gutenberg_video_block'));
		add_action('elementor/widgets/register', array($this, 'register_jplayer'));
	}
	public function setPages() {
		$this->pages = array(
			array(
				'page_title'	=> 'Video Player',
				'menu_title'	=> 'Video Player',
				'capability'	=> 'manage_options',
				'menu_slug'		=> 'video_manager',
				'callback'		=> array($this->callbacks, 'adminMediaCPTIndex'),
				'icon_url'		=> 'dashicons-admin-media',
				'position'		=> '85',
			)
		);
	}
	public function setSettingsPage() {
		$args = array(
			array(
				"option_group"	=> "mediaManagerGroup",
				"option_name"	=> "media_manager",
				"callback"		=> array($this->callbacks, 'mediaManagerApi'),
			),
		);

		$this->settings->setSettings($args);
	}
	public function setSettingsPageCPT() {
		$args = array(
			array(
				"option_group"	=> "mediaManagerCPT",
				"option_name"	=> "videoFields",
				"callback"		=> array($this->callbacks, 'cptManagerApi'),
			)
		);

		$this->settings->setSettings($args);
	}
	public function setSectionsPageCPT() {
		$args = array(
			array(
				"id"			=> "videoIndex",
				"title"			=> "Video Manager",
				"callback"		=> array($this->callbacks, 'cptSectionsApi'),
				"page"			=> "video_manager",
			)
		);

		$this->settings->setSections($args);
	}
	public function setFieldsPageCPT() {
		$args = array(
			array(
				"id"			=> "meidaId",
				"title"			=> "",
				"callback"		=> array($this->callbacks, 'cptMediaId'),
				"page"			=> "video_manager",
				"section"		=> "videoIndex",
				"args"			=> array(
					"optionName"	=> "videoFields",
					"label_for"		=> "meidaId"
				)
			),
			array(
				"id"			=> "post_type",
				"title"			=> "Title",
				"callback"		=> array($this->callbacks, 'cptMediaTitle'),
				"page"			=> "video_manager",
				"section"		=> "videoIndex",
				"args"			=> array(
					"optionName"	=> "videoFields",
					"label_for"		=> "post_type"
				)
			),
			array(
				"id"			=> "mediaUri",
				"title"			=> "Media Path",
				"callback"		=> array($this->callbacks, 'cptMediaUri'),
				"page"			=> "video_manager",
				"section"		=> "videoIndex",
				"args"			=> array(
					"optionName"	=> "videoFields",
					"label_for"		=> "mediaUri",
					"media"			=> "Add Video",
					"id"			=> "addVideo"
				)
			),
			array(
				"id"			=> "optionName",
				"title"			=> "Table Name",
				"callback"		=> array($this->callbacks, 'cptMediaOption'),
				"page"			=> "video_manager",
				"section"		=> "videoIndex",
				"args"			=> array(
					"optionName"	=> "videoFields",
					"label_for"		=> "optionName",
					"table"			=> "videoFields"
				)
			),
			array(
				"id"			=> "optionType",
				"title"			=> "Option Type",
				"callback"		=> array($this->callbacks, 'cptMediaType'),
				"page"			=> "video_manager",
				"section"		=> "videoIndex",
				"args"			=> array(
					"optionName"	=> "videoFields",
					"label_for"		=> "optionType"
				)
			)
		);
		$this->settings->setFields($args);
	}

	public function video_player($atts)
	{
		extract(shortcode_atts(array(
			'id' => '',
		), $atts));

		ob_start();
		require_once("{$this->pluginPath}/inc/Templates/video_player.php");
		return ob_get_clean();
	}

	public function gutenberg_video_block()
	{
		// wp_register_script('gutenberg_video_block', $this->assets . "build/index.js", array('wp-blocks'));
		wp_register_script('gutenberg_video_block', $this->assets . "assets/js/gutenberg-block.js", array('wp-blocks'));

		register_block_type('wp-video-playlist/video-player', array(
			'editor_script' => 'gutenberg_video_block',
			'render_callback' => array($this, 'gutenberg_video_html')
		));
	}

	public function gutenberg_video_html($props)
	{
		return do_shortcode('[videoplayer id="' . $props['id'] . '"]');
	}

	/**
	 * Register oEmbed Widget.
	 *
	 * Include widget file and register widget class.
	 * @since 1.0.0
	 * @param \Elementor\Widgets_Manager $widgets_manager Elementor widgets manager.
	 * @return void
	*/
	public function register_jplayer($widget_manager)
	{
		require_once(__DIR__ . '/widget.php');

		// $widget_manager->register(new \Essential_Elemonto_Card_Widget());
		$widget_manager->register(new \jPlayer_Widget());
	}
}