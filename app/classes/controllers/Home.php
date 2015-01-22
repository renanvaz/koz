<?php

namespace Controllers;

use \Koz\Controller;
use \Koz\Config;
use \Koz\Debug;
use \Koz\HTTP;
use \Koz\Input;
use \Koz\QueryBuilder;
use \Koz\Messages;
use \Koz\Response;
use \Koz\Request;
use \Koz\View;


class QB {
    public static function _AND ($column, $op, $value) {
        return ['AND', $column, $op, $value];
    }

    public static function _OR ($column, $op, $value) {
        return ['AND', $column, $op, $value];
    }

    public static function _EXPR ($expr) {
        return $expr;
    }
}

class Home extends Controller {
    public function POST_index () {
        echo 'BBBBBBBBBBBBBBBBBB'. "\n";
        echo Request::param('action')."\n";
        echo Request::param('id', 'NADA')."\n";
        echo Input::GET('teste', 'Não tem')."\n";
    }

    public function REQUEST_index () {
        $q = new QueryBuilder;

        Response::body($q->select('table')->where(QB::_AND('field_2', '>', 100), QB::_OR('field_3', 'LIKE', '%test%')));
    }

    public function REQUEST_test () {
        //Response::body(Config::load('app')->get('title'));
        Response::body(Config::load('app')->get('GA.UA'));
        //Response::body(Config::load('messages/pt-br/validation')->get('required'));
        //Response::body(Messages::get('validation', 'required'));
        //Response::body(Messages::get('validation', 'required', 'en-us'));

        Messages::$lang = 'en-us';
        Response::body(Messages::get('validation', 'required'));
    }

    public function REQUEST_redirect () {
        HTTP::redirect('home/index', 301);
    }

    public function REQUEST_body () {
        Response::body("Teste\nbody<br />break açênto");
    }

    public function REQUEST_raw () {
        Response::raw("Teste\nraw<br />break açênto");
    }

    public function REQUEST_json () {
        Response::json(['status' => 1]);
    }

    public function REQUEST_download () {
        Response::download('public/media/img/nyantocat.gif');
    }

    public function REQUEST_indexTest () {
        //echo $this->template->content->test;
    }
}
