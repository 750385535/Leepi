<?php
include_once("sql_connect.php");

$id = $_GET['id'];
$passwd = $_GET['passwd'];
$repasswd = $_GET['repasswd'];

//检查数据
if ($id == '' or $passwd == '' or $repasswd == '') {
    echo json_encode("null");//字段不能为空
} else {
    if ($passwd == $repasswd) {
        $sql = new SQL_CONNECT();//实例化连接类
        $sql->connection();//连接到数据库
        $sql->set_laugue();//设置编码
        $sql->choice();//选择数据库


        $sql1 = "select id from member where id='" . $id . "' and status = 1";
        $query1 = mysql_query($sql1);

        $sqlstr = "INSERT INTO `member`(`serial`, `id`, `passwd`, `nickname`,  `status`, `rank`, `resume`, `img`) VALUES ('','" . $id . "','" . $repasswd . "','',1,1,'','')";

        //判断该用户是否存在
        if (mysql_num_rows($query1) > 0) {
            echo json_encode("104");//用户名已被使用
        } else {
            $result = mysql_query($sqlstr, $sql->con);
            
            //判断完该用户名是否被使用过后,开始添加用户
            if ($result) {
                echo json_encode("100");//注册成功
            } else {
                echo json_encode("404");//注册失败
            }
        }


    } else {
        echo json_encode("p!p");//密码不一致
    }
}