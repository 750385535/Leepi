<?php
include_once("sql_connect.php");

$sql = new SQL_CONNECT();//实例化连接类
$sql->connection();//连接到数据库
$sql->set_laugue();//设置编码
$sql->choice();//选择数据库
?>
<?php
$query = mysql_query("select * from map order by id desc");

while ($row = mysql_fetch_array($query)) {
    $arr['list'][] = array(
        'id' => $row['id'],
        'img' => $row['img'],
        'title' => $row['title'],
        'coordinate' => $row['coordinate'],
        'author' => $row['author'],
        'timeInfo' => $row['timeInfo'],
        'detailsCon' => $row['detailsCon']
    );
}
//print_r($arr);
echo json_encode($arr);

?>