<?php

namespace TRF4\UI;

use TRF4\UI\Helper\Ajax;
use TRF4\UI\Util\Option;

class Helper
{

    public static function ajax(string $method, string $action): Helper\Ajax
    {
        return new Ajax($method, $action);
    }

    public static function option(): Option
    {
        return new Option();
    }
}
