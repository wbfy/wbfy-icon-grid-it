<?php
/**
 * Icon Grid It! Content template
 * used by both widget and shortcode
 */
class wbfy_igi_ContentTemplate
{
    /**
     * @param return blank list grid content
     */
    public function get()
    {
        $content                = array();
        $content['title']       = '';
        $content['title_align'] = 'center';
        $content['icon_color']  = WBFY_DEFAULT_ICON_COLOR;
        for ($i = 1; $i <= WBFY_IGI_MAX_ITEMS; $i++) {
            $content['item' . $i . '_icon'] = '';
            $content['item' . $i . '_text'] = '';
        }
    }
}
