<?php
session_start();
if(isset($_SESSION["user"])){
	$usid=$_SESSION["user"];
	$data=mysqli_connect("localhost","root","","bank") or die();
	$db=mysqli_query($data,"SELECT `fname`,`lname`,`balance` FROM login WHERE `uid`='$usid'");
	$db=mysqli_fetch_assoc($db);
	$fn=$db['fname'];
	$ln=$db['lname'];
	$name=ucfirst($fn)." ".ucfirst($ln);
	$bal=$db['balance'];	 
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
			$("#rat").text('5');
		}
		if ($("#tm").val()=="2") {
			$("#rat").text('5.75');
		}
		if ($("#tm").val()=="5") {
			$("#rat").text('6');
		}
		if ($("#tm").val()=="10") {
			$("#rat").text('7');
		}
		if ($("#tm").val()=="20") {
			$("#rat").text('9');
		}
        
        
        });
	
	

});
</script>
</head>
<body>
	  <style type="text/css">
	#rat {display:inline-block;}
	#rt {display:inline-block;}
	#tm {display:inline-block;}
	#st {display:inline-block;}
	</style>
	<h3>Hey <?php echo $name; ?></h3>
	<h3>Your Balance = <?php echo $bal; ?></h3>
	<div>
		
		<form action="fd.php">
			<h4>Enter amount to be deposited:
  <input name="amnt" id="am" type="number">
  <br></h4>
			<h4 id="st">Select Time period :- </h4>
  <select name="timep" id="tm">
    <option value="45">45 days</option>
    <option value="2">2 years</option>
    <option value="5">5 years</option>
    <option value="10">10 years</option>
    <option value="20">20 years</option>
    
  </select><br>

  <h4 id="rt">Rate :  </h4>  <h4 id="rat"></h4> %
  
  <br>
  <input type="submit"  value="check avaibility">
</form>
	</div>

</body>
</html>