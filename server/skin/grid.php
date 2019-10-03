<div class="wbfy-grid">
<?php
if (!empty($data['content']['title'])) {
    echo '<h2 style="text-align:' . esc_attr($data['content']['title_align']) . '">' . esc_html($data['content']['title']) . '</h2>';
}
?>
    <ul>
<?php
for ($i = 1; $i <= WBFY_IGI_MAX_ITEMS; $i++) {
    if (!empty($data['content']['item' . $i . '_icon'])) {
        ?>
    <li>
        <div class="wbfy-grid-icon" style="color:<?php echo esc_attr($data['content']['icon_color']) ?>">
            <span class="fa <?php echo esc_attr($data['content']['item' . $i . '_icon']); ?>"></span>
        </div>
        <div class="wbfy-grid-text">
            <?php echo esc_html($data['content']['item' . $i . '_text']); ?>
        </div>
    </li>
<?php
}
}
?>
    </ul>
</div>
