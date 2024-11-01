<?php
/**
 * @package jPlayer
 */
require_once('../../../../../wp-config.php');
if(isset($_POST)):
	$output = get_option($_POST['option']);
	unset($output[$_POST['remove_post']]);
	update_option($_POST['option'], $output);
endif;