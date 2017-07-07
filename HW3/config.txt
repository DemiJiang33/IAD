<?php
if (!isset ($_SESSION)) {
	ob_start();
	session_start();
}
 $hostname="localhost"; //mysql address
 $basename="user13"; //mysql username
 $basepass="CAskzSST"; //mysql password
 $database="user13db"; //mysql schema

 $conn=mysql_connect($hostname,$basename,$basepass)or die("error!"); //connect to mysql              
 mysql_select_db($database,$conn); //select the mysql schema
 mysql_query("set names 'utf8'");//mysql unicode
?>