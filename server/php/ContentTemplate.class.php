<?php
/**
 * Icon Grid It! Content template
 * used by both widget and shortcode
 */
class wbfy_gli_ContentTemplate
{
    /**
     * @param return blank list grid content
     */
    public function get()
    {
        $content                = array();
        $content['title']       = '';
        $content['title_align'] = 'left';
        for ($i = 1; $i <= WBFI_IGLI_MAX_ITEMS; $i++) {
            $content['item' . $i . '_icon'] = '';
            $content['item' . $i . '_text'] = '';
        }
    }
}
