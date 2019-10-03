<?php
/**
 * Icon Grid It! Admin options handler
 */
class wbfy_igi_Options
{
    public $settings = null;

    /**
     * Singleton
     *
     * @return object Singleton instance
     */
    public function getInstance()
    {
        static $instance = null;
        if (is_null($instance)) {
            $me       = __CLASS__;
            $instance = new $me;
            return $instance;
        }
        return $instance;
    }

    /**
     * Load options from DB
     * Extend existing options to also include any new top level
     * options that may have been added during any plugin update
     */
    public function __construct()
    {
        $this->getDefaults();
        $settings = get_option('wbfy_igi');
        if (is_array($settings)) {
            $this->settings = wbfy_igi_Libs_Arrays::extend(
                $this->settings,
                $settings
            );
        }
    }

    /**
     * Delete options
     */
    public function drop()
    {
        delete_option('wbfy_igi');
    }

    /**
     * Called on plugin initialisation
     */
    public function init()
    {
        $this->getDefaults();
        add_option('wbfy_igi', $this->settings);
    }

    /**
     * Default options
     *
     * @return array Default options list
     */
    public function getDefaults()
    {
        $this->settings = array(
            'config_data' => array(
                'on_deactivate' => 0,
                'on_delete'     => 1,
            ),
            'fonts'       => array(
                'fa_kit_code' => '',
                'cdn_link'    => 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css',
            ),
        );
    }
}
