<?php
	session_start();
	if(isset($_SESSION["uid"]))
	{
		header("location:../../dashboard/");
	}
	require_once "../recaptchalib.php";
	$secret = "6LeyLlIUAAAAAD7zHE4LT0BZzt7cvLIOtpyi-HG6";
	// empty response
	$response = null;
	// check secret key
	$reCaptcha = new ReCaptcha($secret);
	if(isset($_POST["signup"]))
    {	
		if($_POST["g-recaptcha-response"]) 
		{
			$response = $reCaptcha->verifyResponse(
				$_SERVER["REMOTE_ADDR"],
				$_POST["g-recaptcha-response"]
			);
		}
		else
		{
			echo '<script language="javascript">';
			echo 'alert("Captcha not completed");';			
			echo '</script>';			
		}
		if ($response != null && $response->success) 
		{
			$mail=$_POST["email"];
			$finame=$_POST["fname"];
			$liname=$_POST["lname"];
			$uid=$_POST["userid"];
			$passwd=$_POST["pass"];
			//$temp=hash('sha256',$ids);
			//$psswd=hash('sha512', $temp.$_POST["pass"].$temp);   
			$data=mysqli_connect("localhost","root","","bank") or die();		
			$db=mysqli_query($data,"SELECT `uid` FROM login WHERE `emailid`='$mail' OR `userid`='$uid'");
			$rows=mysqli_num_rows($db);
			if($rows!=0)
			{
				echo "<script type='text/javascript'>alert('ID already exists');</script>";								
			}													
			else
			{
				mysqli_query($data,"INSERT INTO login(`userid`, `password`, `fname`, `lname`, `emailid`, `balance`) VALUES('$uid','$passwd','$finame','$liname','$mail','0')");		
				echo "<script type='text/javascript'>alert('ID Registeration complete');window.location='../login/'</script>";					
				//header("location:index.php");
			}
		}		
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Signup Page</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../css/util.css">
	<link rel="stylesheet" type="text/css" href="../css/main.css">
<!--===============================================================================================-->
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<form method="post" class="login100-form validate-form">
					<span class="login100-form-title p-b-26">
						SignUp
					</span>					
			
					<div class="wrap-input100 validate-input" data-validate = "Valid email is: a@b.c">
						<input class="input100" type="text" name="email">
						<span class="focus-input100" data-placeholder="Email"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Enter password">
						<span class="btn-show-pass">
							<i class="zmdi zmdi-eye"></i>
						</span>
						<input class="input100" type="password" name="pass">
						<span class="focus-input100" data-placeholder="Password"></span>
					</div>
					
					<div class="wrap-input100 validate-input" data-validate = "Enter userid">
						<input class="input100" type="text" name="userid">
						<span class="focus-input100" data-placeholder="UserId"></span>
					</div>
					
					<div class="wrap-input100 validate-input" data-validate = "Enter First Name">
						<input class="input100" type="text" name="fname">
						<span class="focus-input100" data-placeholder="First Name"></span>
					</div>
					
					<div class="wrap-input100 validate-input" data-validate = "Enter Last Name">
						<input class="input100" type="text" name="lname">
						<span class="focus-input100" data-placeholder="Last Name"></span>
					</div>
					
					<div class="g-recaptcha text-center" data-sitekey="6LeyLlIUAAAAAOK9qQTeFYVPouYotNEICcrSfhk9"></div>
					
					<div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button class="login100-form-btn" type="submit" name="signup">
								Signup
							</button>
						</div>
					</div>					
				</form>
				<div class="text-center p-t-45">
						<a class="txt2" style="cursor: pointer;" onclick="window.location='../login/';" >
							<b><u>Back to Log In</u></b>
						</a>
					</div>
			</div>
		</div>
	</div>
	
<!--===============================================================================================-->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.slim.min.js"></script>
<!--===============================================================================================-->
	<script src="../js/main.js"></script>
	<script src='https://www.google.com/recaptcha/api.js'></script>

</body>
</html>