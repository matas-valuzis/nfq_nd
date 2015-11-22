<?php
/**
 * Created by PhpStorm.
 * User: Matas
 * Date: 2015.11.17
 * Time: 18:40
 */

namespace DDD;

require_once "../DataBase/SimpleMySqlDriver.php";
require_once "Comment.php";
require_once "Topic.php";
require_once "ITopicRepository.php";
require_once "ICommentRepository.php";


use DB\IDriver;
use PDO;

class Repository implements ICommentRepository, ITopicRepository{
    private $comment_table = "comments";
    private $topic_table = "topics";

    private $db_driver;

    function __construct(IDriver $db_driver)
    {
        $this->db_driver = $db_driver;
        $this->createRepository();
    }


    private function flush($select = false){

        if ($this->db_driver->queryIsEmpty())
            return [];

        if(!$this->db_driver->isConnected())
            $this->db_driver->connect();
        if (!$select)
            return $this->db_driver->execute();
        else
            return $this->db_driver->execute(true);

    }
    public function commit(){
        return $this->flush();
    }
    public function createRepository(){
        $tables = [
            $this->topic_table => [
                'id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY',
                'topic_name VARCHAR(50)',
                'comment_count INT(10) UNSIGNED DEFAULT 0',
                'created_date TIMESTAMP',
            ],
            $this->comment_table => [
                'id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY',
                'topic_id INT(10) UNSIGNED',
                'comment_text VARCHAR(144)',
                'comment_author VARCHAR(50)',
                'created_date TIMESTAMP',
            ],
        ];

        $table_query = "";


        foreach ($tables as $name => $fields){
            $table_query .= "CREATE TABLE IF NOT EXISTS $name (".implode(' ,', $fields).");";
        }


        $table_query .= $this->db_driver->getQuery();
        $this->db_driver->setQuery($table_query);
    }

    /**
     * @param Comment $arg
     */
    public function saveComment(Comment $arg){

        $id = $arg->getId();
        $topic_id = $arg->getTopicId();
        $comment_text = $arg->getCommentText();
        $comment_author = $arg->getCommentAuthor();
        $table = $this->comment_table;

        $q = "";
        $args = [];
        if ($arg->getId() != null){
            $q = "UPDATE $table SET topic_id=:topic_id, comment_text=:comment_text, comment_author=:comment_author WHERE id=:id";
            $args = [
                ':topic_id' => $topic_id,
                ':comment_text' => $comment_text,
                ':comment_author' => $comment_author,
                ':id' => $id
            ];
        }
        else{
            $q = "INSERT INTO $table (topic_id, comment_text, comment_author, created_date) VALUES (:topic_id, :comment_text, :comment_author, :time)";
            $args = [
                ':topic_id' => $topic_id,
                ':comment_text' => $comment_text,
                ':comment_author' => $comment_author,
                ':id' => $id,
                ':time' => date('Y-m-d h:m:s')
            ];
        }

        $this->db_driver->addQuery($q, $args);
    }

    /**
     * @param $id
     * @return Comment
     */
    public function getComment($id)
    {
        $table = $this->comment_table;
        $this->flush();
        $this->db_driver->setQuery("SELECT * FROM $table WHERE id=:id", [':id' => $id]);
        $results =  $this->flush(true);
        $com = new Comment();
        if (count($results) != 1){
            return $com;
        }
        $com->setId($results[0]['id'])
            ->setCommentAuthor($results[0]['comment_author'])
            ->setCommentText($results[0]['comment_text'])
            ->setTopicId($results[0]['topic_id'])
            ->setCreatedDate($results[0]['created_date']);
        return $com;
    }

    /**
     * @param $topic_id
     * @return array
     */
    public function getAllCommentsByTopic($topic_id)
    {
        $table = $this->comment_table;
        $this->flush();
        $this->db_driver->setQuery("SELECT * FROM $table WHERE topic_id=:topic_id", [':topic_id' => $topic_id]);
        $results =  $this->flush(true);
        $comments = [];
        if (count($results) < 1){
            return [];
        }
        foreach ($results as $result){
            $com = new Comment();
            $com->setId($result['id'])
                ->setCommentAuthor($result['comment_author'])
                ->setCommentText($result['comment_text'])
                ->setTopicId($result['topic_id'])
                ->setCreatedDate($result['created_date']);
            $comments[] = $com;
        }

        return $comments;
    }

    /**
     * @param $id
     * @return Topic
     */
    public function getTopic($id)
    {
        $table = $this->topic_table;
        $this->flush();
        $this->db_driver->setQuery("SELECT * FROM $table WHERE id=:id", [':id' => $id]);
        $results =  $this->flush(true);
        $topic = new Topic();
        if (count($results) != 1){
            return $topic;
        }
        $topic->setId($results[0]['id'])
            ->setName($results[0]['topic_name'])
            ->setCommentCount($results[0]['comment_count'])
            ->setCreatedDate($results[0]['created_date'])
            ->setComments($this->getAllCommentsByTopic($results[0]['id']));
        return $topic;
    }

    /**
     * @return array
     */
    public function getAllTopics()
    {
        $table = $this->topic_table;
        $this->flush();
        $this->db_driver->setQuery("SELECT * FROM $table");
        $results =  $this->flush(true);
        $topics = [];
        if (count($results) < 1){
            return [];
        }
        foreach ($results as $result){
            $topic = new Topic();
            $topic->setId($result['id'])
                ->setName($result['topic_name'])
                ->setCommentCount($result['comment_count'])
                ->setCreatedDate($result['created_date'])
                ->setComments($this->getAllCommentsByTopic($result['id']));
            $topics[] = $topic;
        }

        return $topics;
    }

    /**
     * @param Topic $topic
     * @return int
     */
    public function saveTopic(Topic & $arg)
    {
        $id = $arg->getId();
        $name = $arg->getName();
        $comment_count = $arg->getCommentCount();
        $table = $this->topic_table;
        $q = "";
        $args = [];
        if ($id != null){
            $q = "UPDATE $table SET topic_name=:name, comment_count=:comment_count WHERE id=:id";
            $args = [
                ':name' => $name,
                ':comment_count' => $comment_count,
                ':id' => $id
            ];
            $this->db_driver->addQuery($q, $args);
            $arg->setId($id);
            foreach ($arg->getComments() as $comment){
                $comment->setTopicId($id);
                $this->saveComment($comment);
            }
        }
        else{
            $q = "INSERT INTO $table (topic_name, comment_count, created_date) VALUES (:name, :comment_count, :time)";
            $args = [
                ':name' => $name,
                ':comment_count' => $comment_count,
                ':time' => date('Y-m-d h:m:s')
            ];
            $this->flush();
            $this->db_driver->addQuery($q, $args);
            $id = $this->flush(true);
            if ($id != false){
                $arg->setId($id);
                foreach ($arg->getComments() as $comment){
                    $comment->setTopicId($id);
                    $this->saveComment($comment);
                }
            }
        }

    }
}