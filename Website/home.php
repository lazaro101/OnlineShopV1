<?php

session_start();
if(!isset($_SESSION['type'])){
	header('Location:../index.php');
}

require("header.php");
include("../config.php");

if ($_SESSION['type'] != 'guest') {
	$email = $_SESSION['email'];
	$sql = "SELECT * FROM orders WHERE username = '$email' AND checkout = '0' ; ";
	$conn = config();

	$result = mysqli_query($conn,$sql);
	$row =  mysqli_fetch_assoc($result);

	if(empty($row)){
		$ins = "INSERT INTO orders(username) VALUES ('$email');";
		mysqli_query($conn,$ins);
		$lastid = "SELECT LAST_INSERT_ID() AS id; ";
		$row1 =  mysqli_fetch_assoc(mysqli_query($conn,$lastid));
		$_SESSION['orderid'] = $row1['id'];
	} else {
		$_SESSION['orderid'] = $row['orderID'];
	}

	$order = $_SESSION['orderid'];
	$ctr = 0;

	$search = "SELECT * FROM orderdetails WHERE orderID = '$order' ; ";
	$result1 = mysqli_query($conn,$search);

	while($row1 =  mysqli_fetch_assoc($result1)){
		$ctr += 1;
	}
	$_SESSION['badge'] = $ctr;
}
?>
<link rel="stylesheet" type="text/css" href="home.css">

 <div id="myCarousel" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  <ol class="carousel-indicators">
    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
    <li data-target="#myCarousel" data-slide-to="1"></li>
    <li data-target="#myCarousel" data-slide-to="2"></li>
  </ol>
  <div class="carousel-inner" role="listbox">
    <div class="item active">
      <img class="first-slide" src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" alt="First slide">
      <div class="container">
        <div class="carousel-caption">
          <h1>Example headline.</h1>
          <p>Note: If you're viewing this page via a <code>file://</code> URL, the "next" and "previous" Glyphicon buttons on the left and right might not load/display properly due to web browser security rules.</p>
          <p><a class="btn btn-lg btn-primary" href="register.php" role="button">Sign up today</a></p>
        </div>
      </div>
    </div>
    <div class="item">
      <img class="second-slide" src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" alt="Second slide">
      <div class="container">
        <div class="carousel-caption">
          <h1>Another example headline.</h1>
          <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
          <p><a class="btn btn-lg btn-primary" href="#" role="button">Learn more</a></p>
        </div>
      </div>
    </div>
    <div class="item">
      <img class="third-slide" src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" alt="Third slide">
      <div class="container">
        <div class="carousel-caption">
          <h1>One more for good measure.</h1>
          <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
          <p><a class="btn btn-lg btn-primary" href="#" role="button">Browse gallery</a></p>
        </div>
      </div>
    </div>
  </div>
  <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div><!-- /.carousel -->




<script type="text/javascript">
	document.querySelector("#home").classList.add("active");
	<?php 
	if($_SESSION['type'] == 'user' || $_SESSION['type'] == 'admin') {
		$name = $_SESSION['name'] ;
	?>
		document.getElementById("sign").innerHTML = "Hi, <?php echo $name ?>";
		document.getElementById("cartbadge").innerHTML = "<?php echo $_SESSION['badge']?>";
	<?php
	} else {
	?> 
		document.getElementById("log").innerHTML = "</span><a href='login.php'><span class='glyphicon glyphicon-user'> Signin</a>";
	<?php
	}
	?>
</script>

<?php

// print_r($_SESSION);	

require("footer.php");
?>