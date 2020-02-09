<?php

use abstractClass\AbstractFrontController;
use factory\FrontControllerFactory;
use interfaces\ControllerInterface;
use interfaces\ResponseInterface;
use model\container\WebContainer;
use model\dbo\DBPdo;
use model\dependencyManager\WebDependencyManager;

use model\request\WebRequestObject;
use model\response\WebResponseObject;
use model\stateManager\CookieManager;
use model\stateManager\SessionManager;
use PHPUnit\Framework\TestCase;
/**
 * Created by PhpStorm.
 * User: jamesskywalker
 * Date: 12/11/2019
 * Time: 14:36
 */
class ChildControllerTest extends TestCase {

    private $controllerContainer;
    private $expectedControllerFqn;
    private $expectedContainerFqn;
    private $requestObjectFqn;
    private $dependencyManager;
    private $expectedControllerName;

    public function setUp() :void {
        parent::setUp();
        $this->expectedContainerFqn = 'model\container\WebContainer';
        $this->expectedControllerFqn = 'controller\webController\LandingController';
        $this->requestObjectFqn = 'model\request\WebRequestObject';

        $dependencyManager = new WebDependencyManager();
        $dependencyManager->addInstantiatedDependency('model\dependencyManager\WebDependencyManager',$dependencyManager);
        $dependencyManager->addInstantiatedDependency('model\stateManager\SessionManager',new SessionManager());
        $dependencyManager->addInstantiatedDependency('model\stateManager\CookieManager',new CookieManager());
        $dependencyManager->addInstantiatedDependency('model\dbo\DBPdo',  new DBPdo([]));
        $dependencyManager->addInstantiatedDependency('model\response\WebResponseObject',  new WebResponseObject());
        $dependencyManager->addInstantiatedDependency($this->requestObjectFqn,new $this->requestObjectFqn());
        $this->controllerContainer = new WebContainer(...$dependencyManager->getDependencies($this->expectedContainerFqn));
        $dependencyManager->addInstantiatedDependency('model\container\WebContainer',$this->controllerContainer);
        //set the request object and pass it to the DM
        $this->dependencyManager = $dependencyManager;
        $controllerName = explode('\\',$this->expectedControllerFqn);
        $this->expectedControllerName = lcfirst(end($controllerName));


    }

    public function testControllerContainerIsSet() {
        $this->assertTrue($this->controllerContainer instanceof $this->expectedContainerFqn);
    }

    public function testCanInstantiateController() {
        $controller = new $this->expectedControllerFqn(...$this->dependencyManager->getDependencies($this->expectedControllerFqn));
        $this->assertTrue(isset($controller));
        $this->assertTrue($controller instanceof $this->expectedControllerFqn);
    }

    /**
     * @depends testCanInstantiateController
     */

    public function testRequestActionIsSet() {
        $dependencyManager = $this->dependencyManager;
        $controller = new $this->expectedControllerFqn(...$dependencyManager->getDependencies($this->expectedControllerFqn));
        $action = $controller->getRequestAction();
        $this->assertTrue( isset($action) );
    }

    /**
     * @depends testRequestActionIsSet
     */

    public function testIfRequestIsBlankDefaultIsSet() {
        $controller = new $this->expectedControllerFqn(...$this->dependencyManager->getDependencies($this->expectedControllerFqn));
        $action = $controller->getRequestAction();
        $this->assertNotEquals( $action, "" );
        $this->assertEquals( $action, $this->expectedControllerName );
    }
    /**
     * @depends testIfRequestIsBlankDefaultIsSet
     */

    public function testInvalidRequestActionIsNotOverwritten() {
        $dependencyManager = new WebDependencyManager();
        $dependencyManager->addInstantiatedDependency('model\dependencyManager\WebDependencyManager',$dependencyManager);
        $dependencyManager->addInstantiatedDependency('model\stateManager\SessionManager',new SessionManager());
        $dependencyManager->addInstantiatedDependency('model\stateManager\CookieManager',new CookieManager());
        $dependencyManager->addInstantiatedDependency('model\dbo\DBPdo',  new DBPdo([]));
        $dependencyManager->addInstantiatedDependency('model\response\WebResponseObject',  new WebResponseObject());
        $requestObject = new $this->requestObjectFqn();
        $requestObject->updateRequest('action', 'jam');

        $dependencyManager->addInstantiatedDependency($this->requestObjectFqn,$requestObject);
        $controllerContainer = new $this->expectedContainerFqn(...$dependencyManager->getDependencies($this->expectedContainerFqn));
        $dependencyManager->addInstantiatedDependency($this->expectedContainerFqn,$controllerContainer);

        $controller = new $this->expectedControllerFqn(...$dependencyManager->getDependencies($this->expectedControllerFqn));
        $this->assertEquals("jam", $controller->getRequestAction());

        return $controller;
    }

