<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
   "http://www.w3.org/TR/html4/loose.dtd">

<html lang="en">
	<head>
		<title>Associative Arrays</title>
	</head>
	<body>
		
		<?php $assoc = array("first_name" => "Kevin", "last_name" => "Skoglund"); ?>
		<?php echo $assoc["first_name"]; ?><br />
		<?php echo $assoc["first_name"] . " " . $assoc["last_name"]; ?><br />

		<?php $assoc["first_name"] = "Larry"; ?>
		<?php echo $assoc["first_name"] . " " . $assoc["last_name"]; ?><br />

		<?php // echo $assoc[0]; ?><br />

		<?php $numbers = array(4,8,15,16,23,42); ?>
		<?php $numbers = array(0 => 4, 1 => 8, 2 => 15, 3 => 16, 4 => 23, 5 => 42); ?>
		<?php echo $numbers[0]; ?>


        <?php
        echo"<pre>";
        echo "array keys";
        echo "<hr>";

        $array = array(0 => 100, "color" => "red");
        print_r(array_keys($array));

        echo "<hr>";

        $array = array("blue", "red", "green", "blue", "blue");
        print_r(array_keys($array, "blue"));

        foreach($array as $key=> $val){
            echo $key." ".$val."<br>";
        }

        echo "<hr>";

                $array = array("color" => array("blue", "red", "green"),
            "size"  => array("small", "medium", "large"));
        print_r(array_keys($array));



        echo "<hr>";



        echo "array replace ";
        $base = array("orange", "banana", "apple", "raspberry");
        $replacements = array(0 => "pineapple", 4 => "cherry");
        $replacements2 = array(0 => "grape");

        $basket = array_replace($base, $replacements, $replacements2);
        print_r($basket);


        echo"</pre>";
        ?>





		
	</body>
</html>
