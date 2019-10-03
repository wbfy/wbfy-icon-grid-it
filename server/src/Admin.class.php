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
            esc_html__('Icon Grid It!', 'wbfy-icon-grid-it'), // Page title
            esc_html__('Icon Grid It!', 'wbfy-icon-grid-it'), // Menu title
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
            'wbfy_igi_cdn',
            esc_html__('Content Delivery Network', 'wbfy-icon-grid-it'),
            array($this, 'sectionCDN'),
            'wbfy_igi_options'
        );

        add_settings_field(
            'wbfy_igi_cdn_link',
            esc_html__('Link', 'wbfy-icon-grid-it'),
            array($this, 'fieldsCDNLink'),
            'wbfy_igi_options',
            'wbfy_igi_cdn'
        );

        // Config data settings fields
        add_settings_section(
            'wbfy_igi_config_data',
            esc_html__('Configuration Data', 'wbfy-icon-grid-it'),
            array($this, 'sectionConfigData'),
            'wbfy_igi_options'
        );

        add_settings_field(
            'wbfy_igi_config_data_on_deactivate',
            esc_html__('Deactivated', 'wbfy-icon-grid-it'),
            array($this, 'fieldConfigDataOnDeactivate'),
            'wbfy_igi_options',
            'wbfy_igi_config_data'
        );

        add_settings_field(
            'wbfy_igi_config_data_on_delete',
            esc_html__('Deleted', 'wbfy-icon-grid-it'),
            array($this, 'fieldConfigDataOnDelete'),
            'wbfy_igi_options',
            'wbfy_igi_config_data'
        );
    }

    /**
     * Render Config Data options header
     */
    public function sectionCDN()
    {
        $
        $html = __('Icon Grid It! will download the icon font it uses from a content delivery network.') . ' ';
        $html .= __('You can change the link used below.', 'wbfy-icon-grid-it') . ' ';
        $html .= __('Its smart enough to distinguish between scripts and css.', 'wbfy-icon-grid-it') . ' ';
        $html .= __('In most situations though, the default will be fine.', 'wbfy-icon-grid-it') . ' ';
        $html = esc_html($html);
        echo '<p>' . $html . '</p>';
    }

    public function fieldCDNLink()
    {
        $options = wbfy_igi_Options::getInstance();

        echo wbfy_igi_Libs_Html_Inputs::inputText(
            array(
                'id'        => 'wbfy_igi_cdn_link',
                'name'      => 'wbfy_igi[cdn][link]',
                'maxlength' => '150',
                'size'      => '80',
                'value'     => $options->settings['cdn']['link'],
            )
        );
    }

    /**
     * Render Config Data options header
     */
    public function sectionConfigData()
    {
        echo '<p>' . esc_html__('Remove all configuration data for this plugin when it is:', 'wbfy-icon-grid-it') . '</p>';
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

        $input['cdn']['link'] = esc_url_raw($input['cdn']['link']);

        return $input;
    }

    /**
     * Render Icon Grid It! options page
     */
    public function render()
    {
        if (!current_user_can('update_plugins')) {
            wp_die(esc_html__('You do not have sufficient permissions to access this page.', 'wbfy-icon-grid-it'));
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
