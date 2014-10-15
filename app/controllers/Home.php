<?php

namespace App\Controllers;

use Koz\Controller;
use Koz\Response;
use Koz\HTTP;
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

    public function REQUEST_redirect () {
        HTTP::redirect('home/index');
    }

    public function REQUEST_body () {
        Response::body("Teste\nbody");
    }

    public function REQUEST_raw () {
        Response::raw("Teste\nraw");
    }

    public function REQUEST_json () {
        Response::json(['status' => 1]);
    }

    public function REQUEST_download () {
        Response::download('public/media/img/nyantocat.gif');
    }

    public function REQUEST_indexTest () {

    }
}
