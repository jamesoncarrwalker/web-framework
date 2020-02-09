<?php
/**
 * Created by PhpStorm.
 * User: jamesskywalker
 * Date: 12/10/2019
 * Time: 19:38
 */

namespace model\finder;


use abstractClass\AbstractFinder;
use enum\FinderTypesEnum;

class ControllerRouteFinder extends AbstractFinder {

    private $controllerName;
    private $requestType;
    private $controllerRoute;

    public function setSearchParams(string $searchQuery, $optionalType = null) {
        $this->controllerName = $searchQuery;
        $this->requestType = $optionalType;
    }

    public function runSearch() {
        $this->prepareSearchString();
        if(!$this->isValid()) unset($this->controllerRoute);
    }

    public function getResult(){
        return isset($this->controllerRoute) ? $this->controllerRoute : false;
    }

    public function isValid() : bool {
        if(!isset($this->controllerRoute))return false;
        return class_exists($this->controllerRoute);
    }

    protected function setFinderType() {
        $this->type = FinderTypesEnum::CONTROLLER;
    }

    private function prepareSearchString() {

        if($this->controllerName == '' || !isset($this->controllerName)) return;
        if($this->requestType == '' || !isset($this->requestType)) return;

        $controllerName = strtolower($this->controllerName);
        if(strpos($controllerName,'controller') === false) {
            $controllerName .= 'Controller';
        } else {
            $controllerName = substr($controllerName, 0, strpos($controllerName, 'controller')) . 'Controller';
        }

        $controllerType = strtolower($this->requestType) . 'Controller';

        $this->controllerRoute = '\\controller\\' . $controllerType . '\\' . ucfirst($controllerName);
    }

}