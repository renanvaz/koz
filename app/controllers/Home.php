<?php

namespace App\Controllers;

class Home extends \Koz\Controller {
    public function GET_index () {
        echo \Koz\Debug::vars(\Koz\Request::param('id'));
    }

    public function REQUEST_index () {
        echo 'AAAAAAAAAAAAAAAAAA';
    }
}
