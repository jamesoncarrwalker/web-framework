<?php

namespace controller\www;

use abstractClass\AbstractWebController;
use model\dbo\DBPdo;

/**
 * Created by PhpStorm.
 * User: jamesskywalker
 * Date: 12/10/2019
 * Time: 13:47
 */
class LandingController extends AbstractWebController {


    protected function load() {
        $dbo = new DBPdo();
        $this->setData('dbo', $dbo->openConnection());
        $this->setData('message', 'Hello Fergo');
        $this->setTemplate('example');
    }

}