    /**
     * @depends testInvalidRequestActionIsNotOverwritten
     * @param ControllerInterface $controller
     * @return ControllerInterface
     */

    public function testInvalidControllerActionIsFalse(ControllerInterface $controller) {

        $this->assertFalse($controller->isValid());
        return $controller;
    }
    /**
     * @depends testInvalidControllerActionIsFalse
     * @param ControllerInterface $controller
     */
    public function testCantCallInvalidControllerAction(ControllerInterface $controller) {
        $this->assertFalse($controller->runRequest());
    }

    /**
     * @depends testInvalidControllerActionIsFalse
     */

    public function testValidControllerActionIsTrue() {
        $dependencyManager = new WebDependencyManager();
        $dependencyManager->addInstantiatedDependency('model\dependencyManager\WebDependencyManager',$dependencyManager);
        $dependencyManager->addInstantiatedDependency('model\stateManager\SessionManager',new SessionManager());
        $dependencyManager->addInstantiatedDependency('model\stateManager\CookieManager',new CookieManager());
        $dependencyManager->addInstantiatedDependency('model\dbo\DBPdo',  new DBPdo([]));
        $dependencyManager->addInstantiatedDependency('model\response\WebResponseObject',  new WebResponseObject());
        $requestObject = new $this->requestObjectFqn();
        $requestObject->updateRequest('action', 'testAction');

        $dependencyManager->addInstantiatedDependency($this->requestObjectFqn,$requestObject);
        $controllerContainer = new $this->expectedContainerFqn(...$dependencyManager->getDependencies($this->expectedContainerFqn));
        $dependencyManager->addInstantiatedDependency($this->expectedContainerFqn,$controllerContainer);

        $controller = new $this->expectedControllerFqn(...$dependencyManager->getDependencies($this->expectedControllerFqn));
        $this->assertEquals("testAction", $controller->getRequestAction());

        $dependencyManager = new WebDependencyManager();
        $dependencyManager->addInstantiatedDependency('model\dependencyManager\WebDependencyManager',$dependencyManager);
        $dependencyManager->addInstantiatedDependency('model\stateManager\SessionManager',new SessionManager());
        $dependencyManager->addInstantiatedDependency('model\stateManager\CookieManager',new CookieManager());
        $dependencyManager->addInstantiatedDependency('model\dbo\DBPdo',  new DBPdo([]));
        $dependencyManager->addInstantiatedDependency('model\response\WebResponseObject',  new WebResponseObject());
        $requestObject = new $this->requestObjectFqn();

        $dependencyManager->addInstantiatedDependency($this->requestObjectFqn,$requestObject);
        $controllerContainer = new $this->expectedContainerFqn(...$dependencyManager->getDependencies($this->expectedContainerFqn));
        $dependencyManager->addInstantiatedDependency($this->expectedContainerFqn,$controllerContainer);

        $controller = new $this->expectedControllerFqn(...$dependencyManager->getDependencies($this->expectedControllerFqn));
        $this->assertEquals($this->expectedControllerName, $controller->getRequestAction());
    }
    /**
    * @depends testValidControllerActionIsTrue
    */

    public function testCanCallValidControllerAction() {
        $controller = new $this->expectedControllerFqn(...$this->dependencyManager->getDependencies($this->expectedControllerFqn));
        $this->assertNotEquals($controller->runRequest(),false);
    }
    /**
     * @depends testCanCallValidControllerAction
     */

    public function testControllerCanUpdateResponse() {
        $controller = new $this->expectedControllerFqn(...$this->dependencyManager->getDependencies($this->expectedControllerFqn));
        $blankResponse = clone $controller->getResponse();
        $controller->runRequest();
        $updatedResponse = $controller->getResponse();
        $this->assertNotEquals($blankResponse,$updatedResponse);
    }

    /**
     * @depends testControllerCanUpdateResponse
     */
    public function FrontControllerCanGetControllerResponse() {

        $frontController = FrontControllerFactory::createFrontController(new WebRequestObject());
        $frontController->runRequest();
        $response = $frontController->getResponse();

        $this->assertTrue($response instanceof AbstractFrontController);
        $outputResponse = $response->getResponse();
        $this->assertTrue($outputResponse instanceof ResponseInterface);
    }

    public function ResponseOutputIsValid() {
        $this->markTestSkipped(
            'This test has not been implemented yet.'
        );
    }
}
