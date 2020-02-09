<?php
use interfaces\DependencyManagerInterface;
use model\dependencyManager\WebDependencyManager;
use PHPUnit\Framework\TestCase;

/**
 * Created by PhpStorm.
 * User: jamesskywalker
 * Date: 29/10/2019
 * Time: 14:25
 */
class DependencyManagerTest extends TestCase {
    private $classNameToCheck;
    private $expectedDependenciesForClass;
    private $fqnToCheck;

    public function setUp():void {
        parent::setUp();
        $this->classNameToCheck = 'WebContainer';
        $container = [new \model\request\WebRequestObject(),new \model\response\WebResponseObject(),new \model\dbo\DBPdo(),new \model\authenticator\AuthenticatorWeb(new \model\stateManager\SessionManager(),new \model\stateManager\CookieManager()),new \model\stateManager\SessionManager(),new \model\stateManager\CookieManager(),new WebDependencyManager()];
        $this->expectedDependenciesForClass = $container;
        $this->fqnToCheck = 'model\container\\';
    }


    public function testCanInstantiateDependencyManager() {
        $dependencyManager = new WebDependencyManager();
        $this->assertTrue($dependencyManager instanceof  DependencyManagerInterface);
        return $dependencyManager;
    }


    /**
     * @depends testCanInstantiateDependencyManager
     * @param DependencyManagerInterface $dependencyManager
     */

    public function testHasLoadedDependenciesList(DependencyManagerInterface $dependencyManager) {
        $dependenciesList = $dependencyManager->getAllClassesWithDependenciesList();
        $this->assertIsArray($dependenciesList);
        $this->assertTrue(isset($dependenciesList[$this->fqnToCheck . $this->classNameToCheck]));
    }

    public function testCanGetDependenciesForClass() {
        $dependencyManager = new WebDependencyManager();
        $dependencies = $dependencyManager->getDependencies($this->fqnToCheck . $this->classNameToCheck);

        $this->assertEquals($this->expectedDependenciesForClass,$dependencies);

        return $dependencyManager;
    }

    /**
     * @param DependencyManagerInterface $dependencyManager
     * @depends testCanGetDependenciesForClass
     */
    public function testCanInstantiateObjectWithDependencies(DependencyManagerInterface $dependencyManager) {
        $fqn = $this->fqnToCheck . $this->classNameToCheck;
        $testClass = new $fqn(...$this->expectedDependenciesForClass);

        $this->assertTrue($testClass instanceof $fqn);
        $dependencyClass = new $fqn(...$dependencyManager->getDependencies($fqn));
        $this->assertEquals($testClass,$dependencyClass);
    }

    public function testCanLoadClassWithNoDependencies() {
        $dependencyManager = new WebDependencyManager();
        $dependencies = $dependencyManager->getDependencies('StringSanitizer');

        $this->assertEquals([],$dependencies);
    }

    public function testWillIgnoreMadeupClass() {
        $dependencyManager = new WebDependencyManager();
        $dependencies = $dependencyManager->getDependencies('jamontoast');

        $this->assertEquals([],$dependencies);
    }
    public function testCanManuallyAddDependency() {
        $dependencyManager = new WebDependencyManager();
        $dependencyManager->addInstantiatedDependency('WebDependencyManager',$dependencyManager);
        $this->assertTrue(isset($dependencyManager->getAllInstantiatedDependencies()['WebDependencyManager']));

    }

    public function testDoesNotInstantiateMultipleSingleInstantiationClasses() {
        $dependencyManager = new WebDependencyManager();
        $dependencyManager->addInstantiatedDependency('model\dependencyManager\WebDependencyManager',$dependencyManager);
        $fqn = $this->fqnToCheck . $this->classNameToCheck;
        $dependencyClass = new $fqn(...$dependencyManager->getDependencies($fqn));

        $this->assertFalse(isset($dependencyManager->classesAdded['WebDependencyManager']));
    }



}
