<?php
namespace abstractClass;

use interfaces\RequestParserInterface;

/**
 * Created by PhpStorm.
 * User: jamesskywalker
 * Date: 12/10/2019
 * Time: 21:46
 */
abstract class AbstractRequestObject implements RequestParserInterface {

    protected $requestData;
    protected $requestType;


    public function __construct() {
        $this->setRequestType();
        $this->parseUriString();
        $this->parseRequestData();
    }

    abstract function parseUriString();

    abstract function parseRequestData();

    abstract protected function setRequestType();


    //TODO::decide on an interface for these methods
    /**
     * @return string - is an abstractResponseType const value
     *
     */

    public function getRequestType() :string {
        return $this->requestType;
    }

    public function arrayFieldExists(string $key) :bool {
        return isset($this->requestData[$key]);
    }

    public function getRequestData() : array {
        return $this->requestData??[];
    }

    public function getRequestDataField(string $key) {
        return $this->requestData[$key];
    }

}