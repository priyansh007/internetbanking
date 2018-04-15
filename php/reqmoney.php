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
$id=$db['uid'];
 

mysqli_query($dt,"INSERT INTO transaction VALUES(' ','$receiv','$id','$mon','0')");
 
 
	echo "Request is Sent.";
 
}

?>

 