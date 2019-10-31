<?php
 echo 'Page uri is: '.$_SERVER['REQUEST_URI'].'<br>'; 
 echo 'Host server is: '.$_SERVER['SERVER_NAME'].'<br>'; 
 echo 'server address is: '.$_SERVER['SERVER_ADDR'].'<br>'; 
 
 ?>
 <script>
	function convertEntities(html){
		var el = document.createElement("span");
		el.innerHTML = html;
		return el.firstChild.data;
	}
	var html = "&#9650; &#9660;";
	var text = convertEntities(html);
	document.write(text);
 </script>
 <?php
 echo "Today is " . date("Y/m/d") . "<br>"; 
echo "Today is " . date("Y.m.d") . "<br>"; 
echo "Today is " . date("Y-m-d") . "<br>"; 
echo "Today is " . date("l"). "<br>"; 
echo __DIR__;