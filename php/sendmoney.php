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
$db=mysqli_query($dt,"SELECT `balance` FROM login WHERE `uid`='$receiv'"); 
$db=mysqli_fetch_assoc($db);
$bal=$db['balance'];
 

mysqli_query($dt,"INSERT INTO transaction VALUES(' ','$receiv','$id','$mon','1')");


mysqli_query($dt,"UPDATE `login` SET `balance` = `balance`-'$mon' WHERE `uid`='$receiv'");
mysqli_query($dt,"UPDATE `login` SET `balance` = `balance`+'$mon' WHERE `uid`='$id'");
 
 
	echo "Money is Sent.";
 
}
}
else
	echo "Insufficient Money";

?>

 