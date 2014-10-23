<?php

namespace Koz;

class Exception extends \Exception {
    public function __construct ($message) {
        $info = debug_backtrace();

        //die(Helpers\Debug::vars($info));

        $this->code = 0;
        $this->severity = 0;
        $this->message = $message;
        $this->file = $info[1]['file'];
        $this->line = $info[1]['line'];
    }
}
