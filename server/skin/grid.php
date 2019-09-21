<div class="wbfy-grid">
<?php
if (!empty($data['content']['title'])) {
    echo '<h2 style="text-align:' . esc_attr($data['content']['title_align']) . '">' . esc_html($data['content']['title']) . '</h2>';
}
?>
    <ul>
<?php
for ($i = 1; $i <= WBFI_IGLI_MAX_ITEMS; $i++) {
    if (!empty($data['content']['item' . $i . '_icon'])) {
        ?>
    <li>
        <div class="wbfy-grid-icon" style="<?php echo $data['options']['styles']['icon']; ?>">
            <span class="<?php echo 'wbfy-' . $data['content']['item' . $i . '_icon']; ?>"></span>
        </div>
        <div class="wbfy-grid-text">
            <?php echo $data['content']['item' . $i . '_text']; ?>
        </div>
    </li>
<?php
}
}
?>
    </ul>
</div>
