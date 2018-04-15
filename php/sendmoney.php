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
$db=mysqli_query($dt,"SELECT `balance`,`userid` FROM login WHERE `uid`='$receiv'"); 
$db=mysqli_fetch_assoc($db);
$bal=$db['balance'];
$id2=$db['userid'];
 

mysqli_query($dt,"INSERT INTO transaction VALUES(' ','$receiv','$id1','$mon','1')");


mysqli_query($dt,"UPDATE `login` SET `balance` = `balance`-'$mon' WHERE `uid`='$receiv'");
mysqli_query($dt,"UPDATE `login` SET `balance` = `balance`+'$mon' WHERE `uid`='$id'");

mysqli_query($dt,"INSERT INTO trans VALUES('','$id2','Sent $mon rupees to $id')");
mysqli_query($dt,"INSERT INTO trans VALUES('','$id','Recieved $mon rupees from $id2')");
 
 
	echo "Money is Sent.";
 
}

else
	echo "Insufficient Money";

?>

 