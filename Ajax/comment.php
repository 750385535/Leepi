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
$author_id = $_GET['author_id'];
$commentCon = $_GET['commentCon'];



if($detailID){
    if($author_id){
        if($commentCon){
            $query = mysql_query("INSERT INTO `example`.`comment` (`id`, `panorama_id`, `author_id`, `text`, `time`, `upvote`) VALUES (NULL, $detailID, '$author_id', '$commentCon', CURRENT_TIMESTAMP, '0')");
            if($query){
//                echo json_encode($detailID.",".$author_id.",".$commentCon);
            }
        }
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



echo json_encode($arr);
