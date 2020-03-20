<div class="published-topics">
<?php $topics = getAllTopics()?>
 <?php foreach($topics as $topic): ?>
	<ul><li> <?php echo $topic['topic_name']?><ul><li>
	 <?php $topic_id = $topic['topic_id'] ?>
	 <?php $published_posts = getPublishedPostsByTopic($topic_id)?>
	 <?php foreach($published_posts as $pub_post):?>
		<p><a href="<?php echo BASE_URL ?>templates/post.html.php?id=<?php echo $pub_post['post_id'] ?>&title=<?php echo $pub_post['post_slug']?>"><?php echo $pub_post['post_title']?></a></p>
	 <?php endforeach ?></li></ul></li></ul>
 <?php endforeach ?>
 </div>