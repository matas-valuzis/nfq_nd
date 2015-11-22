<?php
/**
 * Created by PhpStorm.
 * User: Matas
 * Date: 2015.11.17
 * Time: 18:12
 */

namespace ActiveRecord;
require_once "AbstractActiveRecord.php";

class Comment extends AbstractActiveRecord{

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
        if ($this->id != null)
            return $this->created_date;
        else return date('Y-m-d h:m:s');
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

    protected function getTable()
    {
        return "comments";
    }

    protected function getFields()
    {
        return [
            'id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY',
            'topic_id INT(10) UNSIGNED',
            'comment_text VARCHAR(144)',
            'comment_author VARCHAR(50)',
            'created_date TIMESTAMP'
        ];
    }

    protected function createFromAssoc($result)
    {
        $com = new Comment();
        $com->setId($result['id'])
            ->setCommentAuthor($result['comment_author'])
            ->setCommentText($result['comment_text'])
            ->setTopicId($result['topic_id'])
            ->setCreatedDate($result['created_date']);
        return $com;
    }


    protected function getSaveValues()
    {
        return [
            'id' => $this->id,
            'topic_id' => $this->topic_id,
            'comment_text' => $this->comment_text,
            'comment_author' => $this->comment_author,
            'created_date' => $this->getCreatedDate()
        ];
    }
}