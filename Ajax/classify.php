<?php
include_once("sql_connect.php");

$sql = new SQL_CONNECT();//实例化连接类
$sql->connection();//连接到数据库
$sql->set_laugue();//设置编码
$sql->choice();//选择数据库
?>
<?php
$query = mysql_query("select * from classify WHERE class_name!='全景' order by id ASC ");

while ($row = mysql_fetch_array($query)) {
    $arr['list'][] = array(
        'id' => $row['id'],
        'img' => $row['img'],
        'class_name' => $row['class_name'],
        'class_info' => $row['class_info']
    );
}

$query1 = mysql_query("select * from classify WHERE class_name='全景' order by id ASC ");

while ($row = mysql_fetch_array($query1)) {
    $arr['panorama'][] = array(
        'id' => $row['id'],
        'img' => $row['img'],
        'class_name' => $row['class_name'],
        'class_info' => $row['class_info']
    );
}
//print_r($arr);
echo json_encode($arr);

?>