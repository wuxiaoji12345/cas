<?php
header("Content-Type: text/html; charset=utf-8");
//open session
session_start(); 
//引入文件
require_once dirname(__FILE__)."/CAS/CAS.php";  
//指定log文件
phpCAS::setDebug('./log.log');

//指定cas地址，最后一个true表示是否cas服务器为https，第二个参数为域名或是ip，第三个参数为服务器端口号，第四个参数为上下文路径
phpCAS::client(CAS_VERSION_2_0,'uis.fudan.edu.cn',80,'',false);

//设置no ssl，即忽略证书检查.如果需要ssl，请用 phpCAS::setCasServerCACert()设置
//setCasServerCACert方法设置ssl证书，
phpCAS::setNoCasServerValidation();
phpCAS::handleLogoutRequests();
phpCAS::forceAuthentication();

//本地退出应该重定向到CAS进行退出，传递service参数可以使CAS退出后返回本应用
//demo表示退出请求为logout的请求
if(isset($_GET['logout'])){
	$param = array('service'=>'http://ssodemo.test.com/cas/index.php');
	phpCAS::logout($param);
	exit;
}


///phpCAS::getAttributes() 可以返回所有所有授权的属性
echo "<pre>";
echo "user:".phpCAS::getUser();
echo "<br/>";
echo "*******************";
echo "<br/>";
echo "attributes:";
echo "<br/>";
var_dump(phpCAS::getAttributes());


?>

<HTML>
<HEAD><title>CAS PHP Example application</title></HEAD>
<BODY>
<a href="?logout=">logout</a>
</BODY>
</HTML>
