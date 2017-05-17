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
$author_id = $_GET['author_id'];
$by = $_GET['by'];

$result = mysql_query("select id from panorama");
$total = mysql_num_rows($result);//总记录数

$pageSize = 5; //每次页显示文章数
$totalPage = ceil($total / $pageSize); //总页数

$startPage = $pageNum * $pageSize;
$arr['total'] = $total;
$arr['pageSize'] = $pageSize;
$arr['totalPage'] = $totalPage;

if($by=='byTime') {
    $query1 = mysql_query("select * from panorama WHERE author_id='$author_id' order by id desc limit $startPage,$pageSize");
    while ($row = mysql_fetch_array($query1)) {
        $arr['list'][] = array(
            'id' => $row['id'],
            'img' => $row['img'],
            'title' => $row['title'],
            'author' => $row['author'],
            'author_id' => $row['author_id'],
            'classify' => $row['classify'],
            'timeInfo' => $row['timeInfo'],
            'iconClass' => $row['iconClass'],
            'detailsCon' => $row['detailsCon']
        );
    }
}elseif ($by=="byHot") {
    $query1 = mysql_query("select * from panorama WHERE author_id='$author_id' order by visitNum desc limit $startPage,$pageSize");
    while ($row = mysql_fetch_array($query1)) {
        $arr['list'][] = array(
            'id' => $row['id'],
            'img' => $row['img'],
            'title' => $row['title'],
            'author' => $row['author'],
            'author_id' => $row['author_id'],
            'classify' => $row['classify'],
            'timeInfo' => $row['timeInfo'],
            'iconClass' => $row['iconClass'],
            'detailsCon' => $row['detailsCon']
        );
    }
}

$query2 = mysql_query("select * from member WHERE id='$author_id'");
while ($row = mysql_fetch_array($query2)) {
    $arr['author'][] = array(
        'serial' => $row['serial'],
        'id' => $row['id'],
        'nickname' => $row['nickname'],
        'passwd' => $row['passwd'],
        'status' => $row['status'],
        'resume' => $row['resume'],
        'rank' => $row['rank'],
        'img' => $row['img']
    );
}

$query3 = mysql_query("select COUNT(*) AS count from panorama WHERE author_id='$author_id'");
if($row=mysql_fetch_array($query3)){
    $arr['count']=$row[0];
}else{
    $arr['count']=0;
}

//print_r($arr);
echo json_encode($arr);

?>