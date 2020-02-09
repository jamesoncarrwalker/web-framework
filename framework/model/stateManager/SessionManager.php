<?php
/**
 * Created by PhpStorm.
 * User: jamesskywalker
 * Date: 16/10/2019
 * Time: 13:05
 */

namespace model\stateManager;


use interfaces\PersistentStateManagerInterface;



class SessionManager implements PersistentStateManagerInterface {

    //this will control session starting/destroying as well (similar to setting the connection object at the right time)

    public function setStateVariable(string $name, $value) {
        $this->initSession();
        $_SESSION[$name] = $value;
    }

    public function getStateVariable(string $name) {
        $this->initSession();
        if(isset($_SESSION[$name])) return $_SESSION[$name];
        else return false;
    }

    public function unsetStateVariable(string $name) {
        $this->initSession();
        if(isset($_SESSION[$name])) return $_SESSION[$name];
    }

    public function resetState() {
        $this->clearSessionData();
    }

    public function getStateVitals() {
        // TODO: Implement getStateVitals() method.
    }

    private function initSession() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    private function clearSessionData() {
        if (session_status() != PHP_SESSION_NONE) {
            session_destroy();
        }
    }


    public function stateVariableExists(string $name) :bool {
        // TODO: Implement stateVariableExists() method.
    }
}