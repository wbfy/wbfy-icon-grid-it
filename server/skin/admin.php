<?php
/**
 * Icon Grid It! WP Admin options page template
 */
?>
<div class="wrap wbfy-admin">
	<h1>
		<?php esc_html_e('Configure Icon Grid It!', 'wbfy-icon-grid-it');?>
	</h1>
	<form method="post" action="options.php" name="wbfy-icon-grid-it-admin" class="wbfy-icon-grid-it-admin">
<?php
settings_fields('wbfy_gli_options');
do_settings_sections('wbfy_gli_options');
submit_button();
?>
	</form>
</div>
