<?php

namespace App\Controllers;

use Koz\Controller;
use Koz\Debug;
use Koz\Request;
use Koz\Input;

class Home extends Controller {
    public function GET_index () {
        echo 'BBBBBBBBBBBBBBBBBB'. "\n";
        echo Request::param('id', 'NADA')."\n";
        echo Input::GET('teste', 'Não tem')."\n";
    }

    public function REQUEST_index () {
        echo 'AAAAAAAAAAAAAAAAAA';
    }

    public function REQUEST_indexTest () {
        echo 'CCCCCCCCCCCCCCCCC';
    }
}
