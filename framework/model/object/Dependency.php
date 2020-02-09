<?php
namespace model\object;
/**
 * Created by PhpStorm.
 * User: jamesskywalker
 * Date: 28/10/2019
 * Time: 13:26
 */

class Dependency {

    private $type;
    private $name;
    private $namespaceLocation;
    private $value;
    private $isInstantiated;

    /**
     * Dependency constructor.
     * @param string $type
     * @param string $name
     * @param string $namespaceLocation
     * @param $value <-- can be any instantiated object
     */
    public function __construct(string $type, string $name, string $namespaceLocation, $value = null) {
        $this->type = $type;
        $this->name = $name;
        $this->namespaceLocation = $namespaceLocation;
        if(isset($this->value))$this->value = $value;
        $this->isInstantiated = is_object($value);
    }

    public function getDependencyType() :string {
        return $this->type;
    }

    public function getDependencyName() :string {
        return $this->name;
    }

    public function getDependencyLocation() :string {
        return $this->namespaceLocation;
    }

    public function isDependencyInstantiated() :bool {
        return $this->isInstantiated;
    }

    public function setInstantiatedStatus(bool $newStatus) {
        $this->isInstantiated = $newStatus;
    }

    public function getDependency() {
        if(is_object($this->value)) return $this->value;
        return null;
    }
}