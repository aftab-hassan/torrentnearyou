<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<?php
if(isset($_GET['userInput']))
{
	$search_text = $_GET['userInput'];
	$food = strtolower($search_text);
}

$food_array = array('tuna','beef','ham','bacon','loaf');
	
	if(in_array($food,$food_array))
	{
		echo 'We do have '.$food.'!';
	}
	elseif($search_text=='')
	{
		echo 'Enter food you idiot';
	}
	else
	{
		echo 'Sorry punk we dont sell no '.$food.'!';
	}

?>
</body>
</html>