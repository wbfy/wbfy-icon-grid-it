<?PHP
class wbfy_igi_Autoloader
{
    /**
     * Register autoloader
     */
    public static function register()
    {
        ini_set('unserialize_callback_func', 'spl_autoload_call');
        spl_autoload_register(array(new self, 'autoload'));
    }

    /**
     * Autoload function
     *
     * @param string $class The class being autoloaded
     */
    public static function autoload($class)
    {
        if (0 !== strpos($class, 'wbfy_igi_')) {
            return;
        }

        $file = WBFY_IGI_PLUGIN_DIR . 'server/php/' . str_replace(array('wbfy_igi_', '_'), array('', '/'), $class) . ".class.php";
        if (file_exists($file)) {
            require_once $file;
            return true;
        }
        return false;
    }
}
