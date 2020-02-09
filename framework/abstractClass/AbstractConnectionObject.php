<?php
namespace abstractClass;
use interfaces\QueryConnectionManagerInterface;
use interfaces\QueryPrepareInterface;
use interfaces\QueryResultsInterface;

/**
 * Created by PhpStorm.
 * User: jamesskywalker
 * Date: 12/10/2019
 * Time: 21:11
 */

/**
 * Class AbstractConnectionObject
 * Wrapper class for all the connection interfaces
 */
abstract class AbstractConnectionObject implements QueryPrepareInterface, QueryResultsInterface, QueryConnectionManagerInterface {
    protected $conn;
    protected $connectionVars;

    public function __construct(array $connectionVars = []) {
        $this->connectionVars = $connectionVars;
    }
}