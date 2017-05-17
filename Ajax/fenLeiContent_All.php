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
$classifyID = intval($_GET['classifyID']);

switch ($classifyID){
    case 1:
        $classifyID = "全景";
        break;
    case 2:
        $classifyID = "科普";
        break;
    case 3:
        $classifyID = "创意";
        break;
    case 4:
        $classifyID = "开胃";
        break;
    case 5:
        $classifyID = "音乐";
        break;
    case 6:
        $classifyID = "运动";
        break;
    case 7:
        $classifyID = "旅游";
        break;
    case 8:
        $classifyID = "记录";
        break;
    case 9:
        $classifyID = "时尚";
        break;
    case 10:
        $classifyID = "游戏";
        break;
    case 11:
        $classifyID = "萌宠";
        break;
    case 12:
        $classifyID = "动画";
        break;
    case 13:
        $classifyID = "设计";
        break;
    case 14:
        $classifyID = "生活";
        break;
    case 15:
        $classifyID = "搞笑";
        break;
    case 16:
        $classifyID = "预告";
        break;
    case 17:
        $classifyID = "科技";
        break;
}


$result = mysql_query("select id from panorama WHERE classify='$classifyID'");
$total = mysql_num_rows($result);//总记录数

$pageSize = 5; //每次页显示文章数
$totalPage = ceil($total / $pageSize); //总页数

$startPage = $pageNum * $pageSize;
$arr['total'] = $total;
$arr['pageSize'] = $pageSize;
$arr['totalPage'] = $totalPage;


$query = mysql_query("select * from panorama WHERE classify='$classifyID' order by id desc limit $startPage,$pageSize");
while ($row = mysql_fetch_array($query)) {
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



//print_r($arr);
echo json_encode($arr);

?>