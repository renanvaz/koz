<?php

namespace Koz;

abstract class Controller {

    public $template = 'partials/template/base';

    /**
     * Automatically executed before the controller action. Can be used to set
     * class properties, do authorization checks, and execute other custom code.
     *
     * @return  void
     */
    public function before () {
        $this->template             = View::make('partials/template/base');
        $this->template->header     = View::make('partials/template/header');
        $this->template->footer     = View::make('partials/template/footer');

        if (file_exists(APP_PATH.'views/pages/'.Request::$controller.'/'.Request::$action.'.php')) {
            $this->template->content    = View::make('pages/'.Request::$controller.'/'.Request::$action);
        }
    }

    /**
     * Automatically executed after the controller action. Can be used to apply
     * transformation to the response, add extra output, and execute
     * other custom code.
     *
     * @return  void
     */
    public function after () {
        echo $this->template->render();
    }
}
