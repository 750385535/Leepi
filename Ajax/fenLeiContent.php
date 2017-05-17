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
        $classifyID = "综艺";
        break;
    case 18:
        $classifyID = "科技";
        break;
}

$query1 = mysql_query("select * from classify WHERE class_name='$classifyID'");

while ($row = mysql_fetch_array($query1)) {
    $arr['head'][] = array(
        'id' => $row['id'],
        'img' => $row['img'],
        'class_name' => $row['class_name'],
        'class_info' => $row['class_info']
    );
}

$newSize = 5;
$query2 = mysql_query("select * from panorama WHERE classify='$classifyID' order by id desc limit $newSize");

while ($row = mysql_fetch_array($query2)) {
    $arr['newp'][] = array(
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

$hotSize = 5;
$query3 = mysql_query("select * from panorama WHERE classify='$classifyID' order by visitNum desc limit $hotSize");

while ($row = mysql_fetch_array($query3)) {
    $arr['hotp'][] = array(
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

$popSize = 5;
$query4 = mysql_query("select * from panorama WHERE classify='$classifyID' order by visitNum desc limit $popSize");

while ($row = mysql_fetch_array($query4)) {
    $arr['popp'][] = array(
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

$author_id = $_COOKIE['cookie_id'];
$classifyID = intval($_GET['classifyID']);

if($author_id){
    $query5 = mysql_query("select * from member WHERE id='$author_id' limit 1");
    while ($row = mysql_fetch_array($query5)) {
        $all_following_name = $row['following_name'];
    }

    $domain = strstr($all_following_name, "&$classifyID");
    if($domain){
        $arr['status']=true;
    }else {
        $arr['status']=false;
    }
}



//print_r($arr);
echo json_encode($arr);

?>