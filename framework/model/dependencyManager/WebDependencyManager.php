<?php
namespace model\dependencyManager;

use abstractClass\AbstractDependencyManager;

/**
 * Created by PhpStorm.
 * User: jamesskywalker
 * Date: 28/10/2019
 * Time: 13:27
 */
class WebDependencyManager extends AbstractDependencyManager {

//TODO:: TCHECK THE EFFICIENCY AND MAKE SURE IT CREATES THINGS ONCE WHEN REQUIRED
//TODO:: LOOK AT THE FRONT CONTROLLER FACTORY (NEW BRANCE) AND DECIDE HOW/WHEN TO IMPLEMENT THE DM

    protected function parseDependenciesIni() {
        $this->singleInstanceDependenciesList = parse_ini_file('framework/config/SingleInstanceDependencies.ini',true)['WEB'];
        $this->dependenciesListByClass = array_merge(
            parse_ini_file('framework/config/ControllerDependencies.ini',true)['WEB'],
            parse_ini_file('app/config/ControllerDependencies.ini',true)['WEB'],
            parse_ini_file('app/config/ModelDependencies.ini',true),
            parse_ini_file('framework/config/ModelDependencies.ini',true));
    }


}