<?php
/**
 * Icon Grid It!
 * Customiser widget handler
 */
class wbfy_igi_Widget extends WP_Widget
{
    private $content = [];

    /***
     * Set widget info
     */
    public function __construct()
    {
        parent::__construct(
            'wbfy_igi_icon_grid_list_it', // Base ID
            esc_html__('Icon Grid It!', 'wbfy-icon-grid-it'), // Widget name in UI
            array(
                'description' => esc_html__('Add an icon feature grid', 'wbfy-icon-grid-it'), // Description in UI
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
        wp_enqueue_style('wp-color-picker');
        wp_enqueue_script('wp-color-picker');
        if (empty($instance)) {
            $instance = wbfy_igi_Grid::template();
        }
        echo wbfy_igi_Grid::display($instance);
    }

    /**
     * Widget customiser form
     *
     * @param array $instance content for instance from parent
     */
    public function form($instance)
    {
        echo wbfy_igi_Libs_Html_Inputs::render(
            'skin/customiser/widget.php',
            array(
                'options' => wbfy_igi_Options::getInstance()->settings,
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
        $instance = wbfy_igi_Grid::template();

        $instance['title']       = (isset($new_instance['title'])) ? sanitize_text_field($new_instance['title']) : '';
        $instance['title_align'] = (isset($new_instance['title_align'])) ? wbfy_igi_Libs_Sanitise::align($new_instance['title_align']) : '';
        $instance['icon_color']  = (isset($new_instance['icon_color'])) ? wbfy_igi_Libs_Sanitise::colorHex($new_instance['icon_color'], WBFY_DEFAULT_ICON_COLOR) : '';

        for ($i = 1; $i <= WBFY_IGI_MAX_ITEMS; $i++) {
            $instance['item' . $i . '_icon'] = (isset($new_instance['item' . $i . '_icon'])) ? sanitize_html_class($new_instance['item' . $i . '_icon']) : '';
            $instance['item' . $i . '_text'] = (isset($new_instance['item' . $i . '_text'])) ? sanitize_text_field($new_instance['item' . $i . '_text']) : '';
        }
        return $instance;
    }
}
