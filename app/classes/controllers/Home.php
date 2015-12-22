<?php

namespace Controllers;

use \Koz\Enum\HTTP;

use \Koz\Controller;
use \Koz\View;

use \Koz\Route;
use \Koz\Request;
use \Koz\Response;
use \Koz\Input;

use \Koz\Data;
use \Koz\Config;
use \Koz\Messages;
use \Helpers\Debug;

class Home extends Controller {
    public function GET_index () {
        // View::globals()->varGlobal = 'Test Global';
        // $this->template->content->varLocal = Messages::load('validation')->get('required')->parse(['field' => 'Teste']);

        // $this->template = Messages::load('validation')->get('required')->parse(['field' => 'Teste']);
        // $this->template = Messages::load('validation')->required->parse(['field' => 'Teste']);

        // \Koz\Route::set('default', ':controller/:action/:id', ['id' => '[0-9]+'])
        \Koz\Route::set('test', ':lang/?:controller/:test/a/?:action/?how/?:id', ['id' => '[0-9]+'])
            ->defaults(['controller' => 'home', 'action' => 'index']);

        $this->template = Route::get('test')->uri(['lang' => 'pt-br', 'test' => 'koz', 'controller' => 'test', 'action' => 'action', 'id' => '123']);

        // $this->template->content = Route::get('default')->uri(['controller' => 'c', 'action' => 'a', 'id' => '1']);
    }

    public function GET_indexTest () {
        $this->template->content = '';
        $this->template->content .= Request::param('controller')."<br />";
        $this->template->content .= Request::$controller."<br />";
        $this->template->content .= Request::param('action')."<br />";
        $this->template->content .= Request::$action."<br />";
        $this->template->content .= Request::param('id', '123')."<br />";
        $this->template->content .= Input::GET('teste', 'Não tem GET')."<br />";
        $this->template->content .= Input::POST('teste', 'Não tem POST')."<br />";
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

        Response::body(Debug::vars($test));

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
