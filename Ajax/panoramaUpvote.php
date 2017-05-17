<?php
include_once("sql_connect.php");

$sql = new SQL_CONNECT();//实例化连接类
$sql->connection();//连接到数据库
$sql->set_laugue();//设置编码
$sql->choice();//选择数据库

error_reporting(E_ALL^E_NOTICE^E_WARNING);//关闭所有notice 和 warning 级别的错误
?>
<?php
$id = intval($_GET['id']);


if($id){
    mysql_query("UPDATE `example`.`panorama` SET `upvote` = `upvote`+1 WHERE `panorama`.`id` = $id");
}

$query = mysql_query("select upvote from panorama where id=$id");

while ($row = mysql_fetch_array($query)) {
    $arr['upvote']=$row['upvote'];
}


echo json_encode($arr);