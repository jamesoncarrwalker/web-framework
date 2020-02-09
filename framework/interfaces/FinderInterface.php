<?php
/**
 * Created by PhpStorm.
 * User: jamesskywalker
 * Date: 12/10/2019
 * Time: 19:29
 */

namespace interfaces;


interface FinderInterface {

    /**
     * @param string $searchQuery
     * @param null $optionalType
     * @return mixed could be an int, a string, an array etc depending on the type of Finder instantiated
     */
    public function setSearchParams(string $searchQuery, $optionalType = null);

    public function runSearch();

    public function getResult();

}