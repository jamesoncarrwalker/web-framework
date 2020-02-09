<?php
/**
 * Created by PhpStorm.
 * User: jamesskywalker
 * Date: 12/10/2019
 * Time: 20:24
 */

namespace interfaces;


interface DependencyManagerInterface {

    public function getAllClassesWithDependenciesList() :array;

    public function getDependenciesListForClass(string $name) :array;

    public function hasDependencies(string $name) :bool;

    public function getDependencies(string $name) :array;
}