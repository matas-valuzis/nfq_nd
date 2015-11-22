<?php
/**
 * Created by PhpStorm.
 * User: Matas
 * Date: 2015.11.17
 * Time: 18:12
 */

namespace DDD;

class Comment {

    private $id = null;
    private $topic_id = 0;
    private $comment_text = "";
    private $comment_author = "";
    private $created_date;

    /**
     * @return mixed
     */
    public function getCommentAuthor()
    {
        return $this->comment_author;
    }

    /**
     * @param mixed $comment_author
     */
    public function setCommentAuthor($comment_author)
    {
        $this->comment_author = $comment_author;
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
     * @return mixed
     */
    public function getCommentText()
    {
        return $this->comment_text;

    }

    /**
     * @param mixed $comment_text
     */
    public function setCommentText($comment_text)
    {
        $this->comment_text = $comment_text;
        return $this;

    }


    public function save(){
        return True;
    }

    /**
     * @return null
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param null $id
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;

    }

    /**
     * @return null
     */
    public function getTopicId()
    {
        return $this->topic_id;
    }

    /**
     * @param null $topic_id
     */
    public function setTopicId($topic_id)
    {
        $this->topic_id = $topic_id;
        return $this;
    }

    /**
     * @param mixed $created_date
     */
    public function setCreatedDate($created_date)
    {
        $this->created_date = $created_date;
    }
}