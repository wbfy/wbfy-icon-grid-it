<?php
/**
 * Icon Grid It! widget handler
 * extends WP_Widget
 */
class wbfy_gli_Widget extends WP_Widget
{
    private $content = [];

    /***
     * Set widget info
     */
    public function __construct()
    {
        parent::__construct(
            'wbfy_gli_icon_grid_list_it', // Base ID
            __('Icon Grid It!', 'wbfy-icon-grid-it'), // Widget name in UI
            array(
                'description' => __('Add an icon grid or list', 'wbfy-icon-grid-it'), // Description in UI
            )
        );
    }

    /**
     * Initialise and register widget
     */
    public function init()
    {
        register_widget($this);
    }

    /**
     * Show widget content
     *
     * @param array $args passed from the WP_Widget parent
     * @param array $instance content for instance from parent
     */
    public function widget($args, $instance)
    {
        if (empty($instance)) {
            $instance = wbfy_gli_ContentTemplate::get($instance);
        }
        echo wbfy_gli_Content::displayGrid($instance);
    }

    /**
     * Widget customiser form
     *
     * @param array $instance content for instance from parent
     */
    public function form($instance)
    {
        echo wbfy_gli_Libs_WordPress_Functions::render(
            'skin/customiser/widget.php',
            array(
                'options' => wbfy_gli_Options::getInstance()->settings,
                'content' => $instance,
                'widget'  => $this,
            )
        );
    }

    /**
     * Parse and update widget contents
     *
     * @param array $new_instance new updated instance content
     * @param array $old_instance old instance content
     */
    public function update($new_instance, $old_instance)
    {
        $instance                = wbfy_gli_ContentTemplate::get($instance);
        $instance['title']       = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';
        $instance['title_align'] = (!empty($new_instance['title_align'])) ? strip_tags($new_instance['title_align']) : 'left';
        for ($i = 1; $i <= WBFI_IGLI_MAX_ITEMS; $i++) {
            $instance['item' . $i . '_icon'] = (!empty($new_instance['item' . $i . '_icon'])) ? strip_tags($new_instance['item' . $i . '_icon']) : '';
            $instance['item' . $i . '_text'] = (!empty($new_instance['item' . $i . '_text'])) ? strip_tags($new_instance['item' . $i . '_text']) : '';
        }
        return $instance;
    }
}
