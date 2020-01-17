<?php
	
	session_start();

	$q = $_REQUEST["q"];

    if ($q != "clear") {

       $text = $_POST['text'];
     
        $fp = fopen("info.txt", 'a');
        fwrite($fp, "<".$q.">".$text."</".$q.">");
        fclose($fp);
    }
    else {
        $file = fopen("info.txt", "a+");
        ftruncate($file,0);
        fclose($file);
    }
?>