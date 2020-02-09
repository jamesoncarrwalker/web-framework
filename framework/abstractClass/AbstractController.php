<?php
/**
 * Created by PhpStorm.
 * User: jamesskywalker
 * Date: 20/10/2019
 * Time: 17:26
 */

namespace abstractClass;


use enum\ContainerContentsEnum;
use interfaces\ControllerInterface;
use interfaces\PersistentStateManagerInterface;
use interfaces\ResponseInterface;
use interfaces\ValidatorInterface;

abstract class AbstractController implements ControllerInterface, ValidatorInterface {

    private $action;
    protected $response;
    protected $container;

    public function __construct(PersistentStateManagerInterface $container) {
        $this->container = $container;
        $this->response = $this->container->getStateVariable(ContainerContentsEnum::RESPONSE);
    }

    public function getResponse() :ResponseInterface  {
        return $this->container->getStateVariable(ContainerContentsEnum::RESPONSE);
    }

    public function runRequest() {
        if(!isset($this->action)) $this->setAction();
        if($this->isValid()) {
            $action = $this->action;
            $this->$action();
        } else {
            $this->container->getStateVariable(ContainerContentsEnum::RESPONSE);
            //TODO SET AN ERROR RESPONSE - RESPONSE OBJECT NEEDS A STATUS SO WE CAN ENSURE THE RIGHT TYPE
            return false;
        }
    }

    public function isValid() : bool {
        return method_exists($this,$this->action);
    }

    public function setData(string $key, $value) {
        $this->response->setResponseData($key, $value);
    }

    private function setAction() {
        $action = $this->container->getStateVariable(ContainerContentsEnum::REQUEST)->getAction();
        $this->action = $action == "" ? "load" : $action;
    }

    abstract protected function load();
}