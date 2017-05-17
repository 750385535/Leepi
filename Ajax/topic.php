<?php
include_once("sql_connect.php");

$sql = new SQL_CONNECT();//实例化连接类
$sql->connection();//连接到数据库
$sql->set_laugue();//设置编码
$sql->choice();//选择数据库
?>
<?php
$pageNum = intval($_GET['pageNum']);
//$page = 0;

$result = mysql_query("select id from panorama");
$total = mysql_num_rows($result);//总记录数

$pageSize = 10; //每次页显示文章数
$totalPage = ceil($total / $pageSize); //总页数

$startPage = $pageNum * $pageSize;
$arr['total'] = $total;
$arr['pageSize'] = $pageSize;
$arr['totalPage'] = $totalPage;

$query1 = mysql_query("select * from topic order by timeInfo desc,visitNum desc,id desc limit $startPage,$pageSize");
//按日期最新排序,日期相同时按访问量排序,访问量相同时按id排序

while ($row = mysql_fetch_array($query1)) {
    $topicId = $row['id'];
    $arr['list'][] = array(
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

//print_r($arr);
echo json_encode($arr);

?>