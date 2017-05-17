<?php
include_once("sql_connect.php");

$sql = new SQL_CONNECT();//实例化连接类
$sql->connection();//连接到数据库
$sql->set_laugue();//设置编码
$sql->choice();//选择数据库

error_reporting(E_ALL^E_NOTICE^E_WARNING);//关闭所有notice 和 warning 级别的错误
?>
<?php
$classifyID = intval($_GET['classifyID']);
$author_id = $_GET['author_id'];



$query = mysql_query("select * from member WHERE id='$author_id' limit 1");
while ($row = mysql_fetch_array($query)) {
    $all_following_name = $row['following_name'];
}


$domain = strstr($all_following_name, "&".$classifyID);
if($domain){
    $arr['status']=true;
    mysql_query("update member set following_name=replace(following_name,'&$classifyID','') WHERE `member`.`id` = '$author_id' limit 1");
}else {
    $arr['status']=false;
    mysql_query("update member set following_name=CONCAT(following_name,'&$classifyID') WHERE `member`.`id` = '$author_id' limit 1");
}


//print_r($domain);
echo json_encode($arr);