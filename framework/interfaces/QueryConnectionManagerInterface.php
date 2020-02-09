<?php
/**
 * Created by PhpStorm.
 * User: jamesskywalker
 * Date: 24/07/2019
 * Time: 19:50
 */

namespace interfaces;


interface QueryConnectionManagerInterface {

    public function openConnection();

    public function closeConnection();

}