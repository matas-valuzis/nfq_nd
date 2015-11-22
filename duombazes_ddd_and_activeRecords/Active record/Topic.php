<?php
/**
 * Created by PhpStorm.
 * User: Matas
 * Date: 2015.11.17
 * Time: 18:24
 */

namespace ActiveRecord;

use ActiveRecord\Comment;

require_once "AbstractActiveRecord.php";

class Topic extends AbstractActiveRecord{

    private $name = "";
    private $comment_count = 0;
    private $created_date;


    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return array
     */
    public function getComments()
    {
        if ($this->id == null){
            return [];
        }
        $com = new Comment();
        return $com->getAll([ ['topic_id', '=', $this->id] ]);
    }

    /**
     * @return mixed
     */
    public function getCommentCount()
    {
        return $this->comment_count;
    }

    /**
     * @param Comment $c
     */
    public function addComment(Comment & $c){
        if ($this->id == null){
            $this->save();
        }
        $this->comment_count++;
        $c->setTopicId($this->id);
        $c->save();
        return $this;
    }

    /**
     * @param mixed $comment_count
     */
    public function setCommentCount($comment_count)
    {
        $this->comment_count = $comment_count;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCreatedDate()
    {
        if ($this->id != null)
            return $this->created_date;
        else return date('Y-m-d h:m:s');
    }

    /**
     * @param mixed $created_date
     */
    public function setCreatedDate($created_date)
    {
        $this->created_date = $created_date;
        return $this;
    }


    protected function getTable()
    {
        return "topics";
    }

    protected function getFields()
    {
        return [
            'id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY',
            'topic_name VARCHAR(50)',
            'comment_count INT(10) UNSIGNED DEFAULT 0',
            'created_date TIMESTAMP',
        ];
    }

    protected function getSaveValues()
    {
        return [
            'topic_name' => $this->name,
            'comment_count' => $this->comment_count,
            'created_date' => $this->getCreatedDate()
        ];
    }

    protected function createFromAssoc($result)
    {
        $topic = new Topic();
        $topic->setId($result['id'])
            ->setName($result['topic_name'])
            ->setCommentCount($result['comment_count'])
            ->setCreatedDate($result['created_date']);
        return $topic;
    }
}