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

$db = new Repository(new SimpleMySqlDriver());
$topics = $db->getAllTopics();

foreach ($topics as $topic){
    print $topic->getName()."(".$topic->getCommentCount()."): <br>";

    foreach ($topic->getComments() as $comment){
        print "---(".$comment->getCreatedDate().")".$comment->getCommentAuthor().": ".$comment->getCommentText()."<br>";
    }
}


print "<br><br><br> Prideti nauja komentara: /DDD/add.php?author=User2&text=Labas&topic_id=2";