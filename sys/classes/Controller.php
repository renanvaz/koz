<?php

namespace Koz;

use \Helpers\Text;
use \Koz\Response;

abstract class Controller {

    public $template    = 'partials/base';

    /**
     * Automatically executed before the controller action. Can be used to set
     * class properties, do authorization checks, and execute other custom code.
     *
     * @return  void
     */
    public function before () {
        $this->template             = View::make($this->template);
        $this->template->header     = View::make('partials/header');
        $this->template->footer     = View::make('partials/footer');

        $filename = Text::deCamelCase(Request::$controller.'/'.Request::$action);

        try {
            // If the view content not exists, not throw a error
            $this->template->content = View::make('pages/'.$filename);
        } catch (\Exception $e) {}
    }

    /**
     * Automatically executed after the controller action. Can be used to apply
     * transformation to the response, add extra output, and execute
     * other custom code.
     *
     * @return  void
     */
    public function after () {
        if (!Response::render()) {
            Response::body(is_string($this->template) ? $this->template : $this->template->render());
        }
    }
}
