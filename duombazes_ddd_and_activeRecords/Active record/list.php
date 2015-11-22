<?php
/**
 * Created by PhpStorm.
 * User: Matas
 * Date: 2015.11.17
 * Time: 18:11
 */

use ActiveRecord\Topic;
require_once "Comment.php";
require_once "Topic.php";



foreach (new Topic() as $topic){
    print $topic->getName()."(".$topic->getCommentCount()."): <br>";

    foreach ($topic->getComments() as $comment){
        print "---(".$comment->getCreatedDate().")".$comment->getCommentAuthor().": ".$comment->getCommentText()."<br>";
    }
}


print "<br><br><br> Prideti nauja komentara: /Active%20record/add.php?author=User2&text=Labas&topic_id=2";