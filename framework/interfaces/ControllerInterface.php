<?php
/**
 * Created by PhpStorm.
 * User: jamesskywalker
 * Date: 12/10/2019
 * Time: 19:58
 */

namespace interfaces;


interface ControllerInterface {

    public function runRequest();

    public function getResponse() :ResponseInterface;

}