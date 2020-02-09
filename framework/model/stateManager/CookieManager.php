<?php
/**
 * Created by PhpStorm.
 * User: jamesskywalker
 * Date: 21/10/2019
 * Time: 21:33
 */

namespace model\stateManager;


use interfaces\PersistentStateManagerInterface;



class CookieManager implements PersistentStateManagerInterface {

    private $cookieDomain;
    private $cookieLifetime;

    public function setStateVariable(string $name, $value) {
        // TODO: Implement setStateVariable() method.
    }

    public function getStateVariable(string $name) {
        // TODO: Implement getStateVariable() method.
    }

    public function unsetStateVariable(string $name) {
        // TODO: Implement unsetStateVariable() method.
    }

    public function resetState() {
        // TODO: Implement resetState() method.
    }

    public function getStateVitals() {
        // TODO: Implement getStateVitals() method.
    }

    public function stateVariableExists(string $name) :bool {
        // TODO: Implement stateVariableExists() method.
    }
}