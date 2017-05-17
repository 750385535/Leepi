<?php
/* Connecting, selecting database */
//$link = mysql_connect('localhost','root','A1907707873a') or die("Could not connect : " . mysql_error());
//mysql_select_db("example") or die("Could not select database");


class SQL_CONNECT
{
    public $con;
    public $host = "121.42.169.154:3306";//121.42.169.154
    public $username = "root";
    public $password = "root";//A1907707873a
    public $database_name = "example";

    //连接数据库
    public function connection()
    {
        $this->con = mysql_connect($this->host, $this->username, $this->password) or die("Could not connect : " . mysql_error());
    }

    //断开与数据库的连接
    public function disconnect()
    {
        mysql_close($this->con);
    }

    //设置编码方式
    public function set_laugue()
    {
        if ($this->con) {
            mysql_query("SET NAMES UTF8");
        }
    }

    //选择数据库
    public function choice()
    {
        if ($this->con) {
            mysql_select_db($this->database_name, $this->con) or die("Could not select database");
        }
    }
}
?>