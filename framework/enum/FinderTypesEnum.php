<?php
/**
 * Created by PhpStorm.
 * User: jamesskywalker
 * Date: 15/10/2019
 * Time: 13:14
 */

namespace enum;


use abstractClass\AbstractBasicEnum;

abstract class FinderTypesEnum extends AbstractBasicEnum {

    const CONTROLLER = 'CONTROLLER';

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
            self::CONTROLLER => 'CONTROLLER'
        ];
    }
}