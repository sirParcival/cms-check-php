<?php

$a=array("1"=>"red","2"=>"green","3"=>"blue");
echo array_search("red",$a);


$myfile = fopen("downloaded/magecloud.agency", "r") or die("Unable to open file!");
// Output one line until end-of-file
while(!feof($myfile)) {
    $text[] = fgets($myfile);
}
fclose($myfile);

$key = array_search('html', $text); // $key = 2;
echo $key;


?>
