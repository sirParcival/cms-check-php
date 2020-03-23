
<?php
header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="table.csv"');

$urls = [
    'https://magecloud.agency/',
    'http://insulationstop.com/',
    'https://shine.org.ua/',
    ];


function download_file()
{
    global $urls;

    if (sizeof($urls) > 1){
        $urls_new = array_unique($urls);
    }
    else{
        $urls_new = $urls;
    }

    // $urls_new = array_unique($urls);
    $files_web = [];
    $all_websites = sizeof($urls);
    $url_el_id = 0;
    for ($i = 0; $i < $all_websites; $i++) {

        $ch = curl_init($urls_new[$url_el_id]);
        $dir = '../downloaded/'; // the base name of file  
        $file_name = basename($urls_new[$url_el_id]); // Use basename() function to return 
        $save_file_loc = $dir . $file_name; // Save file into file location 
        $fp = fopen($save_file_loc, 'wb'); // Open file  
        curl_setopt($ch, CURLOPT_FILE, $fp); // It set an option for a cURL transfer 
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_exec($ch); // Perform a cURL session 
        curl_close($ch); // Closes a cURL session and frees all resources  
        fclose($fp); // Close file

        //WRITE ALL FILES IN ARRAY TO WORK WITH THEM
        array_push($files_web, $save_file_loc);
        $url_el_id++;
    }
    return ($files_web);
    //FOR PRINT URLS NEAR RESULTS
    return ($urls_new);
}

download_file();

$files_web_check = download_file($files_web); //ALL FILES
$websites_info = download_file($urls); //GET NOT DUPLICATED WEBSITES 
$num_websites = sizeof($files_web_check); //HOW MANY WEBSITES



// CHECK FOR DUPLICATED WEBSITES

// --------ARRAY LIST FOR CMS CHECK---------//
$check_list=[
    "wp-content",
    //Magento1
    'skin/frontend',
    'media',
    //Magento1
];
//--------ARRAY LIST FOR CMS CHECK---------//
$all_check_number = sizeof($check_list);
$el_check_id = 0; //ID FOR FIRST ELEMENT IN ARRAY FOR CHECK
$el_list_id = 0;//ID FOR FIRST ELEMENT IN ARRAY OF WEBSITES
$array_list_id = 1;
//--------ARRAY LIST FOR CMS CHECK---------//

//OPEN FILE FOR CHECK
$fh = fopen($files_web_check[0], 'r');
$olddata = fread($fh, filesize($files_web_check[$el_list_id]));
//OPEN FILE FOR CHECK


//LOOP FOR CHECKING

$result_web[0] = array('Number', 'Website', 'CMS');

$i = 1;
while ($i <= $num_websites) {
    if(strpos($olddata, $check_list[0])) {

        //SHOW RESULT
        // print_r($websites_info[$el_list_id]);
        $cms = 'WORDPRESS';
        // echo ' == CMS WORDPRESS<br>';
        //SHOW RESULT
        
        $result_web[$array_list_id] = array($array_list_id, $websites_info[$el_list_id], $cms);//ADD TO 

        unlink($websites_info[$el_list_id]);//DELETE FILE

        $el_list_id++;//TAKE NEXT WEBISTE
        $array_list_id++;//NEXT ROW TABLE
        $fh = fopen($files_web_check[$el_list_id], 'r');//OPEN NEXT WEBSITE
        $olddata = fread($fh, filesize($files_web_check[$el_list_id]));//READ FILE
    }
    elseif (strpos($olddata, $check_list[1]) || strpos($olddata, $check_list[2])) {

        // print_r($websites_info[$el_list_id]);
        // echo ' == MAGENTO 1<br>';
        $cms = 'MAGENTO 1';


        $result_web[$array_list_id] = array($array_list_id, $websites_info[$el_list_id], $cms);
        $array_list_id++;
        unlink($websites_info[$el_list_id]);

        $el_list_id++;
        $fh = fopen($files_web_check[$el_list_id], 'r');
        $olddata = fread($fh, filesize($files_web_check[$el_list_id]));
    }
    else{
        // print_r($websites_info[$el_list_id]);
        // echo ' == UNDEFINDED CMS<br>';
        $cms = 'UNDEFINDED';
        $result_web[$array_list_id] = array($array_list_id, $websites_info[$el_list_id], $cms);
        $array_list_id++;
        unlink($websites_info[$el_list_id]);
    }
    $i++;
}

//WRITE INTO CSV FILE
$fp = fopen('php://output', 'wb');
foreach ($result_web as $line) {
    fputcsv($fp, $line, ',');
}
fclose($fp);

?> 