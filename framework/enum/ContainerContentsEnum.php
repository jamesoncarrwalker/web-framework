<?php
/**
 * Created by PhpStorm.
 * User: jamesskywalker
 * Date: 23/10/2019
 * Time: 13:27
 */

namespace enum;


use abstractClass\AbstractBasicEnum;

abstract class ContainerContentsEnum extends AbstractBasicEnum {

    const COOKIE = 'COOKIE';
    const SESSION = 'SESSION';
    const REQUEST = 'REQUEST';
    const AUTH = 'AUTH';
    const RESPONSE = 'RESPONSE';
    const CONN = 'CONN';
    const DEPMAN = 'DEPMAN';

    public static function getValueForConstant(string $const) {
        if(self::$array == null) self::setEnumArray();
        return parent::getValueForConstant($const);
    }

    public static function getConstantForValue($value) {
        if(self::$array == null) self::setEnumArray();
        return parent::getConstantForValue($value);
    }

    public static function setEnumArray() {
        self::$array = [
            self::COOKIE => 'COOKIE_MANAGER',
            self::SESSION => 'SESSION_MANAGER',
            self::REQUEST => 'REQUEST_OBJECT',
            self::AUTH => 'AUTHENTICATOR',
            self::RESPONSE => 'RESPONSE_OBJECT',
            self::CONN => 'CONNECTION_OBJECT',
            self::DEPMAN => 'DEPENDENCY_MANAGER',
        ];
    }

}