<?php

namespace Controllers;

use \Koz\Controller;
use \Koz\Config;
use \Koz\Debug;
use \Koz\HTTP;
use \Koz\Input;
use \Koz\DB;
use \Koz\Messages;
use \Koz\Response;
use \Koz\Request;
use \Koz\View;
use \Koz\Data;
use \Koz\Router;

class Home extends Controller {
    public function GET_index () {
        $this->template->content = Router::get('default', ['controller' => 'c', 'action' => 'a', 'id' => '1']);
    }

    public function POST_index () {
        $this->template->content = 'POST'. "<br />";
        $this->template->content .= Request::param('controller')."<br />";
        $this->template->content .= Request::param('action')."<br />";
        $this->template->content .= Request::param('id', '123')."<br />";
        $this->template->content .= Input::GET('teste', 'Não tem GET')."<br />";
        $this->template->content .= Input::POST('teste', 'Não tem POST')."<br />";
    }

    public function REQUEST_index () {
        $test = new Data(['path1' => ['path2' => 'ASD']]);

        $test->set('path1.path2', 'REPLACED');
        $test->get('path1.path2');

        Response::body(\Helpers\Debug::vars($test));

        Messages::$lang = 'en-us';
        View::globals()->varGlobal = Messages::load('validation')->get('required');
        $this->template->content->varLocal = 'Test Local';


        // $q = new DB;

        // Response::body('Query: '.$q->select('test')
        //                                 ->distinct()
        //                                 ->fields('date', ['number' => 'numero'])
        //                                 ->set(['number' => 10], ['string' => 'My\'s "serious" test'], ['date' => date('Y-m-d H:i:s')])
        //                                 ->where('(number > ? AND string LIKE ?)')
        //                                 ->s());
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
