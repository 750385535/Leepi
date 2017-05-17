<?php
include_once("sql_connect.php");

$sql = new SQL_CONNECT();//实例化连接类
$sql->connection();//连接到数据库
$sql->set_laugue();//设置编码
$sql->choice();//选择数据库

error_reporting(E_ALL^E_NOTICE^E_WARNING);//关闭所有notice 和 warning 级别的错误
?>
<?php
$author_id = $_GET['author_id'];



$query = mysql_query("select collection from member WHERE id='$author_id' limit 1");

while ($row = mysql_fetch_array($query)) {
    $all_collection = explode('&', $row['collection']);
}



for($i = 0;$i<count($all_collection);$i++){
    $collection=$all_collection[$i];

    if($collection!=""){
        $query1 = mysql_query("select * from panorama WHERE id='$collection'");
        while ($row = mysql_fetch_array($query1)) {
            $arr['collection'][] = array(
                'id' => $row['id'],
                'img' => $row['img'],
                'title' => $row['title'],
                'author' => $row['author'],
                'classify' => $row['classify'],
                'timeInfo' => $row['timeInfo'],
                'iconClass' => $row['iconClass'],
                'detailsCon' => $row['detailsCon']
            );
        }
    }
}



//print_r($arr);
echo json_encode($arr);