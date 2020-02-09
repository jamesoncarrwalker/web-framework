<?php
namespace frontController;

use abstractClass\AbstractFrontController;
use controller\www\LostController;
use enum\ContainerContentsEnum;
use abstractClass\AbstractWebController;
use model\container\WebContainer;
use model\response\ErrorResponse;



/**
 * Created by PhpStorm.
 * User: jamesskywalker
 * Date: 12/10/2019
 * Time: 14:39
 */
class WebFrontController extends AbstractFrontController {

    public function __construct(WebContainer $container) {
        parent::__construct($container);
    }

    public function runRequest() {
        $this->setController();
        if($this->instantiatedController instanceof AbstractWebController) {
            $this->instantiatedController->runRequest();
        } else {
            $response = new ErrorResponse();
            $response->setResponseData('message','Could not load ' . $this->container->getStateVariable(ContainerContentsEnum::REQUEST)->getControllerName());
            $this->container->setStateVariable(ContainerContentsEnum::RESPONSE,$response);
        }
    }

    protected function setRequiredControllerNameSpace() {
       $this->requiredControllerNamespace = 'controller\www\\';
    }

    public function setDefaultRequest() {
        $dependencyManager = $this->container->getStateVariable(ContainerContentsEnum::DEPMAN);
        $this->instantiatedController = new LostController(...$dependencyManager->getDependencies('controller\webController\LostController'));
    }
}