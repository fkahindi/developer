<?php
if(!isset($_SESSION)){
	session_start();
}
require_once __DIR__ .'/includes/comments_functions.php';

if(isset($_GET['pageno'])){
	$pageno = $_GET['pageno'];
}else{
	$pageno = 1;
}

$no_of_records_per_page = 10;
$offset = ($pageno - 1)*$no_of_records_per_page;

$total_rows = getCommentCountByPostId(1);;

$total_pages = ceil($total_rows/$no_of_records_per_page);

$limit=" LIMIT $offset, $no_of_records_per_page";

$comments = getAllPostComments(1, $limit);
?>

<ul class="pagination">
	<li><a href="?pageno=1">First</a></li>
	<li class="<?php if($pageno<=1){echo 'disabled';} ?>">
		<a href="<?php if($pageno<=1){echo '#';}else{echo "?pageno=".($pageno-1);} ?>">Prev</a>
	</li>
	<li class="<?php if($pageno>= $total_pages){echo 'disabled';} ?>">
		<a href="<?php if($pageno>= $total_pages){echo '#';}else{echo "?pageno=".($pageno+1);} ?>">Next</a>
	</li>
	<li><a href="?pageno=<?php echo $total_pages; ?>">Last</a></li>
</ul>