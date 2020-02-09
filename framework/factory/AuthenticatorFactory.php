<?php
/**
 * Created by PhpStorm.
 * User: jamesskywalker
 * Date: 13/10/2019
 * Time: 09:13
 */

namespace factory;


use abstractClass\AbstractRequestObject;
use interfaces\AuthenticatorInterface;
use interfaces\DependencyManagerInterface;
use model\authenticator\AuthenticatorWeb;

class AuthenticatorFactory {

    public static function getAuthenticator(AbstractRequestObject $requestObject, DependencyManagerInterface $dependencyManager) : AuthenticatorInterface {

        if($requestObject->getAction() == 'loginGoogle') {
            //return a google authenticator
        } else if ($requestObject->getAction() == 'loginFacebook') {
            //return a facebook authenticator
        } else if ($requestObject->getAction() == 'login') {
            //return a local login authenticator
        } else if ($requestObject->getAction() == 'loginApi') {
            //return an api login authenticator
        } else if ($requestObject->arrayFieldExists('appRequest')) {
            //return an app api authenticator
        } else if ($requestObject->arrayFieldExists('apiRequest')) {
            //return an apiRequest authenticator
        } else {
           return new AuthenticatorWeb(...$dependencyManager->getDependencies('model\authenticator\AuthenticatorWeb'));
        }

    }
}