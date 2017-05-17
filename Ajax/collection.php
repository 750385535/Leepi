<?php
include_once("sql_connect.php");

$sql = new SQL_CONNECT();//实例化连接类
$sql->connection();//连接到数据库
$sql->set_laugue();//设置编码
$sql->choice();//选择数据库

error_reporting(E_ALL^E_NOTICE^E_WARNING);//关闭所有notice 和 warning 级别的错误
?>
<?php
$detailID = intval($_GET['detailID']);
$author_id = $_GET['author_id'];



$query = mysql_query("select * from member WHERE id='$author_id' limit 1");
while ($row = mysql_fetch_array($query)) {
    $all_collection = $row['collection'];
}



$domain = strstr($all_collection, "&$detailID");
if($domain){
    $arr['status']=true;
    mysql_query("update member set collection=replace(collection,'&$detailID','') WHERE `member`.`id` = '$author_id' limit 1");
    mysql_query("UPDATE `example`.`panorama` SET `collection` = `collection`-1 WHERE `panorama`.`id` = $detailID");
}else {
    $arr['status']=false;
    mysql_query("update member set collection=CONCAT(collection,'&$detailID') WHERE `member`.`id` = '$author_id' limit 1");
    mysql_query("UPDATE `example`.`panorama` SET `collection` = `collection`+1 WHERE `panorama`.`id` = $detailID");
}


$query2 = mysql_query("select collection from panorama where id=$detailID limit 1");

while ($row = mysql_fetch_array($query2)) {
    $arr['collection']=$row['collection'];
}



//print_r($arr);
echo json_encode($arr);