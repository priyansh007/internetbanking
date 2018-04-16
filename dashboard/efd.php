<?php
	session_start();
	if (!isset($_SESSION["uid"]))
	{
		header("location:../auth/login/");
	}
	$usid=$_SESSION["uid"];
	$data=mysqli_connect("localhost","root","","bank") or die();
	$db=mysqli_query($data,"SELECT `fname`,`lname`,`balance` FROM login WHERE `uid`='$usid'");
	$db=mysqli_fetch_assoc($db);
	$fn=$db['fname'];
	$ln=$db['lname'];
	$name=ucfirst($fn)." ".ucfirst($ln);
	$bal=$db['balance'];
	
	if(isset($_GET['avail']))
	{
		$yo=$_GET['amnt'];
		$po=$_GET['timep'];
		$usid=$_SESSION["uid"];		
		$ro=$_GET['rat'];
		$da=date("Y/m/d");
		if($po==45)
		{
		$da1=date("Y/m/d",time() + ((45) * 24*60*60));
		$to=$yo+($yo*$ro*45/(100*365));
		}
		else if($po==20)
		{
			$da1=date('Y/m/d',strtotime('+19 years'));
		$to=$yo+($yo*$ro*$po/(100));
		}
		else
		{
			$da1=date("Y/m/d",time() + ((365)*$po*24*60*60));
			$to=$yo+($yo*$ro*$po/(100));
		}
		if($yo>$bal)
		{
			echo "<script type='text/javascript'>alert('Your balance is less');</script>";
		}
		else if($po==45&&$yo<2000)
		{
			echo "<script type='text/javascript'>alert('Amount should be greater than 2000');</script>";

		}
		else if($po==2&&$yo<5000)
		{
			echo "<script type='text/javascript'>alert('Amount should be greater than 5000');</script>";		
		}
		
		else if($po==5&&$yo<7000)
		{
			echo "<script type='text/javascript'>alert('Amount should be greater than 7000');</script>";
		}
		else if($po==10&&$yo<10000)
		{
			echo "<script type='text/javascript'>alert('Amount should be greater than 10000');</script>";
		}
		else if($po==20&&$yo<20000)
		{
			echo "<script type='text/javascript'>alert('Amount should be greater than 20000');</script>";
		}
		else
		{
			$data=mysqli_connect("localhost","root","","bank") or die();
			$db=mysqli_query($data,"INSERT INTO fd VALUES ('','$usid','$da','$da1','$ro','$yo','$to')");
			$bal=$bal-$yo;
			$db=mysqli_query($data,"UPDATE login SET `balance`='$bal' WHERE `uid`='$usid'");
			header("location:efd.php");
		}		
	}
