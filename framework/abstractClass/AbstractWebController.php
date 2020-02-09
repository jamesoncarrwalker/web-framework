<?php
/**
 * Created by PhpStorm.
 * User: jamesskywalker
 * Date: 22/10/2019
 * Time: 22:05
 */

namespace abstractClass;

use model\container\WebContainer;

abstract class AbstractWebController extends AbstractController {


    public function __construct(WebContainer $container) {
        parent::__construct($container);
    }

    protected function setTemplate(string $templateName) {
        $this->response->setResponseData('template', $templateName);
    }

 }