<?php

//												  read & write
// mode   r read from start (must exists)			r+
//		  w truncate / write from start				w+
//		  a append/ write from end					a+  will create if does not exists
//        x write from start (can't exists)			x+

//		   window mode /r/n/						t    eg rt

$file = 'filetest.txt';
if($handle = fopen($file, 'w')) {
	fclose($handle);
} else {
	echo "Could not open file for writing.";
}

echo $handle;
echo "<br>";







?>