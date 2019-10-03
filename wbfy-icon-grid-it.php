<?php
/**
 * Main plugin control
 *
 * @link    https://websitesbuiltforyou.com/wordpress/feature-grids-plugin-for-wordpress
 * @package A Feature Grids Plugin For WordPress
 */

/**
 * Plugin Name: Icon Grid It!
 * Plugin URI: https://websitesbuiltforyou.com/wordpress/feature-grids-plugin-for-wordpress
 * Description: Display feature grids with icons
 * Author: Websites Built For You
 * Author URI: https://websitesbuiltforyou.com
 * Version: 1.2.1
 * License: GPLv2 or later
 * License URI: https://www.gnu.org/licenses
 * Text Domain: wbfy-icon-grid-it
 * Domain Path: /resources/languages
 *
 * Icon Grid It! is free software: you can redistribute it and/or modify it
 * under the terms of the GNU General Public License as published by the Free Software
 * Foundation, either version 2 of the License, or any later version.
 *
 * Icon Grid It! is distributed in the hope that it will be useful, but WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A
 * PARTICULAR PURPOSE. See the GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along with
 * Icon Grid It! If not, see https://www.gnu.org/licenses.
 */

if (!defined('ABSPATH')) {
    exit;
}

if (!class_exists('wbfy_igi_Main')) {
    define('WBFY_IGI_VERSION', '1.2.1');
    define('WBFY_IGI_PLUGIN_DIR', plugin_dir_path(__FILE__));
    define('WBFY_IGI_MAX_ITEMS', 15);
    define('WBFY_DEFAULT_ICON_COLOR', '#ffa500'); // Orange

    include 'server/src/Autoloader.class.php';
    wbfy_igi_Autoloader::register();

    $wbfy_gli = new wbfy_igi_Main;
}
