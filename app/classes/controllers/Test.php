<?php

namespace Controllers;

use \Koz\Controller;
use \Koz\Response;
use \Koz\Messages;

class Test extends Controller {

    public function REQUEST_index () {
        //Messages::$lang = 'en-us';

        Response::body(Messages::load('validation', 'pt-br')->get('required'));
    }

}
