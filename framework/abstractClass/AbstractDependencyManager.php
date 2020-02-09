<?php
/**
 * Created by PhpStorm.
 * User: jamesskywalker
 * Date: 06/11/2019
 * Time: 21:25
 */

namespace abstractClass;


use interfaces\DependencyManagerInterface;

abstract class AbstractDependencyManager implements DependencyManagerInterface {

    protected $instantiatedDependenciesArray;
    protected $dependenciesListByClass;
    protected $singleInstanceDependenciesList;
    protected $instantiatedClassesAdded = 0;
    public $classesAdded;

    public function getAllClassesWithDependenciesList() :array {
        if(!isset($this->dependenciesListByClass)) $this->parseDependenciesIni();
        return $this->dependenciesListByClass;
    }

    public function getDependenciesListForClass(string $name) :array {
        if(!isset($this->dependenciesListByClass)) $this->parseDependenciesIni();
        return $this->dependenciesListByClass[$name];
    }

    public function hasDependencies(string $name) :bool {
        if(!isset($this->dependenciesListByClass)) $this->parseDependenciesIni();
        return isset($this->dependenciesListByClass[$name]);
    }

    public function getAllInstantiatedDependencies() :array {
        return $this->instantiatedDependenciesArray;
    }

    public function getDependencies(string $name) :array {
        if(!isset($this->dependenciesListByClass)) $this->parseDependenciesIni();
        if(!isset($this->dependenciesListByClass[$name])) return [];
        if(isset($this->instantiatedDependenciesArray[$name])) return $this->instantiatedDependenciesArray[$name];
        $this->createDependenciesForClass($name);
        return $this->instantiatedDependenciesArray[$name];

    }

    public function addInstantiatedDependency(string $name, $value) {
        $this->instantiatedDependenciesArray[$name] = $value;
    }

    private function createDependenciesForClass(string $name) {
        $dependenciesArrayList = $this->dependenciesListByClass[$name];
        $dependenciesArray = [];
        foreach($dependenciesArrayList as $fullyQualifiedNamespace) {

            // if our FQN is in the list of single instance objects check if it's instantiated yet
            if(in_array($fullyQualifiedNamespace, $this->singleInstanceDependenciesList)) {
                //if it has been instantiated pass the object to the dependency array
                if(isset($this->instantiatedDependenciesArray[$fullyQualifiedNamespace])) {
                    $dependenciesArray[] = $this->instantiatedDependenciesArray[$fullyQualifiedNamespace];

                } else {
                    //instantiate a new one and save it in the array
                    $class = new $fullyQualifiedNamespace(...$this->getDependencies($fullyQualifiedNamespace));
                    $this->instantiatedDependenciesArray[$fullyQualifiedNamespace] = $class;
                    $dependenciesArray[] = $this->instantiatedDependenciesArray[$fullyQualifiedNamespace];
                }
            }  else {
                //just create a new on
                $dependenciesArray[] = new $fullyQualifiedNamespace(...$this->getDependencies($fullyQualifiedNamespace));
            }
        }
        $this->instantiatedDependenciesArray[$name] = $dependenciesArray;
    }

    public function getTotalInstantiatedClassessAdded() {
        return $this->instantiatedClassesAdded;
    }

    abstract protected function parseDependenciesIni();

 }