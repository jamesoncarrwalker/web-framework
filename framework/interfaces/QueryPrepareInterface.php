<?php
/**
 * Created by PhpStorm.
 * User: jamesskywalker
 * Date: 24/07/2019
 * Time: 19:14
 */

namespace interfaces;


interface QueryPrepareInterface {

    public function setQuery(string $query);

    public function setData(array $data);

    public function bindData();

}