<?php
require_once ('config.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!--index.php
    Name: Shanshan Jiang
    Course: IAD   
    HW#: HW3
    Time: 10/20/2015/
    -->
<!--the index.php help the member to login or register.
    If registration is successful,
    the member can go to member.php to modify his own information.
    The admin's username is "admin" and password is "1234".
    If the member is "admin", then the admin can not only modify his own information
    but also manage other members' information.
    -->
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Member Registration</title>
<link href="style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
function chk(theForm){
	if (theForm.member_user.value.replace(/(^\s*)|(\s*$)/g, "") == "" || theForm.member_user.value.replace(/([0-9a-zA-Z]+)([@])([0-9a-zA-Z]+)(.)([0-9a-zA-Z]+)/g, "")){
		alert("Username cannot be null and must be a valid e-mail address!");
		theForm.member_user.focus();   
		return (false);   
	}		
	
	if (theForm.member_password.value.replace(/(^\s*)|(\s*$)/g, "") == ""){
		alert("Password cannot be null!");
		theForm.member_password.focus();   
		return (false);   
	}	
	
	if (theForm.member_password.value != theForm.pass.value){
		alert("Wrong Password!");
		theForm.pass.focus();   
		return (false);   
	}	
		 
	if (theForm.member_name.value.replace(/(^\s*)|(\s*$)/g, "") == "" || theForm.member_name.value.replace(/[A-Z][a-z]*/g, "")){
		alert("Real name cannot be null and the first letter should be a capital one.");   
		theForm.member_name.focus();   
		return (false);   
	}
}
</script>
<?php
if($_POST["submit"]){
if(empty($_POST['member_user']))
	echo "<script>alert('Username cannot be null!');location='?tj=register';</script>";
else if(empty($_POST['member_password']))
	echo "<script>alert('Password cannot be null!');location='?tj=register';</script>";
else if($_POST['member_password']!=$_POST['pass'])
	echo "<script>alert('Wrong Password!');location='?tj=register';</script>";
else if(!empty($_POST['member_qq'])&&!is_numeric($_POST['member_qq']))
	echo "<script>alert('qq must be numbers');location='?tj=register';</script>";
else if(!empty($_POST['member_phone'])&&!is_numeric($_POST['member_phone']))
	echo "<script>alert('cellphone must be numbers');location='?tj=register';</script>";
else if(!empty($_POST['member_email'])&&!ereg("([0-9a-zA-Z]+)([@])([0-9a-zA-Z]+)(.)([0-9a-zA-Z]+)",$_POST['member_email']))
	echo "<script>alert('e-mail address is illegal');location='?tj=register';</script>";
else{
$_SESSION['member']=$_POST['member_user'];
$sql="insert into member values('','".$_POST['member_user']."','".md5($_POST['member_password'])."','".$_POST['member_name']."','".$_POST['member_sex']."','".$_POST['member_qq']."','".$_POST['member_phone']."','".$_POST['member_email']."')";
$result=mysql_query($sql)or die(mysql_error());
if($result)
echo "<script>alert('Registered! It will turn to member information page in seconds.');location='member.php';</script>";
else
{
	echo "<script>alert('Registration failed!');location='index.php';</script>";
	mysql_close();
}
	}
}
?>
</head>
<body>
<?php if($_GET['tj'] == 'register'){ ?>
<form id="theForm" name="theForm" method="post" action="" onSubmit="return chk(this)" runat="server" style="margin-bottom:0px;">
  <table width="350" border="0" align="center" cellpadding="5" cellspacing="1" bgcolor="#B3B3B3">
    <tr>
      <td colspan="2" align="center" bgcolor="#EBEBEB">Register membership&nbsp;&nbsp;&nbsp;Those * must be filled in</td>
    </tr>
    <tr>
      <td width="60" align="right" bgcolor="#FFFFFF">Username:</td>
      <td width="317" bgcolor="#FFFFFF"><input name="member_user" type="text" id="member_user" size="20" maxlength="20" />
	  <font color="#FF0000"> *</font><br/>(Must be a valid e-mail address)</td>
    </tr>
    <tr>
      <td align="right" bgcolor="#FFFFFF">Password:</td>
      <td bgcolor="#FFFFFF"><input name="member_password" type="password" id="member_password" size="20" maxlength="20" />
      <font color="#FF0000"> *</font><br/>(Must contains of letters or numbers)</td>
    </tr>
    <tr>
      <td align="right" bgcolor="#FFFFFF">Password:</td>
      <td bgcolor="#FFFFFF"><input name="pass" type="password" id="pass" size="20" />
      <font color="#FF0000"> *</font><br/>(Plz enter your password again)</td>
    </tr>
    <tr>
      <td align="right" bgcolor="#FFFFFF">Real name:</td>
      <td bgcolor="#FFFFFF"><input name="member_name" type="text" id="member_name" size="20" />
      <label><font color="#FF0000">*</font><br/>(Real name cannot be null and the first letter should be a capital one.)</label></td>
    </tr>
    <tr>
      <td align="right" bgcolor="#FFFFFF">Sex:</td>
      <td align="left" bgcolor="#FFFFFF">
          <input name="member_sex" type="radio" id="0" value="male" checked="checked" />
          Male
          <input type="radio" name="member_sex" value="female" id="1" />
          Female&nbsp;</label></td>
    </tr>
    <tr>
      <td align="right" bgcolor="#FFFFFF">QQ:</td>
      <td bgcolor="#FFFFFF"><input name="member_qq" type="text" id="member_qq" size="20"/></td>
    </tr>
    <tr>
      <td align="right" bgcolor="#FFFFFF">Cellphone:</td>
      <td bgcolor="#FFFFFF"><input name="member_phone" type="text" id="member_phone" size="20"/></td>
    </tr>
    <tr>
      <td align="right" bgcolor="#FFFFFF">E-mail:</td>
      <td bgcolor="#FFFFFF"><input name="member_email" type="text" id="member_email" size="20"/></td>
    </tr>
    <tr>
      <td colspan="2" align="center" bgcolor="#FFFFFF"><input type="reset" name="button" id="button" value="reset" />
      <input type="submit" name="submit" id="submit" value="submit" /></td>
    </tr>
  </table>
</form>
<?php
} 
	if($_GET['tj']== ''){
?>
<?php
if($_POST["submit2"]){
$name=$_POST['name'];
$pw=md5($_POST['password']);
$sql="select * from member where member_user='".$name."'"; 
$result=mysql_query($sql) or die("Your account is not true");
$num=mysql_num_rows($result);
if($num==0){
	echo "<script>alert('Your account does not exist');location='index.php';</script>";
	}
while($rs=mysql_fetch_object($result))
{
	if($rs->member_password!=$pw)
	{
		echo "<script>alert('Wrong password');location='index.php';</script>";
		mysql_close();
	}
	else 
	{
		$_SESSION['member']=$_POST['name'];
		header("Location:member.php");
		mysql_close();
		}
	}
}
?>
<form action="" method="post" name="regform" onSubmit="return Checklogin();" style="margin-bottom:0px;">
<table width="350" border="0" align="center" cellpadding="5" cellspacing="1" bgcolor="#B3B3B3">
  <tr>
    <td colspan="2" align="center" bgcolor="#EBEBEB" class="font">Login</td>
  </tr>
    <tr>
      <td width="65" align="center" bgcolor="#FFFFFF" class="font">Username:</td>
      <td width="262" bgcolor="#FFFFFF" class="font"><input name="name" type="text" id="name"/></td>
    </tr>
    <tr>
      <td align="center" valign="top" bgcolor="#FFFFFF" class="font">Password:</td>
      <td bgcolor="#FFFFFF" class="font"><input name="password" type="password" id="password"/>  </td>
    </tr>
    <tr>
    <td colspan="2" align="center" valign="top" bgcolor="#FFFFFF" class="font"><input name="submit2" type="submit" value="submit"/>
      <a href='index.php?tj=register'>New user?</a></td>
  </tr>
</table>
</form>
<?php } ?>
<table width="100" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="5"></td>
  </tr>
</table>

</body>
</html>