<?php
/**
 * Created by PhpStorm.
 * User: jamesskywalker
 * Date: 12/10/2019
 * Time: 15:50
 */

namespace interfaces;


interface RequestParserInterface {

    public function parseUriString();

    public function parseRequestData();
}