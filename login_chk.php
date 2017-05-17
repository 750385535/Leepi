<?php
include_once("sql_connect.php");

$id = $_GET['id'];
$passwd = $_GET['passwd'];

//检查数据
if ($id == '' or $passwd == '') {
    echo json_encode("null");//字段不能为空
} else {
    $sql = new SQL_CONNECT();//实例化连接类
    $sql->connection();//连接到数据库
    $sql->set_laugue();//设置编码
    $sql->choice();//选择数据库


    $sql1 = "select id from member where id='" . $id . "' and status = 1";
    $query1 = mysql_query($sql1);

    $sqlstr = "select * from member where id = '" . $id . "' and passwd = '" . $passwd . "' and status = 1";
    $result = mysql_query($sqlstr, $sql->con);

    //判断该用户是否存在
    if (mysql_num_rows($query1) > 0) {

        //判断完该用户是否存在后,判断密码是否正确
        if (mysql_num_rows($result) > 0) {

            $row = mysql_fetch_array($result, MYSQL_BOTH);
            if (mysql_num_rows($result) == 1 && $row["rank"] == 100) {
                setcookie("cookie_chk", "adm_logined",time()+3600);
                setcookie("cookie_id", $id,time()+3600);
                setcookie("cookie_nickname", $row["nickname"],time()+3600);

                setcookie("cookie_img", $row["img"],time()+3600);
                setcookie("cookie_followers", $row["followers"],time()+3600);
                setcookie("cookie_following", $row["following"],time()+3600);
                setcookie("cookie_personalNote", $row["personalNote"],time()+3600);

                echo json_encode("100");//管理员登录成功
            } elseif (mysql_num_rows($result) == 1 && $row["rank"] == 1) {
                setcookie("cookie_chk", "logined",time()+3600);
                setcookie("cookie_id", $id,time()+3600);
                setcookie("cookie_nickname", $row["nickname"],time()+3600);

                setcookie("cookie_img", $row["img"],time()+3600);
                setcookie("cookie_followers", $row["followers"],time()+3600);
                setcookie("cookie_following", $row["following"],time()+3600);
                setcookie("cookie_personalNote", $row["personalNote"],time()+3600);
                
                echo json_encode("101");//会员登录成功
            } else {
                echo json_encode("404");//登录失败,请重新登录
            }

        } else {
            echo json_encode("204");//请输入正确的密码
        }

    } else {
        echo json_encode("104");//用户不存在
    }


}