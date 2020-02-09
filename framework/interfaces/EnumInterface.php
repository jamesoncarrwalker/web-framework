<?php
/**
 * Created by PhpStorm.
 * User: jamesskywalker
 * Date: 30/10/2019
 * Time: 21:26
 */

namespace interfaces;


interface EnumInterface {

    public static function getValueForConstant(string $const);

    public static function getConstantForValue( $value);

    public static function setEnumArray();
}