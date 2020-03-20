$('document').ready(function(){
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