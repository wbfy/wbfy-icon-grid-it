<?php
/**
 * Icon Grid It! uninstaller
 * Delete options if required
 */
if (!defined('WP_UNINSTALL_PLUGIN')) {
    die;
}
global $wp_rewrite;
$options = get_option('wbfy_gli');
if (!isset($options['config_data']['on_delete']) || $options['config_data']['on_delete']) {
    delete_option('wbfy_gli');
}
$wp_rewrite->flush_rules();
