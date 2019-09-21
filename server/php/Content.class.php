<?php
/**
 * Icon Grid It! Output frontend plugin content
 * used for widgets and shortcodes
 */
class wbfy_gli_Content
{
    /**
     * Display icon grid
     *
     * @param array $instance  contents for instance
     */
    public static function displayGrid($instance)
    {
        // Load icon font
        wp_enqueue_style('wbfy-icon-font', plugins_url('/wbfy-icon-grid-it/resources/fonts/wbfy-icon-font/styles.css'), false, WBFY_GLI_VERSION);
        wp_enqueue_style('wbfy-grid', plugins_url('/wbfy-icon-grid-it/resources/css/wbfy-icon-grid-it.min.css'), false, WBFY_GLI_VERSION);
        return wbfy_gli_Libs_WordPress_Functions::render(
            'skin/grid.php',
            array(
                'options' => wbfy_gli_Options::getInstance()->settings,
                'content' => $instance,
            )
        );
    }
}
