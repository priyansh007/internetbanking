<?php
  session_start();
 $receiv=$_SESSION['user'];


$dt=mysqli_connect("localhost","root","","bank") or die();
$db=mysqli_query($dt,"SELECT `userid` FROM login WHERE `uid`='$receiv'");
$db=mysqli_fetch_assoc($db);
$usid=$db['userid'];
 
$db=mysqli_query($dt,"SELECT `des` FROM trans WHERE `userid1`='$usid'");

$tdata="";
 

foreach($db as $usid){

	$des=$usid['des'];	
     $tdata=$tdata."<tr><td class=row>$des</td><tr> ";
  
 

}

$db=mysqli_query($dt,"SELECT `tid`,`money`,`sender` FROM transaction WHERE `receiver`='$receiv' && `flag`='0'");


foreach($db as $usid){

	$tid=$usid['tid'];
	$mon=$usid['money'];
	$sender=$usid['sender'];
	 
	$db=mysqli_query($dt,"SELECT `userid` FROM login WHERE `uid`='$sender'");
	$db=mysqli_fetch_assoc($db);
	$sendername=$db['userid'];

     $tdata=$tdata."<tr><td>$sendername Requested You Money$mon Rs.</td><td class=row><form method=post action=sendreqmoney.php?id=$sender&mon=$mon&tid=$tid><input type=submit value=Send></form></td><tr> ";
     $found=1;
 

}


	echo "<table class=searchtbl>$tdata</table>";
 
 
 

?>

