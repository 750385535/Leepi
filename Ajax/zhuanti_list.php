<?php
include_once("sql_connect.php");

$sql = new SQL_CONNECT();//实例化连接类
$sql->connection();//连接到数据库
$sql->set_laugue();//设置编码
$sql->choice();//选择数据库
?>
<?php
$topic_Id = intval($_GET['topic_Id']);

$query1 = mysql_query("select * from topic WHERE id=$topic_Id");

while ($row = mysql_fetch_array($query1)) {
    $arr['topic'][] = array(
        'topicsCon' => $row['topicsCon'],
        'img' => $row['img'],
        'title' => $row['title']
    );
}

$query2 = mysql_query("select * from panorama WHERE topicCon_id=$topic_Id order by id asc");

while ($row = mysql_fetch_array($query2)) {
    $arr['list'][] = array(
        'id' => $row['id'],
        'topicCon_id' => $row['topicCon_id'],
        'iconClass' => $row['iconClass'],
        'title' => $row['title'],
        'img' => $row['img'],
        'classify' => $row['classify'],
        'detailsCon' => $row['detailsCon'],
        'timeInfo' => $row['timeInfo'],
        'visitNum' => $row['visitNum'],
        'linkVideo_mp4' => $row['linkVideo_mp4'],
        'linkVideo_ogv' => $row['linkVideo_ogv'],
        'linkVideo_webm' => $row['linkVideo_webm'],
        'linkTrack_en' => $row['linkTrack_en'],
        'linkTrack_cn' => $row['linkTrack_cn']
    );
}

//print_r($arr);
echo json_encode($arr);

?>