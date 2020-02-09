<?php
/**
 * Created by PhpStorm.
 * User: jamesskywalker
 * Date: 09/11/2019
 * Time: 21:52
 */

namespace controller\www;
use abstractClass\AbstractWebController;



class LostController extends AbstractWebController {

    protected function load() {
        $this->setData('message', 'this is the lost controller');
    }
}