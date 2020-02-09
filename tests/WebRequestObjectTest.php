<?php
use PHPUnit\Framework\TestCase;
/**
 * Created by PhpStorm.
 * User: jamesskywalker
 * Date: 28/10/2019
 * Time: 19:57
 */
class WebRequestObjectTest extends TestCase {

    public function testControllerIsSet() {
        $requestObject = new \model\request\WebRequestObject();
        $requestObject->parseUriString();
        $this->assertIsString($requestObject->getControllerName());
    }

    public function testControllerIsLanding() {
        $requestObject = new \model\request\WebRequestObject();
        $requestObject->parseUriString();
        $this->assertEquals($requestObject->getControllerName(),"landing");
    }
}
