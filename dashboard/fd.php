<?php
session_start();
$ro="5";
if(isset($_SESSION["uid"])){
	$usid=$_SESSION["uid"];
	$data=mysqli_connect("localhost","root","","bank") or die();
	$db=mysqli_query($data,"SELECT `fname`,`lname`,`balance` FROM login WHERE `uid`='$usid'");
	$db=mysqli_fetch_assoc($db);
	$fn=$db['fname'];
	$ln=$db['lname'];
	$name=ucfirst($fn)." ".ucfirst($ln);
	$bal=$db['balance'];	 
}
if(isset($_GET['avail'])){
	$yo=$_GET['amnt'];
	$po=$_GET['timep'];
	$usid=$_SESSION["uid"];
	$ro=$_GET['rat'];
	$da=date("Y/m/d");
	if($po==45){
	$da1=date("Y/m/d",time() + ((45) * 24*60*60));
	$to=$yo+($yo*$ro*45/(100*365));
	}
	else if($po==20){
		$da1=date('Y/m/d',strtotime('+19 years'));
	$to=$yo+($yo*$ro*$po/(100));
	}
	else{
		$da1=date("Y/m/d",time() + ((365)*$po*24*60*60));
		$to=$yo+($yo*$ro*$po/(100));
	}

	if($yo>$bal){
	echo "<script type='text/javascript'>alert('Your balance is less');</script>";
	}
	else if($po==45&&$yo<2000){
		echo "<script type='text/javascript'>alert('Amount should be greater than 2000');</script>";

	}
	else if($po==2&&$yo<5000){
		echo "<script type='text/javascript'>alert('Amount should be greater than 5000');</script>";		
	}
	
	else if($po==5&&$yo<7000){
		echo "<script type='text/javascript'>alert('Amount should be greater than 7000');</script>";
	}
	else if($po==10&&$yo<10000){
		echo "<script type='text/javascript'>alert('Amount should be greater than 10000');</script>";
	}
	else if($po==20&&$yo<20000){
		echo "<script type='text/javascript'>alert('Amount should be greater than 20000');</script>";
	}
	else{
		$data=mysqli_connect("localhost","root","","bank") or die();
		$db=mysqli_query($data,"INSERT INTO fd VALUES ('','$usid','$da','$da1','$ro','$yo','$to')");
		$bal=$bal-$yo;
		$db=mysqli_query($data,"UPDATE login SET `balance`='$bal' WHERE `uid`='$usid'");
		header("location:efd.php");
	}
	
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>fd</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script>
$(document).ready(function(){
	$("#tm").click(function(){
		if ($("#tm").val()=="45") {
			$("#rat").val('5');
		}
		if ($("#tm").val()=="2") {
			$("#rat").val('5.75');
		}
		if ($("#tm").val()=="5") {
			$("#rat").val('6');
		}
		if ($("#tm").val()=="10") {
			$("#rat").val('7.25');
		}
		if ($("#tm").val()=="20") {
			$("#rat").val('9');
		}
        
        
        });
	
	

});
</script>
</head>
<body>
	  <style type="text/css">
	#rat {display:inline-block;width:4%;}
	#rt {display:inline-block;}
	#tm {display:inline-block;}
	#st {display:inline-block;}
	</style>
	<h3>Hey <?php echo $name; ?></h3>
	<h3>Your Balance = <?php echo $bal; ?></h3>
	<div>
		Time Period----Min amount <br>
		For 45 days --> 2000 Rupees<br>
		For 2 year -->  5000 Rupees<br>
		For 5 year -->  7000 Rupees<br>
		For 10 year --> 10000 Rupees<br>
		For 20 year --> 20000 Rupees<br>
		<form action="fd.php" method="GET">
			<h4>Enter amount to be deposited:
  <input name="amnt" id="am" type="number" value="<?php echo $yo; ?>">
  <br></h4>
			<h4 id="st">Select Time period :- </h4>
  <select name="timep" id="tm">
  	
    <option value="45">45 days</option>
    <option value="2">2 years</option>
    <option value="5">5 years</option>
    <option value="10">10 years</option>
    <option value="20">20 years</option>
    
  </select><br>

  <h4 id="rt">Rate :  </h4>  <input type="float" name="rat" id="rat" value="5" readonly>%
  
  <br>
  <input type="submit" name="avail" value="check avaibility">
</form>
	</div>

</body>
</html>