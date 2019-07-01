$('document').ready(function(){
  // save comment to database
  $('#post_btn').on('click', function(e){
	  e.preventDefault();
	
    let user_id = $('#user_id').val();
    let comment = $('#comment').val();
	
	if(comment == ''){
		alert("Type a comment");
		return false;
	}
	
    $.ajax({
      url: '/spexproject/comments/layout/comments_server.php', 
      type: 'POST',
      data: {
        'save':1,
        'user_id': user_id,
        'body': comment,
      },
      success: function(response){
		
		$('#comments_display_area').append(response);
		
        $('#comment').val('');
        
      }
    });
	
  });
});