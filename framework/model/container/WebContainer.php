<?php
namespace model\container;

use enum\ContainerContentsEnum;
use abstractClass\AbstractConnectionObject;
use interfaces\AuthenticatorInterface;
use interfaces\DependencyManagerInterface;
use interfaces\PersistentStateManagerInterface;
use model\request\WebRequestObject;
use model\response\WebResponseObject;

/**
 * Created by PhpStorm.
 * User: jamesskywalker
 * Date: 22/10/2019
 * Time: 22:13
 */
class WebContainer implements PersistentStateManagerInterface {

    private $originalContainerState;
    private $currentContainer;
    private $availableWebContainerSections = [  ContainerContentsEnum::REQUEST,
                                                ContainerContentsEnum::RESPONSE,
                                                ContainerContentsEnum::AUTH,
                                                ContainerContentsEnum::SESSION,
                                                ContainerContentsEnum::COOKIE,
                                                ContainerContentsEnum::CONN,
                                                ContainerContentsEnum::DEPMAN,
                                            ];


    public function __construct(WebRequestObject $requestObject, WebResponseObject $responseObject, AbstractConnectionObject $conn, AuthenticatorInterface $authenticator, PersistentStateManagerInterface $sessionManager, PersistentStateManagerInterface $cookieManager, DependencyManagerInterface $dependencyManager) {
        $this->originalContainerState[ContainerContentsEnum::REQUEST] = $requestObject;
        $this->originalContainerState[ContainerContentsEnum::RESPONSE] = $responseObject;
        $this->originalContainerState[ContainerContentsEnum::CONN] = $conn;
        $this->originalContainerState[ContainerContentsEnum::AUTH] = $authenticator;
        $this->originalContainerState[ContainerContentsEnum::SESSION] = $sessionManager;
        $this->originalContainerState[ContainerContentsEnum::COOKIE] = $requestObject;
        $this->originalContainerState[ContainerContentsEnum::DEPMAN] = $dependencyManager;
        $this->resetState();


    }

    public function setStateVariable(string $name, $value) {
        if($this->isValidContainerParam($name)) $this->currentContainer[$name] = $value;
    }

    public function getStateVariable(string $name) {
        return $this->isValidContainerParam($name) ? $this->currentContainer[$name] : false;
    }

    public function unsetStateVariable(string $name) {
        unset($this->currentContainer[$name]);
    }

    public function resetState() {
        $this->currentContainer = $this->originalContainerState;
    }

    public function getStateVitals() {
        // TODO: Implement getStateVitals() method.
    }

    private function isValidContainerParam(string $name):bool {
        return in_array($name,$this->availableWebContainerSections);
    }

    public function stateVariableExists(string $name) :bool {
        if(!$this->isValidContainerParam($name)) return false;
        return isset($this->currentContainer[$name]);
    }
}