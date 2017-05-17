<?php
include_once("sql_connect.php");

$sql = new SQL_CONNECT();//实例化连接类
$sql->connection();//连接到数据库
$sql->set_laugue();//设置编码
$sql->choice();//选择数据库

error_reporting(E_ALL^E_NOTICE^E_WARNING);//关闭所有notice 和 warning 级别的错误
?>
<?php
$pageNum = intval($_GET['pageNum']);
$by = $_GET['by'];

$result = mysql_query("select id from panorama");
$total = mysql_num_rows($result);//总记录数

$pageSize = 5; //每次页显示文章数
$totalPage = ceil($total / $pageSize); //总页数

$startPage = $pageNum * $pageSize;
$arr['total'] = $total;
$arr['pageSize'] = $pageSize;
$arr['totalPage'] = $totalPage;

if($by=='byWeek') {
    $query1 = mysql_query("select * from panorama where DATE_SUB(CURDATE(), INTERVAL 7 DAY) <=date(timeInfo) order by visitNum desc,timeInfo desc,id desc limit $startPage,$pageSize");
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
}elseif ($by=='byMonth'){
    $query1 = mysql_query("select * from panorama where DATE_SUB(CURDATE(), INTERVAL 30 DAY) <=date(timeInfo) order by visitNum desc,timeInfo desc,id desc limit $startPage,$pageSize");
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
}elseif ($by=='byYear'){
    $query1 = mysql_query("select * from panorama order by visitNum desc,timeInfo desc,id desc limit $startPage,$pageSize");
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
}


//print_r($arr);
echo json_encode($arr);

?>