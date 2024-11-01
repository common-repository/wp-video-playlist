<div class="wrap mediaTemplate">
	<h1>Video Playlist</h1>
	<?php settings_errors(); ?>

	<ul class="nav nav-pills tabList" data-tab="#tabContainer">
		<li class="<?php echo isset($_POST['edit_post']) ? '' : 'active'; ?>">
			<a href="#tab1">Videos</a>
		</li>
		<li class="<?php echo isset($_POST['edit_post']) ? 'active' : ''; ?>">
			<a href="#tab2"><?php echo isset($_POST['edit_post']) ? 'Edit' : 'Add'; ?> Video</a>
		</li>
	</ul>

	<div id="tabContainer" class="tabContainer noScope">
		<div id="tab1" class="tabWrapper">
			<?php
				if(!get_option('videoFields')):
					$cpts = array();
					echo "<p>Sorry Not Data Found!</p>";
				else:
					$cpts = get_option('videoFields');
					?>
						<div id="titlediv">
							<div class="inside">
								<p class="description">
									<label for="wpcf7-shortcode">Copy this shortcode and paste it into your post, page, or text widget content:</label>
									<span class="shortcode wp-ui-highlight">
										<input type="text" id="wpcf7-shortcode" onfocus="this.select();" readonly="readonly" class="large-text code" value="[videoplayer]">
									</span>
								</p>
							</div>
						</div>
						<table class="wp-list-table widefat striped pages">
							<thead>
								<tr>
									<th scope="col" class="manage-column">S.No</th>
									<th scope="col" class="manage-column">Video Title</th>
									<th scope="col" class="manage-column">Actions</th>
								</tr>
							</thead>
							<tbody>
								<?php
									foreach ($cpts as $cpt):
										echo "<tr><td>{$cpt['meidaId']}</td><td>{$cpt['post_type']}</td><td>";
										echo '<form method="post" action="" class="inline-block">';
										echo "<input type='hidden' name='edit_post' value='{$cpt['meidaId']}'>";
										submit_button('Edit', 'primary small', 'submit', false);
										echo "</form>";

										$str = str_replace(["'", '"'], "", $cpt['post_type']);

										/*echo '<form method="post" action="" data-url="' . plugin_dir_url(dirname(__FILE__)) . 'ajax/ajax.php" class="deletemedia inline-block">';
										echo "<input type='hidden' name='remove_post' value='{$cpt['meidaId']}'>";
										echo "<input type='hidden' name='option' value='videoFields'>";
										echo '<input type="submit" name="submit" id="submit" class="button delete button-small" value="Delete" onclick="return confirm(\'Are you sure you want to delete ' . $str . '?\');">';
										echo "</form>";*/

										echo '<form method="post" action="options.php" class="inline-block">';
										echo "<input type='hidden' name='remove_post' value='{$cpt['meidaId']}'>";
										settings_fields("mediaManagerCPT");
										submit_button('Delete', 'delete small', 'submit', false, array(
											'onclick' => 'return confirm("Are you sure you want to delete ' . $str . ' and its data?");'
										));
										echo "</form>";
										echo "</td></tr>";
									endforeach;
								?>
							</tbody>
							<tfoot>
								<tr>
									<th scope="col" class="manage-column">S.No</th>
									<th scope="col" class="manage-column">Video Title</th>
									<th scope="col" class="manage-column">Actions</th>
								</tr>
							</tfoot>
						</table>
					<?php
				endif;
			?>
		</div>
		<div id="tab2" class="tabWrapper">
			<form method="post" action="options.php">
				<?php
					settings_fields("mediaManagerCPT");
					do_settings_sections("video_manager");
					submit_button();
				?>
			</form>
		</div>
	</div>
</div>