<?php

namespace Koz\Helpers;

class Debug {
    public static function vars () {
        $variables = func_get_args();

        $output = array();
        foreach ($variables as $var) {
            $output[] = print_r($var, TRUE);
        }

        return '<pre class="debug">'.implode("\n", $output).'</pre>';
    }
}
