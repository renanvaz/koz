<?php

namespace App\Controllers;

use Koz\Controller;
use Koz\Debug;
use Koz\Request;
use Koz\Input;
use Koz\View;

class Home extends Controller {
    public function POST_index () {
        echo 'BBBBBBBBBBBBBBBBBB'. "\n";
        echo Request::param('action')."\n";
        echo Request::param('id', 'NADA')."\n";
        echo Input::GET('teste', 'Não tem')."\n";
    }

    public function REQUEST_index () {

    }

    public function REQUEST_indexTest () {

    }
}
