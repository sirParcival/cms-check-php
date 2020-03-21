
<?php
function download_file()
{
    $urls = [
        'https://magecloud.agency/',
        'https://stackoverflow.com/',
        'https://shine.org.ua/',
        'https://www.php.net/',
    ];
    $urls_new = array_unique($urls);
    $files_web = [];
    $all_websites = sizeof($urls_new);
    $url_el_id = 0;
    for ($i = 0; $i < $all_websites; $i++) {

        $ch = curl_init($urls_new[$url_el_id]);
        $dir = 'downloaded/';

        // Use basename() function to return 
        // the base name of file  
        $file_name = basename($urls_new[$url_el_id]);

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

        //WRITE ALL FILES IN ARRAY TO WORK WITH THEM
        array_push($files_web, $save_file_loc);
        $url_el_id++;
    }
    return ($files_web);
}

download_file();

$files_web_check = download_file($files_web); //ALL FILES
$num_websites = sizeof($files_web_check); //HOW MANY WEBSITES

// print_r($files_web_check);
// print_r('<br>'.$num_websites);

// CHECK FOR DUPLICATED WEBSITES

// --------ARRAY LIST FOR CMS CHECK---------//
$check_list=[
    "wp-content",
    '<div class="py64">',
    'test1',
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
        echo $el_list_id.'CMS WORDPRESS<br>';
        $el_list_id++;//TAKE NEXT WEBISTE
        $fh = fopen($files_web_check[$el_list_id], 'r');
        $olddata = fread($fh, filesize($files_web_check[$el_list_id]));
    }
    elseif (strpos($olddata, $check_list[1])) {
        echo $el_list_id.'STACKOVERFLOW<br>';
        $el_list_id++;//TAKE NEXT WEBISTE
        $fh = fopen($files_web_check[$el_list_id], 'r');
        $olddata = fread($fh, filesize($files_web_check[$el_list_id]));
    }
    else{
        echo $el_list_id.'IDK<br>';
    }
    $i++;
}


// // for($i = 0; $i < $num_websites;$i++){
// //     if(strpos($olddata, $check_list[$el_check_id])) {
// //         echo $el_list_id.' CMS WORDPRESS;  ';
// //         $el_list_id++;//TAKE NEXT WEBISTE
// //         $olddata = fread($fh, filesize($files_web_check[$el_list_id]));//OPEN NEXT WEBSITE
// //     }
// //     elseif (strpos($olddata, $check_list[1])) {
// //         echo $el_list_id.' CMS MAGENTO;  ';
// //         $el_list_id++;//TAKE NEXT WEBISTE
// //         $olddata = fread($fh, filesize($files_web_check[$el_list_id]));//OPEN NEXT WEBSITE
// //     }
// // }

// fclose($fh);
// // for($i = 0; $i < $max_array_id;$i++)
// // {   
// //     if(strpos($olddata, $check_list[0])) {
// //         echo $files_web_check,' CMS WORDPRESS';

// //         break;
// //     }
// //     elseif (strpos($olddata, $check_list[2])) {
// //         echo 'Here we have MageCloud';
// //         break;
// //     }
// //     else {
// //         echo $files_web_check,' ','Oh shit here we go again!';
// //         break;
// //     }
// //     $el_list_id++;
// // }

?> 