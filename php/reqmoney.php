<?php
  session_start();
  $id=$_GET['id'];
  $mon=$_GET['mon'];


if(isset($_SESSION['user']))
{
$receiv=$_SESSION['user'];
$dt=mysqli_connect("localhost","root","","bank") or die();
$db=mysqli_query($dt,"SELECT `uid` FROM login WHERE `userid`='$id'");
$db=mysqli_fetch_assoc($db);
$id1=$db['uid'];


$db=mysqli_query($dt,"SELECT `userid` FROM login WHERE `uid`='$receiv'");
$db=mysqli_fetch_assoc($db);
$id2=$db['userid'];
 

 

mysqli_query($dt,"INSERT INTO transaction VALUES(' ','$receiv','$id1','$mon','0')");


			mysqli_query($dt,"INSERT INTO trans VALUES('','$id2','Requested $mon rupees to $id')");
			mysqli_query($dt,"INSERT INTO trans VALUES('','$id','$id2 Requested $mon rupees')");
 
 
	echo "Request is Sent.";
 
}

?>

 