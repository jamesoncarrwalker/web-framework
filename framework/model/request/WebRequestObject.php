<?php
namespace model\request;

use abstractClass\AbstractRequestObject;
use enum\ResponseTypeEnum;
use enum\RequestTypeEnum;
use model\helper\StringSanitizer;


/**
 * Created by PhpStorm.
 * User: jamesskywalker
 * Date: 12/10/2019
 * Time: 19:04
 */
class WebRequestObject extends AbstractRequestObject {

    /**
     * AbstractRequestObject member vars.
     *
     * protected $requestData;
     * protected $requestType;
     *
     * url convention ..ControllerName/ControllerAction/[ActionParams]/[QueryString]
     * elements separated by '/' are assumed to follow this order i.e.
     * the first will always be assumed to be a controller
     * the second will always be assumed to be an action
     * any after this will be considered ordered params
     * anything after the query string delimiter '?' will be considered a $_GET param
     *
     */

    private $controllerParams;
    private $controllerName;
    private $getParams;
    private $action;
//TODO:: IMPROVE THE IMPLEMENTATION OF THIS - ABILITY TO UPDATE,BETTER PARSING OF CONTROLLER PARAMS ETC
    public function parseUriString() {
        if(isset($_SERVER['HTTP_HOST'])) {
            $queryString = $_SERVER['HTTP_HOST'] == 'localhost' ? substr($_SERVER['REQUEST_URI'],strpos($_SERVER['REQUEST_URI'],'/',1)+1) : $_SERVER['REQUEST_URI'];
        }  else {
            // for testing
            $queryString =  'landing';
        }
        $uriSections = explode('?',$queryString);
        $this->controllerParams = explode('/',$uriSections[0]);
        parse_str($uriSections[1]??"", $this->getParams);

        $this->setControllerParams();
    }

    public function parseRequestData() {
        $requestData = array_merge($this->getParams,$_POST);
        foreach($requestData as $key => $value) {
            $cleanKey = StringSanitizer::cleanString($key);
            $cleanValue = StringSanitizer::cleanString($value);
            $this->requestData[$cleanKey] = $cleanValue;
        }
    }

    public function updateRequest(string $paramName, $value) {
        if($paramName == 'action') $this->action = $value;
    }

    protected function setRequestType() {
        $this->requestType = RequestTypeEnum::WEB;
    }

    public function getControllerName() {
        return $this->controllerName;
    }

    public function getAction() {
        return $this->action;
    }

    private function setControllerParams() {
        if(isset($this->controllerParams[0])) {
            if($this->controllerParams[0] == "") $this->controllerName = "LandingController";
            else $this->controllerName = StringSanitizer::cleanString($this->controllerParams[0]) . 'Controller';
        }
        if(isset($this->controllerParams[1])) $this->action = StringSanitizer::cleanString($this->controllerParams[1]);
        unset($this->controllerParams[0],$this->controllerParams[1]);
        $cleanParams = array_map(function($param){return StringSanitizer::cleanString($param);},$this->controllerParams);
        $this->controllerParams = $cleanParams;
    }


}