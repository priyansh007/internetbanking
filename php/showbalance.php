<?php
  session_start();
if(isset($_SESSION['user']))
{
$receiv=$_SESSION['user'];
 
 
$dt=mysqli_connect("localhost","root","","bank") or die();
$db=mysqli_query($dt,"SELECT `balance` FROM login WHERE `uid`='$receiv'");
$db=mysqli_fetch_assoc($db);
$balance=$db['balance'];
 
 
 
	echo "Your Balance is $balance Rs.";
 
}

?>
