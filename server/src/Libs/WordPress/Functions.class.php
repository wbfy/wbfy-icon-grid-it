<?php
class wbfy_igi_Libs_WordPress_Functions
{
    /**
     * Render 'template' file with $data
     */
    public static function render($template, $data = array())
    {
        ob_start();
        include WBFY_IGI_PLUGIN_DIR . 'server/' . $template;
        return ob_get_clean();
    }

    /**
     * enqueue wp color picker
     */
    public static function registerColorPicker($enqueue = true)
    {
        wp_register_style('wp-color-picker');
        wp_reister_script('wp-color-picker');
        if ($enqueue) {
            wp_enqueue_style('wp-color-picker');
            wp_enqueue_script('wp-color-picker');
        }
    }
}
