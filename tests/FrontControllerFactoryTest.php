<?php

use factory\FrontControllerFactory;
use factory\RequestObjectFactory;
use frontController\WebFrontController;
use interfaces\FrontControllerInterface;
use model\request\WebRequestObject;
use \PHPUnit\Framework\TestCase;

/**
 * Created by PhpStorm.
 * User: jamesskywalker
 * Date: 09/11/2019
 * Time: 11:17
 */
class FrontControllerFactoryTest extends TestCase {

    private $requestObject;

    public function setUp() :void {
        parent::setUp(); // TODO: Change the autogenerated stub
        $this->requestObject = RequestObjectFactory::createRequestObject();
    }

    public function testCanGetAFrontController() {

        $frontController = FrontControllerFactory::createFrontController($this->requestObject);

        $this->assertTrue($frontController instanceof FrontControllerInterface);
    }

    public function testWebRequestObjectCreatesWebFrontController() {
        if($this->requestObject instanceof WebRequestObject) {

            $frontController = FrontControllerFactory::createFrontController($this->requestObject);

            $this->assertTrue($frontController instanceof WebFrontController);
        }
    }
}
