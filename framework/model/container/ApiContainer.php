<?php
/**
 * Created by PhpStorm.
 * User: jamesskywalker
 * Date: 12/11/2019
 * Time: 18:49
 */

namespace model\container;



use interfaces\PersistentStateManagerInterface;


class ApiContainer implements PersistentStateManagerInterface{

    public function setStateVariable(string $name, $value) {
        // TODO: Implement setStateVariable() method.
    }

    public function getStateVariable(string $name) {
        // TODO: Implement getStateVariable() method.
    }

    public function unsetStateVariable(string $name) {
        // TODO: Implement unsetStateVariable() method.
    }

    public function stateVariableExists(string $name) :bool {
        // TODO: Implement stateVariableExists() method.
    }

    public function resetState() {
        // TODO: Implement resetState() method.
    }

    public function getStateVitals() {
        // TODO: Implement getStateVitals() method.
    }
}