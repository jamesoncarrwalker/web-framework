<?php
/**
 * Created by PhpStorm.
 * User: jamesskywalker
 * Date: 12/10/2019
 * Time: 14:02
 */
namespace factory;

use abstractClass\AbstractFrontController;
use abstractClass\AbstractRequestObject;
use frontController\ErrorResponseFrontController;
use frontController\WebFrontController;
use model\container\WebContainer;
use model\dbo\DBPdo;
use model\dependencyManager\WebDependencyManager;
use model\stateManager\CookieManager;
use model\stateManager\SessionManager;
use model\request\AjaxRequestObject;
use model\request\ApiRequestObject;
use model\request\AppRequestObject;
use model\request\WebRequestObject;
use model\response\ErrorResponse;
use model\response\WebResponseObject;



class FrontControllerFactory {

    public static function createFrontController(AbstractRequestObject $requestObject) : AbstractFrontController {

        if($requestObject instanceof WebRequestObject ) {
            $dependencyManager = new WebDependencyManager();
            $dependencyManager->addInstantiatedDependency('model\dependencyManager\WebDependencyManager',$dependencyManager);
            $dependencyManager->addInstantiatedDependency('model\stateManager\SessionManager',new SessionManager());
            $dependencyManager->addInstantiatedDependency('model\stateManager\CookieManager',new CookieManager());
            $dependencyManager->addInstantiatedDependency('model\dbo\DBPdo',  new DBPdo([]));
            $dependencyManager->addInstantiatedDependency('model\response\WebResponseObject',  new WebResponseObject());
            $dependencyManager->addInstantiatedDependency('model\request\WebRequestObject',$requestObject);
            $webContainer = new WebContainer(...$dependencyManager->getDependencies('model\container\WebContainer'));
            $dependencyManager->addInstantiatedDependency('model\container\WebContainer',$webContainer);
            return new WebFrontController($webContainer);
        } else if ($requestObject instanceof AjaxRequestObject) {
            //TODO:: return an ajax controller (will probably be a web controller with a json output
        } else if ($requestObject instanceof ApiRequestObject) {
            //TODO:: return an api controller
        } else if ($requestObject instanceof AppRequestObject) {
            //TODO:: return an app controller and response
        } else {
            return new ErrorResponseFrontController($requestObject, new ErrorResponse(), null, null);
        }
    }
}