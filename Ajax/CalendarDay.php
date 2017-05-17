<?php
include_once("sql_connect.php");

$sql = new SQL_CONNECT();//实例化连接类
$sql->connection();//连接到数据库
$sql->set_laugue();//设置编码
$sql->choice();//选择数据库

error_reporting(E_ALL^E_NOTICE^E_WARNING);//关闭所有notice 和 warning 级别的错误
?>
<?php

$query = mysql_query("select timeInfo from panorama group by timeInfo");

while ($row = mysql_fetch_array($query)) {
    $timeInfo[] = array(
        'timeInfo' => $row['timeInfo']
    );
}


//print_r($timeInfo);
echo json_encode($timeInfo);