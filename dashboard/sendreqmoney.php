<?php
	session_start();
	$id=$_GET['id'];
	$mon=$_GET['mon'];
	$tid=$_GET['tid'];
	if(isset($_SESSION['uid']))
	{
		$receiv=$_SESSION['uid'];
		$dt=mysqli_connect("localhost","root","","bank") or die();
		$db=mysqli_query($dt,"SELECT `userid` FROM login WHERE `uid`='$id'");
		$db=mysqli_fetch_assoc($db);
		$id1=$db['userid'];
		$db=mysqli_query($dt,"SELECT `balance`,`userid` FROM login WHERE `uid`='$receiv'"); 
		$db=mysqli_fetch_assoc($db);
		$bal=$db['balance'];
		$id2=$db['userid'];
		mysqli_query($dt,"INSERT INTO transaction VALUES(' ','$receiv','$id','$mon','1')");
		mysqli_query($dt,"UPDATE `login` SET `balance` = `balance`-'$mon' WHERE `uid`='$receiv'");
		mysqli_query($dt,"UPDATE `login` SET `balance` = `balance`+'$mon' WHERE `uid`='$id'");
		mysqli_query($dt,"INSERT INTO trans VALUES('','$receiv','Sent $mon rupees to $id')");
		mysqli_query($dt,"INSERT INTO trans VALUES('','$id','Recieved $mon rupees from $id2')");
		mysqli_query($dt,"DELETE FROM transaction WHERE `tid`='$tid'"); 
		header("location:index.php");	 	 
	}
?>

 
