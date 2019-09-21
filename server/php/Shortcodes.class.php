<?php
/**
 * Icon Grid It! Shortcode handler
 */
class wbfy_gli_Shortcodes
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
        $content                = wbfy_gli_ContentTemplate::get();
        $content['title']       = (!empty($attrs['title'])) ? $attrs['title'] : '';
        $content['title_align'] = (!empty($attrs['title_align'])) ? $attrs['title_align'] : 'left';
        for ($i = 1; $i <= WBFI_IGLI_MAX_ITEMS; $i++) {
            $content['item' . $i . '_icon'] = (!empty($attrs['icon' . $i])) ? $attrs['icon' . $i] : '';
            $content['item' . $i . '_text'] = (!empty($attrs['text' . $i])) ? $attrs['text' . $i] : '';
        }
        return wbfy_gli_Content::displayGrid($content);
    }
}
