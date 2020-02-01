<?php
if(isset($_GET['page_no'])){
	$page_no = $_GET['page_no'];
}else{
	$page_no = 1;
}

$no_of_records_per_page = 5;

$offset = ($page_no - 1)*$no_of_records_per_page;

$number_of_pages = ceil($total_comments/$no_of_records_per_page);

$limit=" LIMIT $offset, $no_of_records_per_page";
?>
