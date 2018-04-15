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
if(isset($_GET['fdbut'])){
header("location:fd.php");
}
?>
 <!DOCTYPE html>
 <html>
 <head>
 	<title></title>
 </head>
 <link rel="stylesheet" type="text/css" href="../css/bank.css?999">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
 <body>
 <h3>Welcome back <?php echo $name; ?></h3>
	  <p>You have logged in from IP: <?php echo $_SERVER['REMOTE_ADDR']; ?><br />You log in at: <?php echo date("h:i A d M Y"); ?></p>

	  <div >

	  	<button onclick="getbalance()">Get Balance</button>
	  	<p id="showbalance"></p>
	  	
	  </div>

	  <div>
	  	<button class="showreqmoney">Request money</button>
	  	<div id="reqmoney" class="reqmoney">
	  		<input type="text" id="ruserid"><br>
	  		<input type="text" id="rmoney">
	  		<button onclick="reqmoney()">Request money</button>
	  		<p id="sreqmoney"></p>

	  	</div>
	  </div>

	  <div>
	  	<button class="showsendmoney">Send money</button>
	  	<div id="sendmoney" class="sendmoney">
	  		<input type="text" id="suserid"><br>
	  		<input type="text" id="smoney">
	  		<button onclick="sendmoney()">Send money</button>
	  		<p id="ssendmoney"></p>

	  	</div>
	  </div>

	  <div>
	  	<button class="bshownot" onclick="shownot()">Show Notifications</button>
	  	<div id="shownot" class="shownot">
	  		 
	  		 
	  		 

	  	</div>
      <br><br>
			<form method="GET" action="index.php" id="fd">
				<input type="submit" name="fdbut" value="FD">
			</form>
	  </div>



 </body>
 </html>


 <script type="text/javascript">
	  
function getbalance()
	{ 
	 
		var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function() {

			if (this.readyState == 4 && this.status == 200) {

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


<script  >


		$(document).ready(function() {


			$(".showreqmoney").click(function(){
    		
    		$(".showreqmoney").text(function(i, text){
         	 return text === "Request money" ? "done" : "Request money";
     			 })
    		$(".reqmoney").toggle();
		});

			$(".showsendmoney").click(function(){
    		
    		$(".showsendmoney").text(function(i, text){
         	 return text === "Send money" ? "done" : "Send money";
     			 })
    		$(".sendmoney").toggle();
		});

			$(".bshownot").click(function(){
    		
    		$(".bshownot").text(function(i, text){
         	 return text === "Show Notifications" ? "Hide Notifications" : "Show Notifications";
     			 })
    		$(".shownot").toggle();
		});


		});
 </script>