?>
<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="description" content="A front-end template that helps you build fast, modern mobile web apps.">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Internet Banking</title>

		<!-- Add to homescreen for Chrome on Android -->
		<meta name="mobile-web-app-capable" content="yes">    

		<!-- Add to homescreen for Safari on iOS -->
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black">
		<meta name="apple-mobile-web-app-title" content="Material Design Lite">

		<!-- Tile icon for Win8 (144x144 + tile color) -->
		<meta name="msapplication-TileColor" content="#3372DF">

		<link href="https://fonts.googleapis.com/css?family=Roboto:regular,bold,italic,thin,light,bolditalic,black,medium&amp;lang=en" rel="stylesheet">
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
		<link rel="stylesheet" href="../css/material.min.css">
		<link rel="stylesheet" href="../css/styles.css">		
		<style>
			#view-source {
			  position: fixed;
			  display: block;
			  right: 0;
			  bottom: 0;
			  margin-right: 40px;
			  margin-bottom: 40px;
			  z-index: 900;
			}
		</style>
	</head>
	<body>
		<div class="demo-layout mdl-layout mdl-js-layout mdl-layout--fixed-drawer mdl-layout--fixed-header">
			<header class="demo-header mdl-layout__header mdl-color--grey-100 mdl-color-text--grey-600">
				<div class="mdl-layout__header-row">
					<span class="mdl-layout-title">Fixed Deposits</span> 
					<!-- Right aligned menu below button -->
					<div class="mdl-layout-spacer"></div>
					<button id="demo-menu-lower-right" onclick="shownot()"
							class="mdl-button mdl-js-button mdl-button--icon">
					  <i class="material-icons">feedback</i>
					</button>

					<ul class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect"
						for="demo-menu-lower-right" id='shownot'>					  
					</ul>
				</div>
			</header>
			<div class="demo-drawer mdl-layout__drawer mdl-color--blue-grey-900 mdl-color-text--blue-grey-50">
				<header class="demo-drawer-header">
					<i class="material-icons" style="font-size:60px;color:white;" role="presentation">account_box</i><br>
					<div class="demo-avatar-dropdown">
						<span>
							<i class='material-icons' style='font-size:16px;'>verified_user</i>&nbsp;<?php echo $name;?>
						</span>
						<div class="mdl-layout-spacer"></div>
						<button id="accbtn" class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--icon">
							<i class="material-icons" role="presentation">arrow_drop_down</i>
							<span class="visuallyhidden">Accounts</span>
						</button>
						<ul type="submit" class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect" for="accbtn">
							<a style='text-decoration: none;' href='../your-info/'><li type='submit' class='mdl-menu__item'><i class='material-icons'>info_outline</i>&ensp;Account</li></a>
							<a style='text-decoration: none;' href='../auth/logout.php'><li type='submit' class='mdl-menu__item'><i class='material-icons'>delete</i>&ensp;Logout</li></a>							
						</ul>
					</div>
				</header>
				<nav class="demo-navigation mdl-navigation mdl-color--blue-grey-800">
					<a class="mdl-navigation__link" href="../dashboard/"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">home</i>Home</a>
					<a class='mdl-navigation__link' href='../dashboard/efd.php'><i class='mdl-color-text--blue-grey-400 material-icons' role='presentation'>shopping_basket</i>e-Fixed Deposit</a>		  
					<a class='mdl-navigation__link' href='../dashboard/ifsc.php'><i class='mdl-color-text--blue-grey-400 material-icons' role='presentation'>shopping_basket</i>IFSC Search</a>
					<div class="mdl-layout-spacer"></div>
					<a class="mdl-navigation__link" href="../contact-us/"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">people</i>Contact Us</a>
				</nav>
			</div>
			<main class="mdl-layout__content mdl-color--grey-100">
				<div class="mdl-grid demo-content">
					<div class="wide-card mdl-card mdl-shadow--2dp mdl-cell mdl-cell--4-col mdl-cell--4-col-tablet mdl-cell--4-col-desktop" style="min-height:0px;" onmouseover="$(this).addClass('mdl-shadow--8dp');" onmouseout="$(this).removeClass('mdl-shadow--8dp');">
						<div class = "mdl-card__title mdl-color--teal-300">
							<h2 class = "mdl-card__title-text">My FDs</h2>
						</div>
						<div class = "mdl-card__supporting-text" id ='sreqmoney' style="font-size:18px">
						<?php
							$data = mysqli_connect("localhost","root","","bank") or die();
							$db=mysqli_query($data,"SELECT `fid`,`opendate`,`closedate`,`interest`,`startmoney`,`endmoney` FROM fd WHERE `uid`='$usid'");
							$rows=mysqli_num_rows($db);
							if($rows==0)
							{
								echo "No current FDs found";
							}
							else
							{
								foreach ($db as $dc) 
								{
									$od=$dc['opendate'];
									$cd=$dc['closedate'];
									$it=$dc['interest'];
									$sm=$dc['startmoney'];
									$em=$dc['endmoney'];
									echo "<b>$sm</b> is fixed on <b>$od</b> last date is <b>$cd</b> final amount will be <b>$em</b> with interest rate <b>$it%</b><br><br>";				
								}
							}							
						?>
						</div>
					</div>
					<div class="wide-card mdl-card mdl-shadow--2dp mdl-cell mdl-cell--4-col mdl-cell--4-col-tablet mdl-cell--4-col-desktop" style="min-height:0px;" onmouseover="$(this).addClass('mdl-shadow--8dp');" onmouseout="$(this).removeClass('mdl-shadow--8dp');">
						<div class = "mdl-card__title mdl-color--teal-300">
							<h2 class = "mdl-card__title-text">Fixed Deposit Schemes</h2>
						</div>
						<div class = "mdl-card__supporting-text" id ='sreqmoney' style="font-size:18px">
							Time Period----Min amount <br>
							For 45 days --> 2000 Rupees<br>
							For 2 year -->  5000 Rupees<br>
							For 5 year -->  7000 Rupees<br>
							For 10 year --> 10000 Rupees<br>
							For 20 year --> 20000 Rupees<br>
						</div>
						<div class="mdl-card__actions mdl-card--border">
							<form method="GET">
								<div class = "mdl-textfield mdl-js-textfield mdl-textfield--expandable">								
									<label class = "mdl-button mdl-js-button mdl-button--icon" for = "amnt">
										<i class = "material-icons">add</i>
									</label>
									<div class = "mdl-textfield__expandable-holder">
										<input class = "mdl-textfield__input" type = "text" 
											pattern = "-?[0-9]*(\.[0-9]+)?" id = "amnt" name='amnt'>
										<label class = "mdl-textfield__label" for = "amnt">
											Amount..</label>
										<span class = "mdl-textfield__error">Number required!</span>
									</div>
									<i>₹</i>
								</div>
								<h4 id="st">Select Time period :- </h4>
								<select name="timep" id="tm">						
									<option value="45">45 days</option>
									<option value="2">2 years</option>
									<option value="5">5 years</option>
									<option value="10">10 years</option>
									<option value="20">20 years</option>							
								</select><br>
								Rate
								<div class = "mdl-textfield mdl-js-textfield mdl-textfield--expandable">								
									<label class = "mdl-button mdl-js-button mdl-button--icon" for = "rat">
										<i class = "material-icons">info</i>
									</label>
									<div class = "mdl-textfield__expandable-holder">
										<input class = "mdl-textfield__input" type = "text" 
											pattern = "[0-9]+(\.[0-9]+)?" id = "rat">
										<label class = "mdl-textfield__label" for = "rat">
											Amount..</label>
										<span class = "mdl-textfield__error">Number required!</span>
									</div>
									<i>%</i>
								</div>
								<button class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect" type="submit" name="avail">Check Availability</button>
							</form>														
						</div>
					</div>
				</div>
			</main>
		</div>
		<script src="../js/material.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.slim.min.js"></script>
		<script type="text/javascript">
			function shownot()
			{ 
				var xhttp = new XMLHttpRequest();
				xhttp.onreadystatechange = function() {

					if (this.readyState == 4 && this.status == 200) {
						if(this.responseText)
							document.getElementById("shownot").innerHTML = this.responseText;	
					}
				};
				xhttp.open("GET", "shownot.php", true);
				xhttp.send();			
			}
			
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
	</body>
</html>
