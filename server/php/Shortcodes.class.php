<?php
/**
 * Icon Grid It!
 * Shortcode handler
 */
class wbfy_igi_Shortcodes
{
    private $content = [];

    /**
     * Initialise shortcodes
     */
    public function init()
    {
        // Icon Grid It! shortcodes
        add_shortcode('wbfy_icon_grid', array($this, 'shortcodeIconGrid'));
    }

    /**
     * Display icon grid list
     *
     * @param array $attrs input attributes from shortcode
     */
    public function shortcodeIconGrid($attrs)
    {
        $content                = wbfy_igi_ContentTemplate::get();
        $content['title']       = (!empty($attrs['title'])) ? $attrs['title'] : '';
        $content['title_align'] = (!empty($attrs['title_align'])) ? $attrs['title_align'] : 'left';
        $content['icon_color']  = (!empty($attrs['icon_color'])) ? $attrs['icon_color'] : WBFY_DEFAULT_ICON_COLOR;

        for ($i = 1; $i <= WBFY_IGI_MAX_ITEMS; $i++) {
            $content['item' . $i . '_icon'] = (!empty($attrs['icon' . $i])) ? $attrs['icon' . $i] : '';
            $content['item' . $i . '_text'] = (!empty($attrs['text' . $i])) ? $attrs['text' . $i] : '';
        }
        return wbfy_igi_Content::displayGrid($content);
    }
}
