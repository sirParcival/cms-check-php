
<?php
$urls = [
    $_POST['ulr'], 
    // 'https://magecloud.agency/',
    // 'http://insulationstop.com/',
    // 'https://shine.org.ua/',
    ];

print_r($urls);

function download_file()
{
    global $urls;
    // $urls_new = array_unique($urls);
    $files_web = [];
    $all_websites = sizeof($urls);
    $url_el_id = 0;
    for ($i = 0; $i < $all_websites; $i++) {

        $ch = curl_init($urls[$url_el_id]);
        $dir = '../downloaded/'; // the base name of file  
        $file_name = basename($urls[$url_el_id]); // Use basename() function to return 
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
    return ($urls);
}

download_file();

$files_web_check = download_file($files_web); //ALL FILES
$websites_info = download_file($urls); //GET NOT DUPLICATED WEBSITES 
$num_websites = sizeof($files_web_check); //HOW MANY WEBSITES



// print_r($files_web_check);
// print_r('<br>'.$num_websites);

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
$el_list_id = 0; //ID FOR FIRST ELEMENT IN ARRAY OF WEBSITES
//--------ARRAY LIST FOR CMS CHECK---------//

//OPEN FILE FOR CHECK
$fh = fopen($files_web_check[0], 'r');
$olddata = fread($fh, filesize($files_web_check[$el_list_id]));
//OPEN FILE FOR CHECK


//LOOP FOR CHECKING

$i = 1;
while ($i <= $num_websites) {
    if(strpos($olddata, $check_list[0])) {

        //SHOW RESULT
        print_r($websites_info[$el_list_id]);
        echo ' == CMS WORDPRESS<br>';
        //SHOW RESULT

        unlink($websites_info[$el_list_id]);//DELETE FILE

        $el_list_id++;//TAKE NEXT WEBISTE
        $fh = fopen($files_web_check[$el_list_id], 'r');//OPEN NEXT WEBSITE
        $olddata = fread($fh, filesize($files_web_check[$el_list_id]));//READ FILE
    }
    elseif (strpos($olddata, $check_list[1]) || strpos($olddata, $check_list[2])) {

        print_r($websites_info[$el_list_id]);
        echo ' == MAGENTO 1<br>';

        unlink($websites_info[$el_list_id]);

        $el_list_id++;
        $fh = fopen($files_web_check[$el_list_id], 'r');
        $olddata = fread($fh, filesize($files_web_check[$el_list_id]));
    }
    else{
        print_r($websites_info[$el_list_id]);
        echo ' == UNDEFINED CMS<br>';

        unlink($websites_info[$el_list_id]);
    }
    $i++;
}
?> 