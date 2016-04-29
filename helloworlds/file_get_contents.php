<?php
$url='https://oscarliang.com';
//file_get_contents() reads remote webpage content
$lines_string=file_get_contents($url);
//output, you can also save it locally on the server
echo htmlspecialchars($lines_string);
?>