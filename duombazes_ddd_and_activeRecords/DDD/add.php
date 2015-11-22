<?php
/**
 * Created by PhpStorm.
 * User: Matas
 * Date: 2015.11.17
 * Time: 18:11
 */
require_once "Repository.php";
use DB\SimpleMySqlDriver;
use DDD\Comment;
use DDD\Topic;
use DDD\Repository;

try{
    $topic_id = $_GET['topic_id'];
    $text = $_GET['text'];
    $author = $_GET['author'];

    $rep = new Repository(new SimpleMySqlDriver());
    $com = new Comment();
    $topic = $rep->getTopic($topic_id);
    $com->setCommentText($text)
        ->setCommentAuthor($author)
        ->setTopicId($topic_id);
    $topic->addComment($com);
    $rep->saveTopic($topic);
    $rep->commit();

    echo "Komentaras issaugotas";

}catch (Exception $e){

    echo "Ivyko klaida";
}

