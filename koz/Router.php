<?php

namespace Koz;

class Router {

    const REGEX_GROUP   = '\(((?:(?>[^()]+)|(?R))*)\)';

    // Defines the pattern of a <segment>
    const REGEX_KEY     = '<([a-zA-Z0-9_]++)>';

    // What can be part of a <segment> value
    const REGEX_SEGMENT = '[^/.,;?\n]++';

    // What must be escaped in the route regex
    const REGEX_ESCAPE  = '[.\\+*?[^\\]${}=!|]';

    static public function parse($uri) {

    }
}
