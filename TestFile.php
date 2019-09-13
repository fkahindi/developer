<?php
include __DIR__ . '/admin/includes/posts_functions.php';

$recent_posts = getMostRecentPosts();

foreach($recent_posts as  $recent_post){
	echo $recent_post['post_title'].'<br>';
}