<?php
$usid="";
$name="";
$bal="";
$ho="";
$yo="";
$usid=$_COOKIE["user"];
if(!isset($_COOKIE['user'])){
	header("location:login.php");
}
else{
	$data = mysqli_connect("localhost","root","","bank") or die();
	$db=mysqli_query($data,"SELECT `fname`,`lname`,`balance` FROM login WHERE `userid`='$usid'");
	$db=mysqli_fetch_assoc($db);
	$fn=$db['fname'];
	$ln=$db['lname'];

	$name=$fn." ".$ln;
	$bal=$db['balance'];
}
if(isset($_COOKIE['bal'])){
	echo "<script type='text/javascript'>alert('Balance added to your wallet successfully');</script>";
	setcookie("bal",'',time()-1*60*60);

}
if(isset($_COOKIE['cal'])){
	$ho=$_REQUEST['ek'];
	$yo=$_REQUEST['be'];
	echo "<script type='text/javascript'>alert('Transfer $ho rupees to $yo done successfully');</script>";
	setcookie("cal",'',time()-1*60*60);

}
if(isset($_COOKIE['del'])){
	echo "<script type='text/javascript'>alert('Sorry User not found');</script>";
	setcookie("del",'',time()-1*60*60);

}
if(isset($_COOKIE['el'])){
	echo "<script type='text/javascript'>alert('Please Put some Amount');</script>";
	setcookie("el",'',time()-1*60*60);

}
if(isset($_GET['logout'])){
	setcookie("user",'',time()-1*60*60);
	header("location:login.php");

}
if(isset($_GET['but1'])){
	$val=$_GET['num'];
	if($val==0){
		setcookie("el",$val,time()+1*60*60);
		header("location:index.php");
	}
	else{
	$data = mysqli_connect("localhost","root","","bank") or die();
	$db=mysqli_query($data,"SELECT `balance` FROM login WHERE `userid`='$usid'");
	$db=mysqli_fetch_assoc($db);
	$ba=$db['balance'];
	$ba=$ba+$val;

	mysqli_query($data,"UPDATE login SET `balance`='$ba' WHERE `userid`='$usid'");
	mysqli_query($data,"INSERT INTO trans VALUES('','$usid','Added $val rupees to wallet successfully')");
	setcookie("bal",$bal,time()+1*60*60);
	header("location:index.php");
 }

}
if(isset($_GET['but2'])){
	$val=$_GET['num2'];
	$nm=$_GET['usr'];
	$flag=0;
	$data = mysqli_connect("localhost","root","","bank") or die();
	$db=mysqli_query($data,"SELECT `userid`,`balance` FROM login");
	$df=mysqli_query($data,"SELECT `balance` FROM login WHERE `userid`='$usid'");
	$df=mysqli_fetch_assoc($df);

	$ba=$df['balance'];
	if($val==0){
		setcookie("el",$ba,time()+1*60*60);
		header("location:index.php");
	}else{
	foreach ($db as $dc) {
		$yo=$dc["userid"];
		$ho=$dc["balance"];
		$ho=$val+$ho;

		if($yo==$nm){
			$ba=$ba-$val;
			mysqli_query($data,"UPDATE login SET `balance`='$ba' WHERE `userid`='$usid'");
			mysqli_query($data,"UPDATE login SET `balance`='$ho' WHERE `userid`='$yo'");
			mysqli_query($data,"INSERT INTO trans VALUES('','$usid','Transfered $val rupees to $yo')");
			mysqli_query($data,"INSERT INTO trans VALUES('','$yo','Recieved $val rupees from $usid')");
			setcookie("cal",$yo,time()+1*60*60);
			$flag=1;
			header("location:index.php?ek=$val&&be=$yo");

		}
		

	}
	if($flag==0){
		setcookie("del",$yo,time()+1*60*60);
		header("location:index.php");	
	}
	
 }

}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
	$("#add").click(function(){
        $("#add").hide();
        $("#add1").show();
        });
	$("#pay").click(function(){
        $("#pay").hide();
        $("#pay1").show();
        });
	$("#tra1").click(function(){
        $("#tra1").hide(1000);
        $("#tra2").show(1000);
        });
	$("#ro").click(function(){
        $("#tra2").hide(1000);
        $("#tra1").show(1000);
        });
	

});
</script>
</head>
<body>
	<h1>Welcome to Bank <?php echo $name; ?></h1>
	<div>
		<h3>Balance = <?php echo $bal; ?></h3>
		
	</div>
	<div>
		<button id="add">Add Money</button>
		<form method="GET" action="index.php" id="add1" style="display: none;">
			<input type="number" name="num" value="0">
			<input type="submit" name="but1" value="ADD">
		</form><br><br>
		<button id="pay">Pay Money</button>
		<form method="GET" action="index.php" id="pay1" style="display: none;">
			To : <input type="text" name="usr" value="userid"><br><br>
			Amount : <input type="number" name="num2" value="0">
			<input type="submit" name="but2" value="PAY">
		</form><br><br>
		<button id="tra1">Transaction</button>
		<div id="tra2" style="display: none;">
			<?php
			$data = mysqli_connect("localhost","root","","bank") or die();
			$db=mysqli_query($data,"SELECT `des` FROM trans WHERE `userid1`='$usid'");
			foreach ($db as $dc) {
				$nm=$dc['des'];
				echo $nm."<br>";
				
			}
			?>
			<button id="ro">/\</button>
			</div><br><br>
		<form method="GET" action="index.php" id="logou">
			<input type="submit" name="logout" value="Log Out">
		</form>
	</div>

</body>
</html>