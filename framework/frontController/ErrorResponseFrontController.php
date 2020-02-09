<?php
/**
 * Created by PhpStorm.
 * User: jamesskywalker
 * Date: 20/10/2019
 * Time: 20:06
 */

namespace frontController;


use abstractClass\AbstractFrontController;
use abstractClass\AbstractRequestObject;
use interfaces\AuthenticatorInterface;
use interfaces\FrontControllerInterface;
use interfaces\ResponseInterface;
use interfaces\FinderInterface;

class ErrorResponseFrontController implements FrontControllerInterface {

    public function __construct(AbstractRequestObject $requestObject, ResponseInterface $responseObject) {
        echo 'error response';
    }

    public function setInstantiatedController() {
        // TODO: Implement setController() method.
    }

    public function runRequest() :ResponseInterface {
        // TODO: Implement runRequest() method.
    }
}