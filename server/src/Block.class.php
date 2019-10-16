<?php
/**
 * Icon Grid It!
 * Gutenberg editor block handler
 * https://amandagiles.com/blog/meetups/building-gutenberg-block/
 */
class wbfy_igi_Block
{
    /**
     * Enqueue scripts and styles for front end
     */
    public function frontendInit()
    {
        wbfy_igi_Grid::registerFrontEndStyle();
        wbfy_igi_Grid::registerFont();
    }

    /**
     * Enqueue scripts and styles for admin
     * Register block
     */
    public function adminInit()
    {
        wp_register_script(
            'wbfy-icon-grid-it-block-js',
            plugins_url('/wbfy-icon-grid-it/resources/js/wbfy-icon-grid-it-block.min.js'),
            array('wp-blocks', 'wp-editor', 'wp-components', 'wp-i18n', 'wp-element'),
            WBFY_IGI_VERSION
        );

        wp_register_style(
            'wbfy-icon-grid-it-block-editor-css',
            plugins_url('/wbfy-icon-grid-it/resources/css/wbfy-icon-grid-it-block-editor.min.css'),
            array('wp-edit-blocks'),
            WBFY_IGI_VERSION
        );

        wbfy_igi_Grid::registerFont();

        register_block_type(
            'wbfy/icon-grid-it',
            array(
                'editor_script' => 'wbfy-icon-grid-it-block-js',
                'editor_style'  => 'wbfy-icon-grid-it-block-editor-css',
                'style'         => wbfy_igi_Grid::registerFrontEndStyle(false),
            )
        );
    }
}
