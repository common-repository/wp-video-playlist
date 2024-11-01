<?php
defined('ABSPATH') or die("You don\'t have access of this file. Batter luck next time!");

/**
 * Elementor oEmbed Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
*/
class jPlayer_Widget extends \Elementor\Widget_Base {
  public function __construct($data = [], $args = null) {
    parent::__construct($data, $args);

    $this->clientdata = $data;
  }

  /**
   * Get widget name.
	 *
	 * Retrieve oEmbed widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget name.
  */
  public function get_name()
  {
    return 'jPlayer';
  }

  /**
   * Get widget title.
	 *
	 * Retrieve oEmbed widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget title.
  */
  public function get_title()
  {
    return esc_html__('WP Video Playlist', 'wp-video-playlist');
  }

  /**
   * Get widget icon.
	 *
	 * Retrieve oEmbed widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget icon.
  */
  public function get_icon()
  {
    return 'eicon-video-playlist';
  }

  /**
   * Get custom help URL.
	 *
	 * Retrieve a URL where the user can get more information about the widget.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget help URL.
  */
  public function get_custom_help_url() {
		return 'https://wordpress.org/support/plugin/wp-video-playlist/#new-topic-0';
	}

  /**
   * Get widget categories.
	 *
	 * Retrieve the list of categories the oEmbed widget belongs to.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return array Widget categories.
  */
  public function get_categories() {
    return [ 'basic' ];
  }

  /**
   * Get widget keywords.
	 *
	 * Retrieve the list of keywords the oEmbed widget belongs to.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return array Widget keywords.
  */
  public function get_keywords() {
		return [ 'video', 'videos', 'playlist', 'player', 'players', 'wp' ];
	}

  /**
   * Render oEmbed widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
  */
  protected function render() {
    echo do_shortcode('[videoplayer id="' . $this->clientdata['id'] . '"]');
  }
}