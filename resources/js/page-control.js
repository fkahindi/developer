$('document').ready(function(){
	$('#tooltip').mouseenter(function(){
		if($('#profile-checkbox-control').prop('checked')=== true){
			$('.tooltip-text').hide(200);
		}else{
			$('.tooltip-text').show(200);
		}
	});
	$('#profile-checkbox-control').on('click',function(){
		$('.tooltip-text').hide(200);		
	});
	/*Drop down menu for mobile devices */
	$('#dropdown-menu-btn').on('click', function(){
			$('#dropdown-menu-btn').hide();
			$('.dropdown-content').show(100);			
	});
	$('.closebtn').on('click', function(){
		$('#dropdown-menu-btn').show();
		$('.dropdown-content').hide(100);	
	});
	/* Monitor browser window size and display normal menu if size is greater than 600px */
	window.onresize = function(){
		if( document.documentElement.clientWidth < 600 || window.innerWidth < 617){
			$('.dropdown-content').hide();
			$('#dropdown-menu-btn').show;
		}else{
			$('.dropdown-content').show();
		}
	}
	/* Function to generate keywords from the current article and puts them in the keyswords meta tag at the head. */
		function getKeywords(){
			var keywords = [];
			var elements = document.querySelectorAll('.key');
			for(var element of elements){
				keywords.push(element.innerHTML);
			}
			return String(keywords);
		}
		/* Get keyswords for meta */
		var meta = document.getElementsByName('keywords')[0];
		var words = getKeywords();
		meta.setAttribute("content",words.toLowerCase());
});