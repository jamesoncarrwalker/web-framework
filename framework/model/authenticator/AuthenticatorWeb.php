<?php
namespace model\authenticator;
use interfaces\AuthenticatorInterface;
use interfaces\PersistentStateManagerInterface;

/**
 * Created by PhpStorm.
 * User: jamesskywalker
 * Date: 13/10/2019
 * Time: 13:24
 */
class AuthenticatorWeb implements AuthenticatorInterface {

    public function __construct(PersistentStateManagerInterface $sessionManager, PersistentStateManagerInterface $cookieManager) {
        //::TODO Define authenticator web
    }
}