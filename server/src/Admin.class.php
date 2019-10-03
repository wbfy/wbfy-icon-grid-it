<?php
class wbfy_igi_Admin
{
    /**
     * Initialise Icon Grid It! options page
     * Set up actions and filters for Admin functions
     */
    public function init()
    {
        register_setting(
            'wbfy_igi_options', // Option group.
            'wbfy_igi', // Option name (in wp_options)
            array($this, 'validate') // Sanitation callback
        );
        add_filter('plugin_action_links_wbfy-icon-grid-it/wbfy-icon-grid-it.php', array($this, 'pluginPageSettingsLink'));
        $this->registerForm();
    }

    /**
     * Add 'settings' option onto WP Plugins page
     *
     * @param array  $links links for WP Plugin page
     * @return array $links With new settings link added
     */
    public function pluginPageSettingsLink($links)
    {
        $url = esc_url(
            add_query_arg(
                'page',
                'wbfy-icon-grid-it',
                get_admin_url() . 'admin.php'
            )
        );
        $settings_link = "<a href='$url'>" . __('Settings', 'wbfy-icon-grid-it') . '</a>';
        array_unshift($links, $settings_link);
        return $links;
    }

    /**
     * Add Icon Grid It! to settings menu
     */
    public function addToMenu()
    {
        add_options_page(
            __('Icon Grid It!', 'wbfy-icon-grid-it'), // Page title
            __('Icon Grid It!', 'wbfy-icon-grid-it'), // Menu title
            'manage_options', // Capability/permission required
            'wbfy-icon-grid-it', // Page slug (unique id)
            array($this, 'render') // Renderer callback
        );
    }

    /**
     * Add form and settings
     */
    private function registerForm()
    {
        // Font settings section
        add_settings_section(
            'wbfy_igi_fonts',
            __('Fonts', 'wbfy-icon-grid-it'),
            array($this, 'sectionConfigData'),
            'wbfy_igi_options'
        );

        add_settings_field(
            'wbfy_igi_fonts_fa_kit_code',
            __('FA Kit Code', 'wbfy-icon-grid-it'),
            array($this, 'fieldFontsFAKitCode'),
            'wbfy_igi_options',
            'wbfy_igi_fonts'
        );

        add_settings_field(
            'wbfy_igi_fonts_cdn_link',
            __('Font CDN Link', 'wbfy-icon-grid-it'),
            array($this, 'fieldFontsCDNLink'),
            'wbfy_igi_options',
            'wbfy_igi_fonts'
        );

        // Config data settings fields
        add_settings_section(
            'wbfy_igi_config_data',
            __('Configuration Data', 'wbfy-icon-grid-it'),
            array($this, 'sectionConfigData'),
            'wbfy_igi_options'
        );

        add_settings_field(
            'wbfy_igi_config_data_on_deactivate',
            __('Deactivated', 'wbfy-icon-grid-it'),
            array($this, 'fieldConfigDataOnDeactivate'),
            'wbfy_igi_options',
            'wbfy_igi_config_data'
        );

        add_settings_field(
            'wbfy_igi_config_data_on_delete',
            __('Deleted', 'wbfy-icon-grid-it'),
            array($this, 'fieldConfigDataOnDelete'),
            'wbfy_igi_options',
            'wbfy_igi_config_data'
        );
    }

    /**
     * Render Config Data options header
     */
    public function sectionFonts()
    {
        echo '<p>' . __('Use custom font-awesome kit', 'wbfy-icon-grid-it') . '</p>';
    }

    public function fieldFontsFAKitCode()
    {
        $options = wbfy_igi_Options::getInstance();

        echo wbfy_igi_Libs_Html_Inputs::inputText(
            array(
                'id'        => 'wbfy_igi_fonts_fa_kit_code',
                'name'      => 'wbfy_igi[fonts][fa_kit_code]',
                'maxlength' => '10',
                'size'      => '10',
                'value'     => $options->settings['fonts']['fa_kit_code'],
            )
        );
    }

    public function fieldFontsCDNLink()
    {
        $options = wbfy_igi_Options::getInstance();

        echo wbfy_igi_Libs_Html_Inputs::inputText(
            array(
                'id'        => 'wbfy_igi_fonts_cdn_link',
                'name'      => 'wbfy_igi[fonts][cdn_link]',
                'maxlength' => '150',
                'size'      => '80',
                'value'     => $options->settings['fonts']['cdn_link'],
            )
        );
    }

    /**
     * Render Config Data options header
     */
    public function sectionConfigData()
    {
        echo '<p>' . __('Remove all configuration data for this plugin when it is:', 'wbfy-icon-grid-it') . '</p>';
    }

    /**
     * Render on_deactivate field
     */
    public function fieldConfigDataOnDeactivate()
    {
        $options = wbfy_igi_Options::getInstance();

        echo wbfy_igi_Libs_Html_Inputs::inputCheck(
            array(
                'id'    => 'wbfy_igi_config_data_on_deactivate',
                'name'  => 'wbfy_igi[config_data][on_deactivate]',
                'value' => $options->settings['config_data']['on_deactivate'],
            )
        );
    }

    /**
     * Render on_delete/uninstall field
     */
    public function fieldConfigDataOnDelete()
    {
        $options = wbfy_igi_Options::getInstance();

        echo wbfy_igi_Libs_Html_Inputs::inputCheck(
            array(
                'id'    => 'wbfy_igi_config_data_on_delete',
                'name'  => 'wbfy_igi[config_data][on_delete]',
                'value' => $options->settings['config_data']['on_delete'],
            )
        );
    }

    /**
     * Validate and sanitize inputs
     */
    public function validate($input)
    {
        $input['config_data']['on_deactivate'] = (isset($input['config_data']['on_deactivate'])) ? true : false;
        $input['config_data']['on_delete']     = (isset($input['config_data']['on_delete'])) ? true : false;

        $input['fonts']['fa_kit_code'] = wbfy_igi_Libs_Sanitise::AlphaNumeric($input['fonts']['fa_kit_code']);
        $input['fonts']['cdn_link']    = esc_url_raw($input['fonts']['cdn_link']);

        return $input;
    }

    /**
     * Render Icon Grid It! options page
     */
    public function render()
    {
        if (!current_user_can('update_plugins')) {
            wp_die(__('You do not have sufficient permissions to access this page.', 'wbfy-icon-grid-it'));
        }

        wp_enqueue_style(
            'wbfy-icon-grid-it-css',
            plugins_url('/wbfy-icon-grid-it/resources/css/wbfy-icon-grid-it-admin.min.css'),
            false,
            WBFY_IGI_VERSION
        );

        echo wbfy_igi_Libs_WordPress_Functions::render(
            'skin/admin.php',
            wbfy_igi_Options::getInstance()->settings
        );
    }
}
