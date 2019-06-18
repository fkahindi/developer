$(document).ready(function(){
  // save comment to database
  $('#post_btn').on('click', function(){
    var user_id = $('#user_id').val();
    var body = $('#comment').val();
	
	if($body == ''){
		return;
	}
    $.ajax({
      url: '/spexproject/comments/layout/comments_server.php',
      type: 'POST',
      data: {
        'save': 1,
        'user_id': user_id,
        'body': body,
      },
      success: function(response){
        
        $('#comment').val('');
        $('#comments_display_area').append(response);
      }
    });
  });
