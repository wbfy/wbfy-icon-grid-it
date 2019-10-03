<?php
/**
 * Icon Grid It!
 * Output frontend plugin content
 * Shared by widgets and shortcodes
 */
class wbfy_igi_Grid
{
    /**
     * Display icon grid
     *
     * @param array $instance  contents for instance
     */
    public static function display($instance)
    {
        wbfy_igi_Grid::registerFrontEndStyle();
        wbfy_igi_Grid::registerFont();

        return wbfy_igi_Libs_WordPress_Functions::render(
            'skin/grid.php',
            array(
                'content' => $instance,
            )
        );
    }

    public static function template()
    {
        $template = array(
            'title'       => '',
            'title_align' => 'center',
            'icon_color'  => WBFY_DEFAULT_ICON_COLOR,
        );

        for ($i = 1; $i <= WBFY_IGI_MAX_ITEMS; $i++) {
            $template['item' . $i . '_icon'] = '';
            $template['item' . $i . '_text'] = '';
        }

        return $template;
    }

    public static function registerFont($enqueue = true)
    {
        $id      = 'wbfy-icon-grid-it-font-cdn';
        $options = wbfy_igi_Options::getInstance()->settings;
        wp_register_style($id, $options['fonts']['cdn_link']);

        if ($enqueue) {
            wp_enqueue_style($id);
        }

        return $id;
    }

    /**
     * Common styles
     */
    private function enqueueFrontEndStyle($enqueue = true)
    {
        $id = 'wbfy-icon-grid-it-frontend-css';
        // Frontend CSS
        wp_register_style(
            $id,
            plugins_url('/wbfy-icon-grid-it/resources/css/wbfy-icon-grid-it-frontend.min.css'),
            array('wp-blocks'),
            WBFY_IGI_VERSION
        );

        if ($enqueue) {
            wp_enqueue_style($id);
        }

        return $id;
    }

}
