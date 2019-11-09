<?php
 include __DIR__ .'/admin/includes/posts_functions.php';
 include __DIR__ .'/admin/includes/admin_functions.php';
 $published_post_ids = getAllPublishedPostIds();
 
 /* foreach($published_post_ids as $post_id){

	$topic_id = getPublishedTopics($post_id['post_id'])['topic_id'];
	echo getTopicNameById($topic_id).'<br>';
	$posts = getPublishedPostsByTopic($topic_id);
	foreach($posts as $post){
	echo $post['post_title'].'<br>';
	}
 } */
 $topics = getAllTopics();
 foreach($topics as $topic){
	 echo $topic['topic_name'].'<br>';
	 $topic_id = $topic['topic_id'];
	 $posts = getPublishedPostsByTopic($topic_id);
	 foreach($posts as $post){
		echo $post['post_title'].'<br>';
	}
 }