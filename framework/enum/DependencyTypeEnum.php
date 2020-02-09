<?php
/**
 * Created by PhpStorm.
 * User: jamesskywalker
 * Date: 20/10/2019
 * Time: 22:50
 */

namespace enum;

use abstractClass\AbstractBasicEnum;


abstract class DependencyTypeEnum extends AbstractBasicEnum {

    /**
     * keys for the array
     */
    const WEB_CONTROLLER = 'WEB_CONTROLLER';
    const TEST = 'TEST';
    const JAM = 'JAM';



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
            self::WEB_CONTROLLER => 'web controller dependency',
            self::TEST => 'this is a test',
            self::JAM => 'strawberry'
        ];
    }
}