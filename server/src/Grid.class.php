<?php
/**
 * Icon Grid It!
 * Output frontend plugin content
 * Shared by widgets and shortcodes
 */
class wbfy_igi_Grid
{
    const FONT_ID = 'wbfy-icon-grid-it-font-cdn';

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

    /**
     * Load font from CDN
     * The link can be a .js script or css file
     */
    public static function registerFont($enqueue = true)
    {
        $options = wbfy_igi_Options::getInstance();

        if (preg_match('/\.js$/', $options->settings['fonts']['cdn_link'])) {
            wp_register_script(self::FONT_ID, $options->settings['fonts']['cdn_link']);
            if ($enqueue) {
                wp_enqueue_script(self::FONT_ID);
            }
        } else {
            wp_register_style(self::FONT_ID, $options->settings['fonts']['cdn_link']);
            if ($enqueue) {
                wp_enqueue_style(self::FONT_ID);
            }
        }
        return $id;
    }

    /**
     * Common styles
     */
    public static function registerFrontEndStyle($enqueue = true)
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
