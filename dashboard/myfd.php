<!DOCTYPE html>
<html>
<head>
	<title>myfd</title>
</head>
<body>
	<div>
		<?php
		session_start();
		$usid=$_SESSION["user"];
		$data = mysqli_connect("localhost","root","","bank") or die();
			$db=mysqli_query($data,"SELECT `fid`,`opendate`,`closedate`,`interest`,`startmoney`,`endmoney` FROM fd WHERE `uid`='$usid'");

			foreach ($db as $dc) {
				$od=$dc['opendate'];
				$cd=$dc['closedate'];
				$it=$dc['interest'];
				$sm=$dc['startmoney'];
				$em=$dc['endmoney'];
				echo "$sm is fixed on $od last date is $cd final amount will be $em with interest rate $it<br>";				
			}
		?>
	</div>

</body>
</html>