<?php
/**
 * Icon Grid It!
 * Output frontend plugin content
 * Shared by widgets and shortcodes
 */
class wbfy_igi_Content
{
    /**
     * Display icon grid
     *
     * @param array $instance  contents for instance
     */
    public static function displayGrid($instance)
    {
        wp_enqueue_style(
            'wbfy-grid',
            plugins_url('/wbfy-icon-grid-it/resources/css/wbfy-icon-grid-it-frontend.min.css'),
            false,
            WBFY_IGI_VERSION
        );
        wp_enqueue_style('font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css');

        return wbfy_igi_Libs_WordPress_Functions::render(
            'skin/grid.php',
            array(
                'options' => wbfy_igi_Options::getInstance()->settings,
                'content' => $instance,
            )
        );
    }
}
