<?php
include_once("sql_connect.php");

$sql = new SQL_CONNECT();//实例化连接类
$sql->connection();//连接到数据库
$sql->set_laugue();//设置编码
$sql->choice();//选择数据库

error_reporting(E_ALL^E_NOTICE^E_WARNING);//关闭所有notice 和 warning 级别的错误
?>
<?php
$detailID = intval($_GET['detailID']);



$query = mysql_query("select * from panorama WHERE id=$detailID limit 1");

while ($row = mysql_fetch_array($query)) {
    $arr['list'][] = array(
        'id' => $row['id'],
        'classify' => $row['classify'],
        'topicCon_id' => $row['topicCon_id'],
        'author_id' => $row['author_id'],
        'author' => $row['author'],
        'title' => $row['title'],
        'img' => $row['img'],
        'linkVideo_ogv' => $row['linkVideo_ogv'],
        'linkVideo_mp4' => $row['linkVideo_mp4'],
        'linkVideo_webm' => $row['linkVideo_webm'],
        'linkTrack_en' => $row['linkTrack_en'],
        'linkTrack_cn' => $row['linkTrack_cn'],
        'detailsCon' => $row['detailsCon'],
        'timeInfo' => $row['timeInfo'],
        'visitNum' => $row['visitNum'],
        'iconClass' => $row['iconClass'],
        'tags' => $row['tags'],
        'collection' => $row['collection']
    );

    $all_tags = explode('&', $row['tags']);
}



$ar=array();
for($i = 0;$i<count($all_tags);$i++){
    $tag=$all_tags[$i];
    
    if($tag!=""){
        $query3 = mysql_query("select * from panorama WHERE tags LIKE '%$tag%' and id!='$detailID' order by visitNum desc,timeInfo desc,id desc limit 5");//$all_tags[$i]
        while ($row = mysql_fetch_array($query3)) {
            $ar['asd'] = array(
                'id' => $row['id'],
                'classify' => $row['classify'],
                'title' => $row['title'],
                'img' => $row['img'],
                'timeInfo' => $row['timeInfo']
            );
//        print_r($ar3['asd']);
            $arr['tags_about'][$tag][]=$ar['asd'];
        }
//    echo "<br>第.$i.条<br>";
        $arr['tags_about_name'][]=$tag;
    }
}



$query1 = mysql_query("select * from comment WHERE panorama_id=$detailID order by upvote desc,time desc,id desc");

while ($row = mysql_fetch_array($query1)) {
    $arr['comment'][] = array(
        'id' => $row['id'],
        'panorama_id' => $row['panorama_id'],
        'author_id' => $row['author_id'],
        'text' => $row['text'],
        'upvote' => $row['upvote'],
        'time' => $row['time']
    );

    $authorId[] = $row['author_id'];
}

$arr['commentNum'] = mysql_num_rows($query1);



for($i = 0;$i<count($authorId);$i++){

    $query2 = mysql_query("select * from member WHERE id='$authorId[$i]'");

    while ($row = mysql_fetch_array($query2)) {
        $arr['author'][] = array(
            'id' => $row['id'],
            'nickname' => $row['nickname'],
            'img' => $row['img']
        );
    }
}



$author_id = $_COOKIE['cookie_id'];

if($author_id){
    $query5 = mysql_query("select * from member WHERE id='$author_id' limit 1");
    while ($row = mysql_fetch_array($query5)) {
        $all_collection = $row['collection'];
    }

    $domain = strstr($all_collection, "&$detailID");
    if($domain){
        $arr['status']=true;
    }else {
        $arr['status']=false;
    }
}



//print_r($arr);
echo json_encode($arr);

?>