<?php
/**
 * Created by PhpStorm.
 * User: Matas
 * Date: 2015.11.21
 * Time: 19:18
 */

namespace DDD;


Interface IRepository {
    public function commit();
    public function createRepository();
}