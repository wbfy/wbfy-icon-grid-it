<?php
class wbfy_igi_Libs_WordPress_Functions
{
    public static function noYoastCanonicalise()
    {
        add_filter('wpseo_canonical', '__return_false');
    }

    /**
     * Render 'template' file with $data
     */
    public static function render($template, $data = array())
    {
        ob_start();
        include WBFY_IGI_PLUGIN_DIR . 'server/' . $template;
        return ob_get_clean();
    }

    public static function enqueueJQuery($style = 'smoothness')
    {
        // Ensure the jquery ui css is the same version as jquery ui itself
        global $wp_scripts;
        $jq = $wp_scripts->registered['jquery-ui-core']->ver;
        $jq = (is_null($jq)) ? '1.12.1' : $jq;
        wp_enqueue_style(
            'jquery-style',
            '//ajax.googleapis.com/ajax/libs/jqueryui/' . $jq . '/themes/' . $style . '/jquery-ui.css'
        );
    }

    public static function enqueueDatePicker()
    {
        wp_enqueue_script('jquery-ui-datepicker');
    }
}
