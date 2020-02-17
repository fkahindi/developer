$('document').ready(function(){
	
	$('#tooltip').mouseenter(function(){
		
		if($('#profile-checkbox-control').prop('checked')== true){
			$('.tooltip-text').hide(200);
		}else{
			$('.tooltip-text').show(200);
		}
	});
	
	$('#profile-checkbox-control').on('click', function(){
			
			$('.tooltip-text').hide(200);
							
	});
	
	/*Drop down menu for mobile devices */
	$('#menu-checkbox-control').on('click', function(){
		
		$('.dropdown-content').toggle(100);
				
	});
	
	/* Monitor browser window size and display normal menu if size is greater than 600px */
	window.onresize = function(){
		
		if( document.documentElement.clientWidth < 600 || window.innerWidth < 617){
			$('.dropdown-content').hide();
		}else{
			$('.dropdown-content').show();
		}
	}
});