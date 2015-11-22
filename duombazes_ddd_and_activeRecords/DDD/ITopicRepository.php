<?php
/**
 * Created by PhpStorm.
 * User: Matas
 * Date: 2015.11.21
 * Time: 19:30
 */

namespace DDD;
require_once "IRepository.php";

/**
 * Interface ITopicRepository
 * @package DDD
 */
interface ITopicRepository extends IRepository{
    /**
     * @param $id
     * @return Topic
     */
    public function getTopic($id);

    /**
     * @return array
     */
    public function getAllTopics();

    /**
     * @param Topic $topic
     * @return void
     */
    public function saveTopic(Topic & $topic);


}