<?php

namespace Koz;

class Config
{
    public static function load ($filename)
    {
        return new Data(include Core::find('configs/'.$filename));
    }
}

