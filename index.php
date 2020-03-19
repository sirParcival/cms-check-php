<?php 
function download_file(){
    // Initialize a file URL to the variable 
    $url = 'https://magecloud.agency/'; 
      
    // Initialize the cURL session 
    $ch = curl_init($url); 
      
    // Inintialize directory name where 
    // file will be save 
    $dir = 'downloaded/'; 
      
    // Use basename() function to return 
    // the base name of file  
    $file_name = basename($url); 
      
    // Save file into file location 
    $save_file_loc = $dir . $file_name; 
      
    // Open file  
    $fp = fopen($save_file_loc, 'wb'); 
      
    // It set an option for a cURL transfer 
    curl_setopt($ch, CURLOPT_FILE, $fp); 
    curl_setopt($ch, CURLOPT_HEADER, 0); 
      
    // Perform a cURL session 
    curl_exec($ch); 
      
    // Closes a cURL session and frees all resources 
    curl_close($ch); 
      
    // Close file 
    fclose($fp); 
    // $fileip = file_get_contents($save_file_loc);
    // echo $fileip;
    }
download_file();
//BY $FILENAME WE GET TO FILE 
$filename = 'downloaded/magecloud.agency';


$check_list=array("1"=>"wp-content","2"=>"MageCloud","3"=>"blue");

$el_list_id = 1;

$fh = fopen($filename, 'r');
$olddata = fread($fh, filesize($filename));

for ($el_list_id = 1; $el_list_id <= 10; $el_list_id++) {
    echo $el_list_id;
}
// if(strpos($olddata, $check_list[$el_list_id])) {
//     echo 'CMS WORDPRESS';
// }
// elseif (strpos($olddata, $check_list[2])) {
//     echo 'Ok';
// }
// else {
//     echo 'SHIT!';
// }
fclose($fh);
?> 