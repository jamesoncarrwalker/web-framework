<?php

/**
 * Created by PhpStorm.
 * User: jamesskywalker
 * Date: 20/10/2019
 * Time: 21:41
 */
use factory\AuthenticatorFactory;
use factory\ConnectionFactory;
use model\helper\DependencyChecker;
use model\request\WebRequestObject;
use \PHPUnit\Framework\TestCase;

class DependencyCheckerControllerTest extends TestCase {

    public function WebRequestStringIsSet() {
        $requestObject = new WebRequestObject('http://localhost/web_framework/');
        $this->assertEquals('http://localhost/web_framework/',$requestObject->testString);
    }

    public function CanInstantiateDCController() {
        $requestObject = new WebRequestObject();
        $authenticator = AuthenticatorFactory::getAuthenticator($requestObject);
        $connection = ConnectionFactory::createConnectionObject($requestObject);
        $dcController = new DependencyChecker($requestObject,$connection,$authenticator);

        $this->assertTrue($dcController instanceof DependencyChecker);

        return $dcController;
    }

    /**
     * @depends testCanInstantiateDCController
     * @param DependencyChecker $dependencyCheckerController
     * @return DependencyChecker
     */

    public function CanParseDCIniFile(DependencyChecker $dependencyCheckerController) {
        $dependencyCheckerController->setDependencies();

        $this->assertTrue(is_array($dependencyCheckerController->getAllDependencies()));
        return $dependencyCheckerController;
    }

    /**
     * @depends testCanParseDCIniFile
     * @param DependencyChecker $dependencyCheckerController
     * @return DependencyChecker
     */

    public function LandingHasDependencies(DependencyChecker $dependencyCheckerController) {
        $this->assertTrue($dependencyCheckerController->hasDependencies('Landing'));
        return $dependencyCheckerController;
    }

    /**
     * @depends testLandingHasDependencies
     * @param DependencyChecker $dependencyCheckerController
     * @return DependencyChecker
     */

    public function CanRetrieveLandingDependencies(DependencyChecker $dependencyCheckerController) {

        $landingDependencies = $dependencyCheckerController->getDependencies('Landing');
        $this->assertTrue(is_array($landingDependencies));
        $this->assertTrue(count($landingDependencies) == 2);
        return $dependencyCheckerController;
    }

    public function DoesNotParseAPIDependenciesForWebRequest() {
        $requestObject = new WebRequestObject('localhost/web_framework/');
        $authenticator = AuthenticatorFactory::getAuthenticator($requestObject);
        $connection = ConnectionFactory::createConnectionObject($requestObject);
        $dcController = new DependencyChecker($requestObject,$connection,$authenticator);

        $dcController->setDependencies();
        $allDependencies = $dcController->getAllDependencies();

        $this->assertTrue(count($allDependencies['Landing']) == 2);

        $landingDependencies = $allDependencies['Landing'];
        $this->assertFalse(isset($landingDependencies['apiconn']));
        $this->assertTrue(isset($landingDependencies['connWeb']));

    }


}
