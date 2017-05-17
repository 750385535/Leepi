<?php
error_reporting(0);

$arr["status"]='';
$arr["cookie_id"] = $_COOKIE['cookie_id'];
$arr["cookie_nickname"] = $_COOKIE['cookie_nickname'];

$arr["cookie_img"] = $_COOKIE['cookie_img'];
$arr["cookie_followers"] = $_COOKIE['cookie_followers'];
$arr["cookie_following"] = $_COOKIE['cookie_following'];
$arr["cookie_personalNote"] = $_COOKIE['cookie_personalNote'];

if (isset($_COOKIE['cookie_chk'])) {
    if ($_COOKIE['cookie_chk'] == "adm_logined") {
        $arr["status"] = "online";
    } else {
        $arr["status"] = "offline";
    }
} else {
    $arr["status"] = "offline";
}

echo json_encode($arr);