<?php
namespace interfaces;
/**
 * Created by PhpStorm.
 * User: jamesskywalker
 * Date: 20/09/2019
 * Time: 15:13
 */
interface ResponseInterface {

    public function getResponseType();

    public function setResponseData(string $name, $data);

    public function outputResponse();

}