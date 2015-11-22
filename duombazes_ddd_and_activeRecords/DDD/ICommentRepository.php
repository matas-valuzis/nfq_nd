<?php
/**
 * Created by PhpStorm.
 * User: Matas
 * Date: 2015.11.21
 * Time: 19:19
 */

namespace DDD;
require_once "IRepository.php";

/**
 * Interface ICommentRepository
 * @package DDD
 */
interface ICommentRepository extends IRepository{
    /**
     * @param $id
     * @return Comment
     */
    public function getComment($id);

    /**
     * @param $topic_id
     * @return array
     */
    public function getAllCommentsByTopic($topic_id);

    /**
     * @param Comment $comment
     * @return void
     */
    public function saveComment(Comment $comment);
}