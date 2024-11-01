<?php
/*
 * @package jPlayer
*/
namespace Inc\Api;
use \Inc\Base\BaseController;

class AdminCallBacks extends BaseController {
	public function adminMediaCPTIndex() {
		return require_once("{$this->pluginPath}/inc/Templates/admin.php");
	}
	public function cptManagerApi($input) {
		$output = get_option('videoFields');
		if(isset($_POST['remove_post'])):
			unset($output[$_POST['remove_post']]);
			return $output;
		endif;
		if(count($output) == 0):
			$output[$input['meidaId']] = $input;
			return $output;
		endif;

		if($input['optionType'] === "add"):
			if(array_key_exists($input['meidaId'], $output)):
				$it = end($output);
				$input['meidaId'] = $it['meidaId'] + 1;
			endif;
		else:
			$input['optionType'] = 'add';
		endif;

		if($output != ""):
			foreach($output as $key => $val):
				if($input['meidaId'] === $key):
					$output[$key] = $input;
				else:
					$output[$input['meidaId']] = $input;
				endif;
			endforeach;
		endif;
		return $output;
	}
	public function cptSectionsApi() {}
	public function cptMediaId($args) {
		$name = $args['label_for'];
		$optionName = $args['optionName'];
		$title = '';

		if(isset($_POST['edit_post'])):
			$input = get_option($optionName);
			$title = $input[$_POST['edit_post']][$name];
		else:
			$output = get_option($optionName);
			$title = count($output) + 1;
		endif;

		echo "<input type='hidden' name='" . $optionName . "[$name]' value='{$title}' id='mediaId'>";
	}
	public function cptMediaTitle($args) {
		$name = $args['label_for'];
		$optionName = $args['optionName'];
		$title = '';

		if(isset($_POST['edit_post'])):
			$input = get_option($optionName);
			$title = $input[$_POST['edit_post']][$name];
		endif;

		echo "<div class='mediaContainer'><div class='mediaWrapper'><input type='text' name='" . $optionName . "[$name]' value='{$title}' required id='mediaName'></div></div>";
	}
	public function cptMediaUri($args) {
		$name = $args['label_for'];
		$optionName = $args['optionName'];
		$title = '';

		if(isset($_POST['edit_post'])):
			$input = get_option($optionName);
			$title = $input[$_POST['edit_post']][$name];
		endif;

		echo "<div class='mediaContainer'><div class='mediaWrapper'><input type='text' name='" . $optionName . "[$name]' value='{$title}' required id='mediaUri'><br><input class='addMedia' id='{$args['id']}' type='button' name='' value='{$args['media']}'></div></div>";
	}
	public function cptMediaOption($args) {
		$name = $args['label_for'];
		$optionName = $args['optionName'];

		echo "<input type='hidden' name='" . $optionName . "[$name]' value='{$args['table']}' id='mediaId'>";
	}
	public function cptMediaType($args) {
		$name = $args['label_for'];
		$optionName = $args['optionName'];
		$title = 'add';

		if(isset($_POST['edit_post'])):
			$title = 'edit';
		endif;

		echo "<input type='hidden' name='" . $optionName . "[$name]' value='{$title}' id='mediaId'>";
	}
}