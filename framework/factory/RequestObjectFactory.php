<?php
/**
 * Created by PhpStorm.
 * User: jamesskywalker
 * Date: 20/10/2019
 * Time: 19:35
 */

namespace factory;


use abstractClass\AbstractRequestObject;
use model\request\WebRequestObject;

class RequestObjectFactory {

    static public function createRequestObject():AbstractRequestObject {
        //TODO:: define the various request objects we might receive
        return new WebRequestObject();
    }
}