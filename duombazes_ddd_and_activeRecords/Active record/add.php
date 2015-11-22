<?php
/**
 * Created by PhpStorm.
 * User: Matas
 * Date: 2015.11.17
 * Time: 18:11
 */

include_once "Comment.php";
include_once "Topic.php";

use ActiveRecord\Comment;
use ActiveRecord\Topic;

try{
    $topic_id = $_GET['topic_id'];
    $text = $_GET['text'];
    $author = $_GET['author'];

    $com = new Comment();
    $topic = new Topic();
    $com->setCommentText($text)
        ->setCommentAuthor($author)
        ->setTopicId($topic_id);
    $topic= $topic->getAll([['id', '=', $topic_id]])[0];
    $topic->addComment($com);
    $topic->save();

    echo "Komentaras issaugotas";

}catch (Exception $e){

    echo "Ivyko klaida";
}