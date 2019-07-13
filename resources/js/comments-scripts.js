$('document').ready(function(){
  
  $('#submit_comment').on('click', function(e){
	  e.preventDefault();
	
    let user_id = $('#user_id').val();
    let comment = $('#comment').val();
	
	if(comment == ''){
		alert("Type a comment");
		return false;
	}
	
    $.ajax({
      url: '/spexproject/includes/commentsFunctions.php', 
      type: 'POST',
      data: {
        'submit_comment':1,
        'user_id': user_id,
        'body': comment,
      },
      success: function(response){
		
		$('#comments-area').prepend(response);
		
        $('#comment').val('');
        
      }
    });
	
  });
  
	//When user clicks reply link to add reply under another user's comment
	$('.reply-btn').on('click', function(e){
	  
		e.preventDefault();
	  
		// Get comment id from reply-btn data-id attrib.
		let comment_id = $(this).data('id');
		
		// show/hide the appropriate reply form (from the reply-btn (this), go to the parent element (comment-details)
		// and then its siblings which is a form element with id comment_reply_form_ + comment_id)
		
		$('form#comment_reply_form_'+ comment_id).toggle(400);
		
		$(this).text($(this).text() == 'Reply' ? 'Cancel' : 'Reply');
		
		
	
				
		$('.submit-reply').on('click', function(e){
			e.preventDefault();
			
			let reply_textarea = $(this).siblings('.reply-textarea');
			let reply_text = $(this).siblings('.reply-textarea').val();
			let user_id = $(this).siblings('.reply_form_user_id').val();
			
			if(reply_text == ''){
				return false;
			}
			$.ajax({
				url: '/spexproject/includes/commentsFunctions.php',
				type: 'POST',
				data:{
					'submit_reply':1,
					'user_id':user_id,
					'comment_id':comment_id,
					'reply_text': reply_text
				},
				success: function(data){
					if(data==='error'){
						alert('There was an error adding reply. Please try later...');
					}else{
						
						$('.replies_container_'+ comment_id).children('.replies_by_ajax').append(data);
						reply_textarea.val('');
						$('form#comment_reply_form_'+ comment_id).hide(400);
						$('a.reply-btn').text('Reply');
					}
				}
			});
			
		});
	});
	
	//When user clicks Show thread link replies are displayed
	$('.reply-thread').on('click', function(e){
		e.preventDefault();
		
		let thread_reply_id = $(this).data('id');
				
		$('.group.replies_container_'+ thread_reply_id).toggle(300);
		
		$(this).text($(this).text() == 'Show thread' ? 'Hide thread' : 'Show thread');
				
	});
});