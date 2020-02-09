<?php
namespace enum;
use abstractClass\AbstractBasicEnum;

/**
 * Created by PhpStorm.
 * User: jamesskywalker
 * Date: 12/10/2019
 * Time: 14:14
 */
abstract class ResponseTypeEnum extends AbstractBasicEnum {

    const WEB = 'WEB';
    const AJAX = 'AJAX';
    const API_PUBLIC_JSON = 'API_PUBLIC_JSON';
    const API_PRIVATE_JSON = 'API_PRIVATE_JSON';
    const APP = 'APP';

    const UNKNOWN = "UNKNOWN_TYPE";

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
            self::WEB => 'HTML',
            self::AJAX => 'AJAX_JSON',
            self::API_PUBLIC_JSON => 'JSON_PUBLIC',
            self::API_PRIVATE_JSON => 'JSON_PRIVATE',
            self::APP => 'APP',
            self::UNKNOWN => 'UNKNOWN'
        ];
    }
}