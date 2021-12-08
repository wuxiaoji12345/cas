<?php
header("Content-Type: text/html; charset=utf-8");
//open session
session_start(); 
//�����ļ�
require_once dirname(__FILE__)."/CAS/CAS.php";  
//ָ��log�ļ�
phpCAS::setDebug('./log.log');

//ָ��cas��ַ�����һ��true��ʾ�Ƿ�cas������Ϊhttps���ڶ�������Ϊ��������ip������������Ϊ�������˿ںţ����ĸ�����Ϊ������·��
phpCAS::client(CAS_VERSION_2_0,'uis.fudan.edu.cn',80,'',false);

//����no ssl��������֤����.�����Ҫssl������ phpCAS::setCasServerCACert()����
//setCasServerCACert��������ssl֤�飬
phpCAS::setNoCasServerValidation();
phpCAS::handleLogoutRequests();
phpCAS::forceAuthentication();

//�����˳�Ӧ���ض���CAS�����˳�������service��������ʹCAS�˳��󷵻ر�Ӧ��
//demo��ʾ�˳�����Ϊlogout������
if(isset($_GET['logout'])){
	$param = array('service'=>'http://ssodemo.test.com/cas/index.php');
	phpCAS::logout($param);
	exit;
}


///phpCAS::getAttributes() ���Է�������������Ȩ������
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
