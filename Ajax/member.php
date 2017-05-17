<?php
include_once("sql_connect.php");

$sql = new SQL_CONNECT();//实例化连接类
$sql->connection();//连接到数据库
$sql->set_laugue();//设置编码
$sql->choice();//选择数据库
?>
<?php
$query = mysql_query("select * from member order by serial ASC");

while ($row = mysql_fetch_array($query)) {
    $arr['author'][] = array(
        'id' => $row['id'],
        'nickname' => $row['nickname'],
        'status' => $row['status'],
        'resume' => $row['resume'],
        'rank' => $row['rank'],
        'img' => $row['img']
    );
}

//print_r($arr);
echo json_encode($arr);

?>