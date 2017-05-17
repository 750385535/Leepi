<?php
include_once("sql_connect.php");

$sql = new SQL_CONNECT();//实例化连接类
$sql->connection();//连接到数据库
$sql->set_laugue();//设置编码
$sql->choice();//选择数据库

error_reporting(E_ALL^E_NOTICE^E_WARNING);//关闭所有notice 和 warning 级别的错误
?>
<?php

$query = mysql_query("select class_name from classify");

while ($row = mysql_fetch_array($query)) {
    $class_name = $row['class_name'];

    $query1 = mysql_query("select * from panorama WHERE classify='$class_name'");
    while ($row = mysql_fetch_array($query1)) {
        
        $authorId = $row['author_id'];
        $query2 = mysql_query("select * from member WHERE id='$authorId'");
        while ($row2 = mysql_fetch_array($query2)) {
            $authors = array(
                'id' => $row2['id'],
                'nickname' => $row2['nickname'],
                'img' => $row2['img']
            );
        }

        $author_id = $_COOKIE['cookie_id'];
        if($author_id){
            $query5 = mysql_query("select collection from member WHERE id='$author_id' limit 1");
            while ($row3 = mysql_fetch_array($query5)) {
                $all_collection = $row3['collection'];
            }
            $domain = strstr($all_collection, "&".$row['id']);
            if($domain){
                $arr['status']="100";
            }else {
                $arr['status']="101";
            }
        }

        $arr['list'][$class_name][] = array(
            'id' => $row['id'],
            'img' => $row['img'],
            'title' => $row['title'],
            'author' => $row['author'],
            'classify' => $row['classify'],
            'timeInfo' => $row['timeInfo'],
            'iconClass' => $row['iconClass'],
            'detailsCon' => $row['detailsCon'],
            'status' => $arr['status'],
            'authors' => array(
                'id' => $authors['id'],
                'nickname' => $authors['nickname'],
                'img' => $authors['img']
            )
        );

    }

}



//print_r($arr);
echo json_encode($arr);




//zeroants@vip.qq.com
//keychain
//XxW@7892