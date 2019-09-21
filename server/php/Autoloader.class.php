<?PHP
class wbfy_gli_Autoloader
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
        if (0 !== strpos($class, 'wbfy_gli_')) {
            return;
        }

        $file = WBFY_GLI_PLUGIN_DIR . 'server/php/' . str_replace(array('wbfy_gli_', '_'), array('', '/'), $class) . ".class.php";
        if (file_exists($file)) {
            require_once $file;
            return true;
        }
        return false;
    }
}
