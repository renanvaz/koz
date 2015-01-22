<?php

class UCore {
    /**
     * Init the U pointer
     * @return void
     */
    public static function init () {
        U::init();
    }

    public static function proccess ($reports) {
        $status = TRUE;

        foreach ($reports['reports'] as &$report) {
            if (isset($report['reports'])) {
                $report = self::proccess($report);

                if (!$report['status']) {
                    $status = FALSE;
                }
            } else {
                if (!$report['status']) {
                    $status = FALSE;
                }
            }
        }

        $reports['status'] = $status;

        return $reports;
    }

    /**
     * Load a file with tests and create a group for this
     * @param  string $file Filename relative or absolute
     * @return void
     */
    public static function load ($file) {
        U::group('Test '.$file, function () use ($file) {
            require_once($file);
        });
    }

    /**
     * Get the file contents of a specific line
     * @param  string  $file
     * @param  integer $line
     * @return string
     */
    public static function getSnippet ($file, $line) {
        $handle = fopen($file, 'r');
        $snippet = '';

        if ($handle) {
            $l = 1;
            $pad = strlen($line);

            while (($fileline = fgets($handle)) !== false) {
                if ($l >= $line-4 AND $l <= $line+1) {
                    $snippet .= '<p'.($l == $line ? ' class="highlight"' : '').'><span>'.$l.'</span>'.str_replace(['\n', ' ', '\t'], ['\n', '&nbsp;', '&nbsp;&nbsp;&nbsp;&nbsp;'], htmlentities($fileline)).'</p>';
                }
                $l++;
            }
        }

        fclose($handle);

        return $snippet;
    }

    /**
     * Load a view
     * @param  string $filename
     * @param  array $data
     * @return string
     */
    public static function view ($filename, $data) {
        extract($data, EXTR_SKIP);

        ob_start();

        try {
            include $filename;
        } catch (Exception $e) {
            ob_end_clean();

            throw $e;
        }

        return ob_get_clean();
    }
}
