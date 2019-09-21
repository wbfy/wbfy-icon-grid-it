<?php
/**
 * Main plugin loader
 */
class wbfy_gli_Main
{
    /**
     * Initialise plugin and menus
     */
    public function __construct()
    {
        register_activation_hook(WBFY_GLI_PLUGIN_DIR . '/wbfy-icon-grid-it.php', array($this, 'activate'));
        register_deactivation_hook(WBFY_GLI_PLUGIN_DIR . '/wbfy-icon-grid-it.php', array($this, 'deactivate'));

        // Icon Grid It! admin init
        add_action('admin_init', array(new wbfy_gli_Admin, 'init'));
        add_action('admin_menu', array(new wbfy_gli_Admin, 'addToMenu'));

        // Icon Grid It! set options
        add_action('init', array(new wbfy_gli_Shortcodes, 'init'));
        add_action('widgets_init', array(new wbfy_gli_Widget, 'init'));
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
        wbfy_gli_Options::getInstance()->init();
    }

    /**
     * Deactivate plugin and remove options if required
     */
    public function deactivate()
    {
        $options = wbfy_gli_Options::getInstance();
        if (!isset($options->settings['config_data']['on_deactivate']) || $options->settings['config_data']['on_deactivate']) {
            $options->drop();
        }
    }
}
