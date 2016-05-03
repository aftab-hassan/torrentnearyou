<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Zhao Yu Code</title>

<script type="text/javascript">

function searching()
{
	if(window.XMLHttpRequest){
		xhr = new XMLHttpRequest();
	}else
	{
		xhr = new ActiveObject('Microsoft.XMLHTTP');
	}
	
	xhr.onreadystatechange = function(){
		
	if((xhr.readyState==4)&&(xhr.status == 200||xhr.status == 304))
	{
		document.getElementById("underInput").innerHTML = xhr.responseText;
	}	
	
	};//close function xhr.onreadystatechange
	
		xhr.open("GET", 'search.inc.php?userInput='+document.yolo.userInput.value, true);
		
		
		xhr.send();
}

</script>


</head>



<body>
<h3>The Chuff Bucket</h3>
<form id='yolo' name="yolo">
<label for="text">Enter food you would like to buy</label>
<input type="text" name="userInput" id="userInput" onkeyup="searching()"/>
<div id="underInput" style="color:#03C"></div>
</form>

</body>
</html>