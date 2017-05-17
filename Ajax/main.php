<?php
include_once("sql_connect.php");

$sql = new SQL_CONNECT();//实例化连接类
$sql->connection();//连接到数据库
$sql->set_laugue();//设置编码
$sql->choice();//选择数据库

error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);//关闭所有notice 和 warning 级别的错误
?>
<?php
$query1 = mysql_query("select * from homepage_gallery order by id desc limit 4");

while ($row = mysql_fetch_array($query1)) {
    $arr['gallery'][] = array(
        'id' => $row['id'],
        'img' => $row['img'],
        'bg_color' => $row['bg_color'],
        'link' => $row['link'],
        'title' => $row['title']
    );
}

/**
 * 注意两数组中英文位置必须一一对应
 */
$arrs_cn = array('科普', '科技', '全景', '创意', '开胃', '音乐', '记录', '运动', '时尚', '游戏', '萌宠', '动画', '设计', '搞笑', '生活', '旅行');
$arrs_en = array('POS', 'technology', 'panorama', 'creative', 'appetizer', 'music', 'record', 'sport', 'fashion', 'game', 'pet', 'cartoon', 'design', 'funny', 'living', 'travel');

$newSize = 5;

for ($i = 0; $i < sizeof($arrs_cn); $i++) {

    $query = mysql_query("select * from panorama WHERE classify='$arrs_cn[$i]' order by timeInfo desc,visitNum desc,id desc limit $newSize");

    while ($row = mysql_fetch_array($query)) {
        $arr['classifyHot'][$arrs_cn[$i]][] = array(
            'id' => $row['id'],
            'img' => $row['img'],
            'title' => $row['title'],
            'author' => $row['author'],
            'classify' => $row['classify'],
            'visitNum' => $row['visitNum'],
            'timeInfo' => $row['timeInfo'],
            'iconClass' => $row['iconClass'],
            'detailsCon' => $row['detailsCon']
        );
    }
}

$query2 = mysql_query("select * from topic order by visitNum desc,timeInfo desc,id desc limit 5");

while ($row = mysql_fetch_array($query2)) {
    $arr['hotTopic'][] = array(
        'id' => $row['id'],
        'img' => $row['img'],
        'title' => $row['title'],
        'author' => $row['author'],
        'visitNum' => $row['visitNum'],
        'timeInfo' => $row['timeInfo'],
        'topicsCon' => $row['topicsCon'],
        'detailsNum' => $row['detailsNum']
    );
}

$query3 = mysql_query("select * from classify order by id ASC limit 5");

while ($row = mysql_fetch_array($query3)) {
    $arr['hotClassify'][] = array(
        'id' => $row['id'],
        'img' => $row['img'],
        'class_name' => $row['class_name'],
        'class_info' => $row['class_info']
    );
}

$query4 = mysql_query("select * from member order by rank desc,followers desc,serial desc limit 5");

while ($row = mysql_fetch_array($query4)) {
    $arr['hotAuthor'][] = array(
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

//print_r($arr);
echo json_encode($arr);