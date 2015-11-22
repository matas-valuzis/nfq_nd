<?php
/**
 * Created by PhpStorm.
 * User: Matas
 * Date: 2015.11.21
 * Time: 16:29
 */

namespace DB;


interface IDriver {

    public function connect();
    public function isConnected();
    public function addQuery($q, $args = []);
    public function getQuery();
    public function execute($select = false);
    public function queryIsEmpty();

}