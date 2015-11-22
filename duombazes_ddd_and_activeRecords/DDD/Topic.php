<?php
/**
 * Created by PhpStorm.
 * User: Matas
 * Date: 2015.11.17
 * Time: 18:24
 */

namespace DDD;

class Topic {
    private $id = null;
    private $name = "";
    private $comments = [];
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
        return $this->comments;
    }

    /**
     * @param array $comments
     */
    public function setComments(array $comments)
    {
        $this->comments = $comments;
        return $this;
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
        $this->comments[] = $c;
        $this->comment_count++;
        $c->setTopicId($this->id);
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
        return $this->created_date;
    }

    /**
     * @param mixed $created_date
     */
    public function setCreatedDate($created_date)
    {
        $this->created_date = $created_date;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

}