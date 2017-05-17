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



$result = mysql_query("select author_id from panorama WHERE classify='$classifyID' group by author_id");
$total = mysql_num_rows($result);//总记录数

$pageSize = 3; //每次页显示文章数
$totalPage = ceil($total / $pageSize); //总页数

$startPage = $pageNum * $pageSize;
$arr['total'] = $total;
$arr['pageSize'] = $pageSize;
$arr['totalPage'] = $totalPage;


$query = mysql_query("select author_id from panorama WHERE classify='$classifyID' group by author_id limit $startPage,$pageSize");
while ($row = mysql_fetch_array($query)) {
    $all_Authors[] = $row['author_id'];
}

$ar=array();
for($i = 0;$i<count($all_Authors);$i++){
    $author_id=$all_Authors[$i];

    if($author_id!=""){
        $query3 = mysql_query("select * from panorama WHERE classify='$classifyID' and author_id='$author_id' order by id desc");//$all_Authors[$i]
        
        while ($row = mysql_fetch_array($query3)) {
            $ar['asd'] = array(
                'id' => $row['id'],
                'classify' => $row['classify'],
                'title' => $row['title'],
                'img' => $row['img'],
                'timeInfo' => $row['timeInfo']
            );
//        print_r($ar3['asd']);
            $arr['authorsClassify'][$author_id][]=$ar['asd'];
        }
//    echo "<br>第.$i.条<br>";
        $arr['allAuthors_id'][]=$author_id;
    }
}

for($i = 0;$i<=count($arr['allAuthors_id']);$i++){
    $authorId = $arr['allAuthors_id'][$i];
    $query2 = mysql_query("select * from member WHERE id='$authorId'");
    
    while ($row = mysql_fetch_array($query2)) {
        $arr['author'][] = array(
            'id' => $row['id'],
            'nickname' => $row['nickname'],
            'resume' => $row['resume'],
            'img' => $row['img']
        );
    }
}



//print_r($arr);
echo json_encode($arr);

?>