<p>
    <label for="<?php echo $data['widget']->get_field_id('title' . $i); ?>"><?php _e('Title:', 'wbfy-icon-grid-it');?></label>
    <input
        type="text"
        id="<?php echo $data['widget']->get_field_id('title'); ?>"
        name="<?php echo $data['widget']->get_field_name('title'); ?>"
        value="<?php echo esc_attr($data['content']['title']); ?>"
    >
</p>
<div>
    <select
        id="<?php echo $data['widget']->get_field_id('title_align'); ?>"
        title="<?php _e('Title alignment', 'wbfy-icon-grid-it');?>"
        name="<?php echo $data['widget']->get_field_name('title_align'); ?>"
    >
        <option value="left"<?php echo ($data['content']['title_align'] == 'left') ? ' selected' : ''; ?> >
            <?php echo _e('Aligned Left', 'wbfy-icon-grid-it'); ?>
        </option>
        <option value="right"<?php echo ($data['content']['title_align'] == 'right') ? ' selected' : ''; ?> >
            <?php echo _e('Aligned Right', 'wbfy-icon-grid-it'); ?>
        </option>
        <option value="center"<?php echo ($data['content']['title_align'] == 'center') ? ' selected' : ''; ?> >
            <?php echo _e('Centered', 'wbfy-icon-grid-it'); ?>
        </option>
    </select>
</div>
<p>
    <label for="<?php echo $data['widget']->get_field_id('icon_color' . $i); ?>"><?php _e('Icon Color:', 'wbfy-icon-grid-it');?></label>
    <input
        type="text"
        class="wbfy-color-picker"
        id="<?php echo $data['widget']->get_field_id('icon_color'); ?>"
        name="<?php echo $data['widget']->get_field_name('icon_color'); ?>"
        data-default-color="<?php echo esc_attr($data['content']['icon_color']); ?>"
        value="<?php echo esc_attr($data['content']['icon_color']); ?>"
    >
</p>
<?php
for ($i = 1; $i <= WBFY_IGI_MAX_ITEMS; $i++) {
    ?>
<p>
    <label for="<?php echo $data['widget']->get_field_id('item' . $i); ?>"><?php _e('Item ' . $i . ':', 'wbfy-icon-grid-it');?></label>
    <input
        type="text"
        placeholder="<?php _e('Icon', 'wbfy-icon-grid-it');?>"
        id="<?php echo $data['widget']->get_field_id('item' . $i . '_icon'); ?>"
        name="<?php echo $data['widget']->get_field_name('item' . $i . '_icon'); ?>"
        value="<?php echo esc_attr($data['content']['item' . $i . '_icon']); ?>"
    >
</p>
<div>
    <input
        type="text"
        placeholder="<?php _e('Text', 'wbfy-icon-grid-it');?>"
        id="<?php echo $data['widget']->get_field_id('item' . $i . '_text'); ?>"
        name="<?php echo $data['widget']->get_field_name('item' . $i . '_text'); ?>"
        value="<?php echo esc_attr($data['content']['item' . $i . '_text']); ?>"
    >
</div>
<?php
}
?>
<!-- initialise color picker -->
<script>
(
    function($, id)
    {
        $('#'+id).wpColorPicker(
            {
                change: function()
                {
                    setTimeout(
                        function()
                        {
                            $('#'+id).trigger('change');
                        },
                        500
                    );
                }
            }
        );
    }
)(jQuery, <?php echo "'" . $data['widget']->get_field_id('icon_color') . "'"; ?>);
</script>