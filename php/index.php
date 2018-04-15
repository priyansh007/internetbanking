 <?php
 session_start();
if(isset($_SESSION["user"])){
	$usid=$_SESSION["user"];
	$data=mysqli_connect("localhost","root","","bank") or die();
	$db=mysqli_query($data,"SELECT `fname`,`lname` FROM login WHERE `uid`='$usid'");
	$db=mysqli_fetch_assoc($db);
	$fn=$db['fname'];
	$ln=$db['lname'];
	$name=ucfirst($fn)." ".ucfirst($ln);	 
}
 
?>

 <!DOCTYPE html>
 <html>
 <head>
 	<title></title>
 </head>
 <body>
 <h3>Welcome back <?php echo $name; ?></h3>
	  <p>You have logged in from IP: <?php echo $_SERVER['REMOTE_ADDR']; ?><br />You log in at: <?php echo date("h:i A d M Y"); ?></p>
 </body>
 </html>