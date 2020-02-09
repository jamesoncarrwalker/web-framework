<?php
use interfaces\FinderInterface;
use \PHPUnit\Framework\TestCase;
use model\finder\ControllerRouteFinder;

/**
 * Created by PhpStorm.
 * User: jamesskywalker
 * Date: 22/10/2019
 * Time: 13:47
 */
class ControllerRouteFinderTest extends TestCase {

    /**
     * @return ControllerRouteFinder
     */
    public function testCanInstantiateControllerFinder() {
        $finder = new ControllerRouteFinder();
        $this->assertTrue($finder instanceof FinderInterface);

        return $finder;
    }

    /**
     * @depends testCanInstantiateControllerFinder
     * @param ControllerRouteFinder $finder
     * @internal param ControllerRouteFinder $dependencyCheckerController
     * @return ControllerRouteFinder
     */

    public function testCanFindValidController(ControllerRouteFinder $finder) {
        $finder->setSearchParams('LandingController',\enum\RequestTypeEnum::WEB);
        $finder->runSearch();
        $this->assertTrue($finder->isValid());
        return $finder;
    }

    /**
     * @depends testCanFindValidController
     * @param ControllerRouteFinder $finder
     * @internal param ControllerRouteFinder $dependencyCheckerController
     * @return ControllerRouteFinder
     */

    public function testCanFindValidControllerWithoutControllerSuffix(ControllerRouteFinder $finder) {
        $finder->setSearchParams('Landing',\enum\RequestTypeEnum::WEB);
        $finder->runSearch();
        $this->assertTrue($finder->isValid());
        return $finder;
    }

    /**
     * @depends testCanFindValidControllerWithoutControllerSuffix
     * @param ControllerRouteFinder $finder
     * @internal param ControllerRouteFinder $dependencyCheckerController
     * @return ControllerRouteFinder
     */

    public function testCanFindValidControllerWithLowerCaseControllerSuffix(ControllerRouteFinder $finder) {
        $finder->setSearchParams('Landingcontroller',\enum\RequestTypeEnum::WEB);
        $finder->runSearch();
        $this->assertTrue($finder->isValid());
        return $finder;
    }

    /**
     * @depends testCanFindValidControllerWithLowerCaseControllerSuffix
     * @param ControllerRouteFinder $finder
     * @internal param ControllerRouteFinder $dependencyCheckerController
     * @return ControllerRouteFinder
     */

    public function testCantFindInValidController(ControllerRouteFinder $finder) {
        $finder->setSearchParams('Landingmachinecontroller',\enum\RequestTypeEnum::WEB);
        $finder->runSearch();
        $this->assertFalse($finder->isValid());

        $finder->setSearchParams('Landingcontroller',\enum\RequestTypeEnum::API);
        $finder->runSearch();
        $this->assertFalse($finder->isValid());

        return $finder;
    }

    public function testCanGetControllerNamespaceRouteString() {
        $finder = new ControllerRouteFinder();
        $finder->setSearchParams('Landing',\enum\RequestTypeEnum::WEB);
        $finder->runSearch();
        $namespaceRoute = $finder->getResult();

        $this->assertIsString($namespaceRoute);
        return $namespaceRoute;
    }

    /**
     * @depends testCanGetControllerNamespaceRouteString
     * @param string $namespaceRoute
     */


    public function testNamespaceRouteCanBeInstantiated(string $namespaceRoute) {
        $landingController = new $namespaceRoute();
        $this->assertTrue($landingController instanceof \interfaces\ControllerInterface);
    }
}
