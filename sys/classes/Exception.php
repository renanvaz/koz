<?php

namespace Koz;

class Exception extends \Exception {
    public function __construct($message, $file, $line) {
        $this->code = 0;
        $this->severity = 0;
        $this->message = $message;
        $this->file = $file;
        $this->line = $line;
    }

    public function render(){
        $message    = $this->message;
        $file       = $this->file;
        $line       = $this->line;
        $trace      = str_replace(['#', '\n'], ['<p>#', '</p>'], $this->getTraceAsString());
        $snippet    = '';

        $handle = fopen($file, 'r');

        if ($handle) {
            $l = 1;
            $numLines = 4;
            $pad = strlen($line);

            while (($fileline = fgets($handle)) !== false) {
                if ($l >= $line-$numLines AND $l <= $line+$numLines) {
                    $snippet .= '<p'.($l == $line ? ' class="highlight"' : '').'><span>'.$l.'</span>'.str_replace(['\n', ' ', '\t'], ['\n', '&nbsp;', '&nbsp;&nbsp;&nbsp;&nbsp;'], htmlentities($fileline)).'</p>';
                }
                $l++;
            }
        }

        fclose($handle);

        return View::make('errors/debug', ['message' => $message, 'file' => str_replace(PRIVATE_PATH, '', $file), 'line' => $line, 'snippet' => $snippet, 'trace' => $trace])->render();
    }
}
