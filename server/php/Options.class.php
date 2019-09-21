<?php
/**
 * Icon Grid It! Admin options handler
 */
class wbfy_gli_Options
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
        $settings = get_option('wbfy_gli');
        if (is_array($settings)) {
            $this->settings = wbfy_gli_Libs_Arrays::extend(
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
        delete_option('wbfy_gli');
    }

    /**
     * Called on plugin initialisation
     */
    public function init()
    {
        $this->getDefaults();
        add_option('wbfy_gli', $this->settings);
    }

    /**
     * Default options
     *
     * @return array Default options list
     */
    public function getDefaults()
    {
        $this->settings = array(
            'styles'      => array(
                'icon' => 'background-color:transparent;color:rgba(237,145,7,1);font-size:3rem',
            ),
            'config_data' => array(
                'on_deactivate' => 0,
                'on_delete'     => 1,
            ),
        );
    }
}
