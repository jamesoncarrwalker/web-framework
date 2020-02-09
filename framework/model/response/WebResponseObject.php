<?php
namespace model\response;


use interfaces\ResponseHeadersManagerInterface;
use interfaces\ResponseInterface;
use model\helper\TemplateParser;



/**
 * Created by PhpStorm.
 * User: jamesskywalker
 * Date: 12/10/2019
 * Time: 19:39
 */
class WebResponseObject implements ResponseInterface, ResponseHeadersManagerInterface {

    protected $responseData;
    private $html;

    protected function setResponseType() {
        // TODO: Implement setResponseType() method.
    }

    public function getResponseType() {

    }

    public function getResponse() {
        $templateParser = new TemplateParser('[[',']]',$this->responseData['template']??'',$this->responseData);
        $this->html = $templateParser->parseString();
    }

    function setResponseData(string $name, $data) {
        $this->responseData[$name] = $data;
    }

    public function outputResponse() {
        $this->getResponse();

        echo  $this->html;
    }

    public function setHeaders() {
        // TODO: Implement setHeaders() method.
    }

    public function getHeaders() {
        // TODO: Implement getHeaders() method.
    }

    public function clearHeaders() {
        // TODO: Implement clearHeaders() method.
    }
}