<?php
/**
 * Main plugin loader
 */
class wbfy_igi_Main
{
    /**
     * Initialise plugin and menus
     */
    public function __construct()
    {
        // Add activate/deactivate handlers
        register_activation_hook(WBFY_IGI_PLUGIN_DIR . '/wbfy-icon-grid-it.php', array($this, 'activate'));
        register_deactivation_hook(WBFY_IGI_PLUGIN_DIR . '/wbfy-icon-grid-it.php', array($this, 'deactivate'));

        // Add admin handler
        add_action('admin_init', array(new wbfy_igi_Admin, 'init'));
        add_action('admin_menu', array(new wbfy_igi_Admin, 'addToMenu'));

        // Add shortcode handler
        add_action('init', array(new wbfy_igi_Shortcodes, 'init'));

        // Enqueue Gutenberg editor only assets
        add_action('enqueue_block_editor_assets', array(new wbfy_igi_Block, 'adminInit'));
        // Enqueue Gutenberg editor and front end assets
        add_action('enqueue_block_assets', array(new wbfy_igi_Block, 'frontendInit'));

        // Add customiser widget handler
        add_action('widgets_init', array(new wbfy_igi_Widget, 'init'));

        // Load translations
        add_action('plugins_loaded', array($this, 'loadI18N'));
    }

    /**
     * Load I18N data
     */
    public function loadI18N()
    {
        load_plugin_textdomain('wbfy-icon-grid-it', false, dirname(plugin_basename(__FILE__)) . '/resources/languages/');
    }

    /**
     * Initialise plugin and options
     */
    public function activate()
    {
        wbfy_igi_Options::getInstance()->init();
    }

    /**
     * Deactivate plugin and remove options if required
     */
    public function deactivate()
    {
        $options = wbfy_igi_Options::getInstance();
        if (!isset($options->settings['config_data']['on_deactivate']) || $options->settings['config_data']['on_deactivate']) {
            $options->drop();
        }
    }
}
