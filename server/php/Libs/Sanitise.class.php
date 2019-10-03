<?php
class wbfy_igi_Libs_Sanitise
{
    /**
     * Shortcut to validate css align property
     */
    public static function align($input = '')
    {
        return self::list(strtolower($input), array('center', 'left', 'right'));
    }

    public static function colorHex($input, $default = '#ffa500')
    {
        $input = strtolower(sanitise_text_field($input));
        if (!preg_match('/^#(?:[0-9a-f]{3}){1,2}$/', $input)) {
            return $default;
        }
        return $input;
    }

    /**
     * Sanitise input field and check it is in supplied list
     * return input if found, or first element from list if not
     */
    function list($input, $list) {
        $input = sanitise_text_field($input);
        if (in_array($input, $list)) {
            return $input;
        } else {
            return $list[0];
        }
    }
}
