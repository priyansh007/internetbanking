<?php
	session_start();
	if (!isset($_SESSION["uid"]))
	{
		header("location:../auth/login/");
	}
	$usid=$_SESSION["uid"];
	$data=mysqli_connect("localhost","root","","bank") or die();
	$db=mysqli_query($data,"SELECT `fname`,`lname` FROM login WHERE `uid`='$usid'");
	$db=mysqli_fetch_assoc($db);
	$fn=$db['fname'];
	$ln=$db['lname'];
	$name=ucfirst($fn)." ".ucfirst($ln);
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
					<span class="mdl-layout-title">Home</span> 
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
					<div class="mdl-layout-spacer"></div>
					<a class="mdl-navigation__link" href="../contact-us/"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">people</i>Contact Us</a>
				</nav>
			</div>
			<main class="mdl-layout__content mdl-color--grey-100">
				<div class="mdl-grid demo-content">
					<div class = "wide-card mdl-card mdl-shadow--2dp mdl-cell mdl-cell--4-col mdl-cell--4-col-tablet mdl-cell--4-col-desktop" style="min-height:0px;" onmouseover="$(this).addClass('mdl-shadow--8dp');" onmouseout="$(this).removeClass('mdl-shadow--8dp');">
						<div class = "mdl-card__title mdl-color--teal-300">
							<h2 class = "mdl-card__title-text">Balance</h2>
						</div>
						<div class = "mdl-card__supporting-text" id='showbalance' style="font-size:18px">
							Check your balance here
						</div>
						<div class="mdl-card__actions mdl-card--border">
							<button class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect" onclick="getbalance()">Check</button>
						</div>
					</div>
					<div class="wide-card mdl-card mdl-shadow--2dp mdl-cell mdl-cell--4-col mdl-cell--4-col-tablet mdl-cell--4-col-desktop" style="min-height:0px;" onmouseover="$(this).addClass('mdl-shadow--8dp');" onmouseout="$(this).removeClass('mdl-shadow--8dp');">
						<div class = "mdl-card__title mdl-color--teal-300">
							<h2 class = "mdl-card__title-text">Request money</h2>
						</div>
						<div class = "mdl-card__supporting-text" id ='sreqmoney' style="font-size:18px">
							Enter userid and amount to request
						</div>
						<div class="mdl-card__actions mdl-card--border">
							<div class = "mdl-textfield mdl-js-textfield mdl-textfield--expandable">
								<label class = "mdl-button mdl-js-button mdl-button--icon" for = "ruserid">
									<i class = "material-icons">search</i>
								</label>
								<div class = "mdl-textfield__expandable-holder">
									<input class = "mdl-textfield__input" type = "text" id = "ruserid">
									<label class = "mdl-textfield__label" for = "sample-expandable">
									   Expandable Input</label>
								</div>
							</div>
							<div class = "mdl-textfield mdl-js-textfield mdl-textfield--expandable">								
								<label class = "mdl-button mdl-js-button mdl-button--icon" for = "rmoney">
									<i class = "material-icons">add</i>
								</label>
								<div class = "mdl-textfield__expandable-holder">
									<input class = "mdl-textfield__input" type = "text" 
										pattern = "-?[0-9]*(\.[0-9]+)?" id = "rmoney">
									<label class = "mdl-textfield__label" for = "rmoney">
										Amount..</label>
									<span class = "mdl-textfield__error">Number required!</span>
								</div>
								<i>₹</i>
							</div>
							<button class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect" onclick="reqmoney()">Request</button>
						</div>
					</div>
					<div class="wide-card mdl-card mdl-shadow--2dp mdl-cell mdl-cell--4-col mdl-cell--4-col-tablet mdl-cell--4-col-desktop" style="min-height:0px;" onmouseover="$(this).addClass('mdl-shadow--8dp');" onmouseout="$(this).removeClass('mdl-shadow--8dp');">
						<div class = "mdl-card__title mdl-color--teal-300">
							<h2 class = "mdl-card__title-text">Send Money</h2>
						</div>
						<div class = "mdl-card__supporting-text" id='ssendmoney' style="font-size:18px">
							Enter userid and amount to send
						</div>
						<div class="mdl-card__actions mdl-card--border">
							<div class = "mdl-textfield mdl-js-textfield mdl-textfield--expandable">
								<label class = "mdl-button mdl-js-button mdl-button--icon" for = "suserid">
									<i class = "material-icons">search</i>
								</label>
								<div class = "mdl-textfield__expandable-holder">
									<input class = "mdl-textfield__input" type = "text" id = "suserid">
									<label class = "mdl-textfield__label" for = "sample-expandable">
									   Expandable Input</label>
								</div>
							</div>
							<div class = "mdl-textfield mdl-js-textfield mdl-textfield--expandable">								
								<label class = "mdl-button mdl-js-button mdl-button--icon" for = "smoney">
									<i class = "material-icons">add</i>
								</label>
								<div class = "mdl-textfield__expandable-holder">
									<input class = "mdl-textfield__input" type = "text" 
										pattern = "-?[0-9]*(\.[0-9]+)?" id = "smoney">
									<label class = "mdl-textfield__label" for = "smoney">
										Amount..</label>
									<span class = "mdl-textfield__error">Number required!</span>
								</div>
								<i>₹</i>
							</div>
							<button class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect" onclick="sendmoney()">Send</button>
						</div>
					</div>											
				</div>
			</main>
		</div>
		<script src="../js/material.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.slim.min.js"></script>
		<script type="text/javascript">
			function getbalance()
			{ 
				var xhttp = new XMLHttpRequest();
				xhttp.onreadystatechange = function() {

					if (this.readyState == 4 && this.status == 200) {

						if(this.responseText)
							document.getElementById("showbalance").innerHTML = this.responseText;	
					}
				};
				xhttp.open("GET", "showbalance.php", true);
				xhttp.send();
			}
			
			function reqmoney()
			{ 
				var id=document.getElementById("ruserid").value;
				var mon=document.getElementById("rmoney").value;
			 
				var xhttp = new XMLHttpRequest();
				xhttp.onreadystatechange = function() {

					if (this.readyState == 4 && this.status == 200) {
						if(this.responseText)
							document.getElementById("sreqmoney").innerHTML = this.responseText;	
					}
				};
				xhttp.open("GET", "reqmoney.php?id="+id+"&mon="+mon, true);
				xhttp.send();
			
			}
			
			function sendmoney()
			{ 
				var id=document.getElementById("suserid").value;
				var mon=document.getElementById("smoney").value;
			 
				var xhttp = new XMLHttpRequest();
				xhttp.onreadystatechange = function() {

					if (this.readyState == 4 && this.status == 200) {
						if(this.responseText)
							document.getElementById("ssendmoney").innerHTML = this.responseText;	
					}
				};
				xhttp.open("GET", "sendmoney.php?id="+id+"&mon="+mon, true);
				xhttp.send();
			}
			
			function shownot()
			{ 
				var xhttp = new XMLHttpRequest();
				xhttp.onreadystatechange = function() {

					if (this.readyState == 4 && this.status == 200) {

						document.getElementById("shownot").innerHTML = this.responseText;	
					}
				};
				xhttp.open("GET", "shownot.php", true);
				xhttp.send();			
			}
		</script>
	</body>
</html>