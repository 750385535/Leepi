<?php
include_once("sql_connect.php");

$sql = new SQL_CONNECT();//实例化连接类
$sql->connection();//连接到数据库
$sql->set_laugue();//设置编码
$sql->choice();//选择数据库

error_reporting(E_ALL^E_NOTICE^E_WARNING);//关闭所有notice 和 warning 级别的错误
?>
<?php
$date = $_GET['date']; //第n次查询天数(第几页)


$query1 = mysql_query("select * from panorama where date_format(timeInfo,'%Y-%m-%d')='$date' order by timeInfo desc,id desc");
//按日期最新排序,日期相同时按访问量排序,访问量相同时按id排序

while ($row = mysql_fetch_array($query1)) {
    $arr['list'][] = array(
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


$topicSize = 1; //每次页显示专题数
$query2 = mysql_query("select * from topic where timeInfo='$date' limit 1");
//按日期最新排序,日期相同时按访问量排序,访问量相同时按id排序

while ($row = mysql_fetch_array($query2)) {
    $topicId = $row['id'];
    $arr['topic'][] = array(
        'id' => $row['id'],
        'img' => $row['img'],
        'title' => $row['title'],
        'author' => $row['author'],
        'visitNum' => $row['visitNum'],
        'timeInfo' => $row['timeInfo'],
        'topicsCon' => $row['topicsCon'],
        'count' => mysql_num_rows(mysql_query("select * from panorama WHERE topicCon_id=$topicId"))
    );
}


$topicId = $arr["topic"][0]["id"];//根据专题的ID来过滤,WHERE topicCon_id=$topicId
$query3 = mysql_query("select * from panorama WHERE topicCon_id=$topicId order by timeInfo desc,visitNum desc,id desc limit 5");
//按日期最新排序,日期相同时按访问量排序,访问量相同时按id排序

while ($row = mysql_fetch_array($query3)) {
    $arr['topicLi'][] = array(
        'id' => $row['id'],
        'topicCon_id' => $row['topicCon_id'],
        'iconClass' => $row['iconClass'],
        'title' => $row['title'],
        'img' => $row['img'],
        'classify' => $row['classify'],
        'detailsCon' => $row['detailsCon'],
        'timeInfo' => $row['timeInfo'],
        'visitNum' => $row['visitNum']
    );
}


//print_r($arr);
echo json_encode($arr);