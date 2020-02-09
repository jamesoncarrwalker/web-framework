<?php
/**
 * Created by PhpStorm.
 * User: jamesskywalker
 * Date: 09/11/2019
 * Time: 23:06
 */

namespace abstractClass;


use enum\ContainerContentsEnum;
use interfaces\ControllerInterface;
use interfaces\PersistentStateManagerInterface;
use interfaces\ResponseInterface;
use interfaces\ValidatorInterface;

abstract class AbstractFrontController implements ControllerInterface, ValidatorInterface {


    protected $requiredControllerNamespace;
    protected $container;
    protected $instantiatedController;

    private $nameSpacedController;

    public function __construct(PersistentStateManagerInterface $container) {
        $this->container = $container;
        $this->setRequiredControllerNameSpace();
    }

    abstract protected function setRequiredControllerNameSpace();

    protected function setController() {
        if($this->isValid()) {

            $dependencyManager = $this->container->getStateVariable(ContainerContentsEnum::DEPMAN);
            $this->instantiatedController = new $this->nameSpacedController(...$dependencyManager->getDependencies($this->nameSpacedController));
        } else {
            $this->setDefaultRequest();
        }
    }

    abstract function setDefaultRequest();

    public function isValid() :bool {
        $requestObject = $this->container->getStateVariable(ContainerContentsEnum::REQUEST);
        if(!isset($requestObject)) return false;
        $this->parseRequestObjectController($requestObject->getControllerName());
        return $this->controllerExists();
    }

    private function parseRequestObjectController(string $controllerName) {
        //have passed a namespace so need to check it's valid
        if(strpos($controllerName,'\\') !== false) {
            $splitControllerName = explode('\\', $controllerName);
            $controllerName = end($splitControllerName);
        }
        $controllerName = strtolower($controllerName);
        $strPos = strpos($controllerName,'controller');
        if( $strPos === false) $controllerName .= "Controller";
        else $controllerName = substr($controllerName, 0, $strPos) . 'Controller';
        $this->nameSpacedController = $this->requiredControllerNamespace . ucfirst($controllerName);
    }

    private function controllerExists() :bool {
        return class_exists($this->nameSpacedController);
    }

    abstract function runRequest();

    public function getResponse() :ResponseInterface {
        return $this->instantiatedController->getResponse();
    }


}