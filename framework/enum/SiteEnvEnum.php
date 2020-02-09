<?php
/**
 * Created by PhpStorm.
 * User: jamesskywalker
 * Date: 23/11/2019
 * Time: 12:08
 */

namespace enum;


use abstractClass\AbstractBasicEnum;

abstract class SiteEnvEnum extends AbstractBasicEnum{

    const ROOT = 'ROOT';
    const TITLE = 'TITLE';


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
            self::ROOT => 'app/',
            self::TITLE => 'The default title'
        ];
    }
}
