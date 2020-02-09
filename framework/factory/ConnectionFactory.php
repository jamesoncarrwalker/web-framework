<?php
/**
 * Created by PhpStorm.
 * User: jamesskywalker
 * Date: 20/10/2019
 * Time: 17:59
 */

namespace factory;


use abstractClass\AbstractConnectionObject;
use abstractClass\AbstractRequestObject;
use model\dbo\DBPdo;

class ConnectionFactory {

    static function createConnectionObject(AbstractRequestObject $object):AbstractConnectionObject {
        //TODO:: check the object for which kind of connection we want

        switch($object->getRequestType()) {
            default: return new DBPdo(parse_ini_file("private/config/DBConn.ini",true)["PDO_CONNECT"]);
        }

    }
}