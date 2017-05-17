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



$query = mysql_query("select * from map where id=$id order by id desc");

while ($row = mysql_fetch_array($query)) {
    $arr['list'][] = array(
        'id' => $row['id'],
        'img' => $row['img'],
        'title' => $row['title'],
        'coordinate' => $row['coordinate'],
        'author' => $row['author'],
        'timeInfo' => $row['timeInfo'],
        'detailsCon' => $row['detailsCon'],
        'hotSpot' => $row['hotSpot'],
    );
    $pannellumId = $row['id'];
}



$query1 = mysql_query("select * from Pannellum where map_id=$pannellumId order by id desc");

while ($row = mysql_fetch_array($query1)) {
    $arr['pannellum'][] = array(
        'id' => $row['id'],
        'map_id' => $row['map_id'],
        'sceneId' => $row['sceneId'],
        'hfov' => $row['hfov'],
        'pitch' => $row['pitch'],
        'yaw' => $row['yaw'],
        'type' => $row['type'],
        'panorama' => $row['panorama'],
    );
    $hotSpotId = $row['id'];
    $sceneId = $row['sceneId'];


    $query2 = mysql_query("select * from hotSpots where panellum_id=$hotSpotId order by id desc");

    while ($row = mysql_fetch_array($query2)) {
        $arr['hotSpots'][$sceneId][] = array(
            'id' => $row['id'],
            'panellum_id' => $row['panellum_id'],
            'img' => $row['img'],
            'pitch' => $row['pitch'],
            'yaw' => $row['yaw'],
            'type' => $row['type'],
            'text' => $row['text'],
            'sceneId' => $row['sceneId'],
            'cssClass' => $row['cssClass'],
            'createTooltipFunc' => $row['createTooltipFunc'],
            'createTooltipArgs' => $row['createTooltipArgs'],
            'class' => $row['class'],
        );
    }

}




//print_r($arr);
echo json_encode($arr);