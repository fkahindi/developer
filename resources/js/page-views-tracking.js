$('document').ready(function(){
	//Set the text data
	var dataText = 'page=<?php echo $_SERVER['REQUEST_URI']; ?>&referrer=<?php echo $_SERVER['SERVER_NAME']; ?>';
	alert(dataText);
	//Create an AJAX request
	/* $.ajax({
		type: POST,
		url:'/spexproject/includes/process_stats.php',
		data: dataText,
		success: function(){
			alert('Page has been added to stats');
		}
	}); */
});