<?php

namespace Koz;

class Exception extends \Exception {
    public function __construct ($message, $file, $line) {
        $this->code = 0;
        $this->severity = 0;
        $this->message = $message;
        $this->file = $file;
        $this->line = $line;
    }
}
