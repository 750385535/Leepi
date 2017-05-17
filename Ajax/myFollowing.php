<?php
include_once("sql_connect.php");

$sql = new SQL_CONNECT();//实例化连接类
$sql->connection();//连接到数据库
$sql->set_laugue();//设置编码
$sql->choice();//选择数据库

error_reporting(E_ALL^E_NOTICE^E_WARNING);//关闭所有notice 和 warning 级别的错误
?>
<?php
$author_id = $_GET['author_id'];



$query = mysql_query("select following_author from member WHERE id='$author_id' limit 1");

while ($row = mysql_fetch_array($query)) {
    $all_following_author = explode('&', $row['following_author']);
}



for($i = 0;$i<count($all_following_author);$i++){
    $author=$all_following_author[$i];

    if($author!=""){
        $query1 = mysql_query("select * from member WHERE id='$author'");
        while ($row = mysql_fetch_array($query1)) {
            $arr['author'][] = array(
                'id' => $row['id'],
                'nickname' => $row['nickname'],
                'status' => $row['status'],
                'resume' => $row['resume'],
                'rank' => $row['rank'],
                'img' => $row['img']
            );
        }
    }
}



$query2 = mysql_query("select following_name from member WHERE id='$author_id' limit 1");

while ($row = mysql_fetch_array($query2)) {
    $all_following_classify = explode('&', $row['following_name']);
}



for($i = 0;$i<count($all_following_classify);$i++){
    $classify=$all_following_classify[$i];

    if($classify!=""){
        $query3 = mysql_query("select * from classify WHERE id='$classify'");
        while ($row = mysql_fetch_array($query3)) {
            $arr['classify'][] = array(
                'id' => $row['id'],
                'img' => $row['img'],
                'class_name' => $row['class_name'],
                'class_info' => $row['class_info']
            );
        }
    }
}



//print_r($arr);
echo json_encode($arr);