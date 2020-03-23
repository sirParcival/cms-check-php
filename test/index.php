<?php 


$urls = [
    'https://magecloud.agency/',
    'http://insulationstop.com/',
    'https://shine.org.ua/',
    ];

$check_list=[
    "wp-content",
    'skin/frontend',//Magento1
    'media',//Magento1
];
$websites = [];
function get_web($urls, $websites){
    $urls_download = 0;
    $a = 0;
    for ($i=0; $i < sizeof($urls); $i++){
        $websites[$a] = file_get_contents($urls[$urls_download]);
        $a++;
        $urls_download++;
    }
}


function check_web($websites, $check_list){
    $el_web_id = 0;
    $i = 1;
    while ($i <= sizeof($websites)) {
        if(strpos($websites[$el_web_id], $check_list[0])) {
            echo 'CMS WORDPRESS<br>';
            $el_web_id++;
        }
        elseif(strpos($websites[$el_web_id], $check_list[1]) || strpos($websites[$el_web_id], $check_list[2])) {
            echo 'CMS MAGENTO<br>';
            $el_web_id++;
        }

        else{
            echo 'CMS NO<br>';
            $el_web_id++;
            $el_check_id++;
        }
    $i++;
    }
}

get_web($urls, $websites);
check_web($websites, $check_list);
?>
