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
     $found=1;
 

}


	echo "<table class=searchtbl>$tdata</table>";
 
 
 

?>

 