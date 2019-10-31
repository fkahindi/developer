$('document').ready(function(){
	var name_state = false;
	var email_state = false;
	/**
	* Scripts to manage subscription form
	*/
	$('#name').on('blur',function(){
		var name = $('#name').val();
		var nameFilter = /^[\w\s.\-]*$/; //Check if it's a valid text
		
		//Validate text
		if(!nameFilter.test(name)){
			name_state = false;
			$('#name').parent().removeClass();
			$('#name').parent().addClass("form_error");
			$('#name').siblings("span").text('Name contains illegal characters');
		}else{
			name_state = true;
			$('#name').parent().removeClass();
			$('#name').parent().addClass("form_success");
			$('#name').siblings("span").text('');
		}
	});
		
	$('#email').on('change',function(){
		var email = $('#email').val();
		var emailFilter = /^[^@]+@[^@.]+\.[^@]*\w\w$/ ; //Check if it's valid mail address
		var illegalChars = /[\(\)\<\>\,\;\:\\\"\[\]]/ ; // Check for illegal characters
		if (email == '') {
			email_state = false;
			return;
		}
		//Further email validation
		if(!emailFilter.test(email)){
			email_state = false;
			$('#email').parent().removeClass();
			$('#email').parent().addClass("form_error");
			$('#email').siblings("span").text('Please! Enter valid email address');
		}else if(email.match(illegalChars)){
			email_state = false;
			$('#email').parent().removeClass();
			$('#email').parent().addClass("form_error");
			$('#email').siblings("span").text('Sorry... Email address contains illegal characters');
		}else{
			email_state = true;
			$('#email').parent().removeClass();
			$('#email').parent().addClass("form_success");
			$('#email').siblings("span").text('');
		}
	});
	$('#submit_subscribe').on('click',function(e){
		var name = $('#name').val();
		var email = $('#email').val();
		e.preventDefault();
		if(name ==''){
				name_state = true;
		}
		if(email == ''){
			email_state = false;
			$('#email').parent().removeClass();
			$('#email').parent().addClass("form_error");
			$('#email').siblings("span").text('Please! Fill email address field');
		}
		if(name_state == false || email_state == false){
			$('.subscribe_error').text('Fix errors in the form first');
			
		}else {
			$.ajax({
				url: '/spexproject/includes/subscribeFormFunctions.php', 
				type: 'POST',
				data: {
				'subscribe':1,
				'name': name,
				'email': email
				},
				success: function(response){
				
				$('#subscribe_response').append(response);
		
				$('#name').val('');
				$('#email').val('');
				$('.subscribe_error').text('');
				}
			}); 
		}	
	});
  
  /*
  * The following are:
  *	Scripts to manage user comments on articles
  */
  $('#submit_comment').on('click', function(e){
	  e.preventDefault();
	
    var user_id = $('#user_id').val();
	var page_id = $('#page_id').val();
    var comment = $('#comment').val();
	
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
		'page_id': page_id,
        'body': comment,
      },
      success: function(response){
		
		$('#comments-area').prepend(response);
		
        $('#comment').val('');
		comment = '';
      }
    });
  });
  
  /*
  * The following are:
  *	Scripts to manage replies to comments on articles
  */
	//When user clicks reply link to add reply under user's comment
	$('.reply-btn').on('click', function(e){
	  
		e.preventDefault();
	  
		// Get comment id from reply-btn data-id attrib.
		var comment_id = $(this).data('id');
		
		// show/hide the appropriate reply form (from the reply-btn (this), go to the parent element (comment-details)
		// and then its siblings which is a form element with id comment_reply_form_ + comment_id)
		
		$('form#comment_reply_form_'+ comment_id).toggle(100);
		
		$(this).text($(this).text() == 'Reply' ? 'Cancel' : 'Reply');
						
		$('.submit-reply').on('click', function(e){
			e.preventDefault();
			
			var reply_textarea = $(this).siblings('.reply-textarea');
			var reply_text = $(this).siblings('.reply-textarea').val();
			var user_id = $(this).siblings('.reply_form_user_id').val();
			
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
						$('form#comment_reply_form_'+ comment_id).hide(100);
						$('a.reply-btn').text('Reply');
						$('.group.replies_container_'+ comment_id).show(100);
						comment_id = '';
					}
				}
			});
			
		});
	});
	
	//When user clicks Show thread link replies are displayed
	$('.reply-thread').on('click', function(e){
		e.preventDefault();
		
		var thread_reply_id = $(this).data('id');
		var html1="&#9650;";
		var html2= "&#9660;";
				
		$('.group.replies_container_'+ thread_reply_id).toggle(100);
		
		$(this).text($(this).text() == convertEntities(html1) ? convertEntities(html2) : convertEntities(html1));
				
	});
	function convertEntities(html){
		var el = document.createElement("div");
		el.innerHTML = html;
		return el.firstChild.data;
	}
});