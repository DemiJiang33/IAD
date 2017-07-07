<?php
require_once ('config.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!--admin_index.php
    Name: Shanshan Jiang
    Course: IAD   
    HW#: HW3
    Time: 10/20/2015/
    -->
<!--the admin_index.php checks whether the member is "admin" or not.
    The"admin" username is "admin" password is "1234".
    If the member is "admin", then the admin can not only modify his own information
    but also manage other members' information.
    If the member is not "admin", he has to go to index.php to login.
    -->
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta content="text/html; charset=utf-8" />
<title>PHP registration system</title>
<link href="style.css" rel="stylesheet" type="text/css" />
<?php
	//Check if the member is admin or not
	if($_SESSION['member'] != "admin"){
	echo "<script>alert('Plz login!');location='index.php';</script>";
	}
	//Show
	$sql="select * from member order by id asc";
	$result=mysql_query($sql);
	$total=mysql_num_rows($result);
	$page=isset($_GET['page'])?intval($_GET['page']):1;  
	$info_num=2; 
	$pagenum=ceil($total/$info_num); 
	If($page>$pagenum || $page == 0){
       Echo "Error : Can not find The page.";
       Exit;
	}
	$offset=($page-1)*$info_num; 
	$info=mysql_query("select * from member order by id desc limit $offset,$info_num"); 
?>
<?php
	//Delete the users
	if($_GET["tj"]=="del"){
	mysql_query($sql="delete from member where member_user='".$_GET['member']."'");
	echo "<script>alert('Delete successfully!');location='admin_index.php';</script>";
	}
?>
<?php
	//Modify the users
	if($_GET["tj"]=="modify"){
	$sql="select * from member where member_user='".$_GET['member']."'";
	$rs=mysql_fetch_array(mysql_query($sql));
	//Post the changes
	if($_POST["submit"]){	
	mysql_query($sql="update member set member_name='".$_POST['member_name']."',member_qq='".$_POST['member_qq']."',member_phone='".$_POST['member_phone']."',member_email='".$_POST['member_email']."' where member_user='".$_GET['member']."'");
	echo "<script>alert('Modify successfully');location='admin_index.php';</script>";
	}
?>
</head>
<body>
<form method="post" action="" style="margin-top:3px; margin-bottom:3px;">
<table width="350" height="239" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#B3B3B3">
  <tr>
    <td height="26" colspan="2" align="center" bgcolor="#EBEBEB">Modify member<? echo $user; ?>'s information</td>
    </tr>
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
<table width="350" border="0" align="center" cellpadding="5" cellspacing="1" bgcolor="#B3B3B3">
  <tr>
    <td align="center" bgcolor="#FFFFFF"><a href='?tj=destroy'>logout</a>&nbsp;&nbsp;<?php echo "There all".$total."members，Plz manage the information of the members";?></td>
  </tr>
</table>
 
<?php while($rs=mysql_fetch_array($info)){ ?>
<table width="350" border="0" align="center" cellpadding="5" cellspacing="1" bgcolor="#B3B3B3">
  <tr>
    <td colspan="2" bgcolor="#FFFFFF"></td>
  </tr>
  <tr>
    <td width="62" align="center" bgcolor="#FFFFFF">Username:</td>
    <td width="265" bgcolor="#FFFFFF"><?php echo $rs['member_user']; ?></td>
  </tr>
  <tr>
    <td align="center" bgcolor="#FFFFFF">Real&nbsp;&nbsp;name</td>
    <td bgcolor="#FFFFFF"><?php echo $rs['member_name']; ?></td>
  </tr>
  <tr>
    <td align="center" bgcolor="#FFFFFF">Sex</td>
    <td bgcolor="#FFFFFF"><?php echo $rs['member_sex']; ?></td>
  </tr>
  <tr>
    <td align="center" bgcolor="#FFFFFF">Q&nbsp;&nbsp;&nbsp;Q</td>
    <td bgcolor="#FFFFFF"><?php echo $rs['member_qq']; ?></td>
  </tr>
  <tr>
    <td align="center" bgcolor="#FFFFFF">Cellphone</td>
    <td bgcolor="#FFFFFF"><?php echo $rs['member_phone']; ?></td>
  </tr>
  <tr>
    <td align="center" bgcolor="#FFFFFF">E-mail</td>
    <td bgcolor="#FFFFFF"><?php echo $rs['member_email']; ?></td>
  </tr>
  <tr>
    <td align="center" bgcolor="#FFFFFF">Manage the information</td>
    <td bgcolor="#FFFFFF"><?php echo "<a href='?tj=modify&member=".$rs['member_user']."'>Modify</a>&nbsp&nbsp";?>
	<?php echo "<a href='?tj=del&member=".$rs['member_user']."'>Delete</a>" ?>	</td>
  </tr>
</table>
<?php } ?>
	<table width="350" border="0" align="center" cellpadding="5" cellspacing="1" bgcolor="#B3B3B3">
      <tr>
        <td align="center" bgcolor="#FFFFFF"><?php
	if( $page > 1 )
    {
    	echo "<a href='admin_index.php?page=".($page-1)."'>The previous page</a>&nbsp";
	}else{
   	echo "The previous page&nbsp&nbsp";
	}
	for($i=1;$i<=$pagenum;$i++){
       $show=($i!=$page)?"<a href='admin_index.php?page=".$i."'>".$i."</a>":"$i";
       Echo $show." ";
	}
	if( $page<$pagenum)
    {
    	echo "<a href='admin_index.php?page=".($page+1)."'>Next page</a>";
	}else
	{
		echo "Next page";
     }
?></td>
</tr>
</table>

<table width="100" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="5"></td>
  </tr>
</table>

</body>
</html>