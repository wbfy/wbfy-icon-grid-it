<?php
/**
 * Main Icon Grid It! plugin file
 *
 * Set up autoload and instantiate the required classes and constants
 *
 * @link    https://websitesbuiltforyou.com/wordpress/icon-grid-it-feature-grids-plugin-for-wordpress
 * @package Icon Grid It! Feature Grids Plugin For WordPress
 */

/**
 * Plugin Name: Icon Grid It!
 * Plugin URI: https://websitesbuiltforyou.com/wordpress/icon-grid-it-feature-grids-plugin-for-wordpress
 * Description: Display feature grids with icons
 * Author: Websites Built For You
 * Author URI: https://websitesbuiltforyou.com
 * Version: 1.0.0
 * License: GPLv2 or later
 * License URI: https://www.gnu.org/licenses
 * Text Domain: wbfy-icon-grid-it
 * Domain Path: /resources/languages
 *
 * Icon Grid It! Feature Grids Plugin For WordPress is free software: you can redistribute it and/or modify it
 * under the terms of the GNU General Public License as published by the Free Software
 * Foundation, either version 2 of the License, or any later version.
 *
 * Icon Grid It! Feature Grids Plugin For WordPress is distributed in the hope that it will be useful, but WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A
 * PARTICULAR PURPOSE. See the GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along with
 * Icon Grid It! Feature Grids Plugin For WordPress. If not, see https://www.gnu.org/licenses.
 */

if (!defined('ABSPATH')) {
    exit;
}

if (!class_exists('wbfy_gli_Main')) {
    define('WBFY_GLI_VERSION', '1.0.0');
    define('WBFY_GLI_PLUGIN_DIR', plugin_dir_path(__FILE__));
    define('WBFI_IGLI_MAX_ITEMS', 10);

    include 'server/php/Autoloader.class.php';
    wbfy_gli_Autoloader::register();

    $wbfy_gli = new wbfy_gli_Main;
}
