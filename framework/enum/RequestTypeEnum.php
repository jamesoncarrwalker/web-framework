<?php
/**
 * Created by PhpStorm.
 * User: jamesskywalker
 * Date: 22/10/2019
 * Time: 21:23
 */

namespace enum;


use abstractClass\AbstractBasicEnum;

abstract class RequestTypeEnum extends AbstractBasicEnum {
    const WEB = "WEB";
    const API = "API";
    const APP = "APP";


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
            self::WEB => 'WEB_REQUEST',
            self::API => 'API_REQUEST',
            self::APP => 'APP_REQUEST'
        ];
    }
}