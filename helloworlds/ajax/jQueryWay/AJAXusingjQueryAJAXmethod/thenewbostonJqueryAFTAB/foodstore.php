<?php
$food=$_GET['food'];
$foodArray= array('tuna','bacon', 'beef', 'loaf', 'ham');

if(in_array($food, $foodArray)){
    echo "We do have ". $food;
} elseif($food==''){
    echo 'Enter a food you idiot';
} else {
    echo "Sorry punk we dont sell no '$food' ";
}
?>