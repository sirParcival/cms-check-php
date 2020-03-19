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

$filename = 'downloaded/magecloud.agency';
$searchfor = 'wp-content';
$fh = fopen($filename, 'r');
$olddata = fread($fh, filesize($filename));
if(strpos($olddata, $searchfor)) {
    echo 'CMS WORDPRESS';
}
else {
    echo 'SHIT!';
}
fclose($fh);
?> 