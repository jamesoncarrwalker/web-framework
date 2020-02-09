<?php
/**
 * Created by PhpStorm.
 * User: jamesskywalker
 * Date: 02/11/2019
 * Time: 12:13
 */

namespace abstractClass;


use interfaces\EnumInterface;


abstract class AbstractBasicEnum implements EnumInterface {

    protected static $array;

    public static function getValueForConstant(string $const) {
        if(!in_array($const,array_keys(self::$array))) return null;
        return self::$array[$const];
    }

    public static function getConstantForValue($value) {
        $constant = array_search($value, self::$array, true);
        return !$constant ? null : $constant;
    }

}