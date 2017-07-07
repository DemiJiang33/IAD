<?php 
require_once ('config.php'); 
//Check the authority of the user
if(empty($_SESSION['member'])){
	echo "<script>alert('Plz login or register');location='index.php';</script>";
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!--member.php
    Name: Shanshan Jiang
    Course: IAD   
    HW#: HW3
    Time: 10/20/2015/
    -->
<!--The member.php helps the user to show and modity his own information.
    -->
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Membership information page</title>
<link href="style.css" rel="stylesheet" type="text/css" />
</head>
<body>
<h1>Welcome! You can modify your information here!</h1>
<?php
//logout
if($_GET["tj"]=="destroy"){
session_destroy();
echo "<script>alert('Logout successfully!');location='index.php';</script>";}
?>
<?php
//Modify the information
if($_GET["tj"]=="modify") {
if($_POST["submit"]){
	mysql_query($sql="update member set member_name='".$_POST['member_name']."',member_qq='".$_POST['member_qq']."',member_phone='".$_POST['member_phone']."',member_email='".$_POST['member_email']."' where member_user='".$_SESSION['member']."'");
	echo "<script>alert('Modify successfully!');location='member.php';</script>";
} ?>
<?php
//Show username
$sql="select * from member where member_user='".$_SESSION['member']."'";
$rs=mysql_fetch_array(mysql_query($sql));
?>
<table width="350" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#B3B3B3">
  <tr>
    <td align="center" bgcolor="#EBEBEB">Modify information&nbsp;&nbsp;<a href="member.php"> Go to the membership information page</a></td>
  </tr>
</table>
<form method="post" action="" style="margin-top:3px; margin-bottom:3px;">
<table width="350" height="212" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#B3B3B3">
  <tr>
    <td width="59" height="26" align="center" bgcolor="#FFFFFF">Username：</td>
    <td width="268" align="left" bgcolor="#FFFFFF"><? echo $rs['member_user'];?></td>
  </tr>
  <tr>
    <td height="28" align="center" bgcolor="#FFFFFF">Real name:</td>
    <td align="left" bgcolor="#FFFFFF"><input name="member_name" type="text" id="member_name" maxlength="20" value="<? echo $rs['member_name'];?>"/></td>
  </tr>
  <tr>
    <td height="26" align="center" bgcolor="#FFFFFF">Sex：</td>
    <td align="left" bgcolor="#FFFFFF"><? echo $rs['member_sex'];?></td>
  </tr>
  <tr>
    <td height="28" align="center" bgcolor="#FFFFFF">QQ：</td>
    <td align="left" bgcolor="#FFFFFF"><input name="member_qq" type="text" id="member_qq" value="<? echo $rs['member_qq'];?>" maxlength="20"/></td>
  </tr>
  <tr>
    <td height="33" align="center" bgcolor="#FFFFFF">Cellphone：</td>
    <td align="left" bgcolor="#FFFFFF"><input name="member_phone" type="text" id="member_phone" value="<? echo $rs['member_phone'];?>" maxlength="20"/></td>
  </tr>
  <tr>
    <td height="36" align="center" bgcolor="#FFFFFF">E-mail：</td>
    <td align="left" bgcolor="#FFFFFF"><input name="member_email" type="text" id="member_email" value="<? echo $rs['member_email'];?>" maxlength="30"/></td>
  </tr>
  <tr>
    <td height="27" colspan="2" align="center" bgcolor="#FFFFFF"><input type="reset" name="button" id="button" value="reset" />
      <input type="submit" name="submit" id="submit" value="submit" /></td>
    </tr>
</table>
</form>
<?php } ?>
<?php
if($_SESSION['member'])                 
{?>
<table width="350" border="0" align="center" cellpadding="5" cellspacing="1" bgcolor="#B3B3B3">
  <tr>
    <td width="327" align="center" bgcolor="#EBEBEB" class="font"><a href='?tj=destroy'>Logout</a>&nbsp;&nbsp;&nbsp;<?php echo "<a href='?tj=modify'>Modify user's information</a>";?>  <?php if($_SESSION['member']=="admin"){?>
    <a href="admin_index.php">&nbsp;&nbsp;"Manage"</a><?php }?></td>
  </tr>
</table>
<table width="100" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="3"></td>
  </tr>
</table>
<?php
$result=mysql_query("select * from member where member_user='".$_SESSION['member']."'"); 
while($rs=mysql_fetch_array($result)){
?>
<table width="350" border="0" align="center" cellpadding="5" cellspacing="1" bgcolor="#B3B3B3">
  <tr>
    <td bgcolor="#FFFFFF">Username:</td>
    <td bgcolor="#FFFFFF"><?php echo htmlspecialchars($rs['member_user']); ?></td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF">Real name:</td>
    <td bgcolor="#FFFFFF"><?php echo htmlspecialchars($rs['member_name']); ?></td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF">Sex:</td>
    <td bgcolor="#FFFFFF"><?php echo htmlspecialchars($rs['member_sex']); ?></td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF">QQ:</td>
    <td bgcolor="#FFFFFF"><?php echo htmlspecialchars($rs['member_qq']); ?></td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF">Cellphone:</td>
    <td bgcolor="#FFFFFF"><?php echo htmlspecialchars($rs['member_phone']); ?></td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF">E-mail:</td>
    <td bgcolor="#FFFFFF"><?php echo htmlspecialchars($rs['member_email']); ?></td>
  </tr>
</table>

<table width="100" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="3"></td>
  </tr>
</table>
<?php } 
}
?>
</body>
</html>