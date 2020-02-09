<?php
/**
 * Created by PhpStorm.
 * User: jamesskywalker
 * Date: 16/10/2019
 * Time: 13:01
 */

namespace interfaces;


interface PersistentStateManagerInterface {

    public function setStateVariable(string $name, $value);

    public function getStateVariable(string $name);

    public function unsetStateVariable(string $name);

    public function stateVariableExists(string $name) :bool;

    public function resetState();

    public function getStateVitals();

}