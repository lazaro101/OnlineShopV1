<html>
<head>
  <title>Online Shop</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

  <script type="text/javascript" src="../bootstrap-3.3.7/assets/js/vendor/jquery.min.js"></script>
	<link rel="stylesheet" type="text/css" href="../bootstrap-3.3.7/dist/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="../bootstrap-3.3.7/dist/css/bootstrap.css.map">
	<link rel="stylesheet" type="text/css" href="../bootstrap-3.3.7/dist/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../bootstrap-3.3.7/dist/css/bootstrap.min.css.map">
	<link rel="stylesheet" type="text/css" href="../bootstrap-3.3.7/dist/css/bootstrap-theme.css">
	<link rel="stylesheet" type="text/css" href="../bootstrap-3.3.7/dist/css/bootstrap-theme.css.map">
	<link rel="stylesheet" type="text/css" href="../bootstrap-3.3.7/dist/css/bootstrap-theme.min.css">
	<link rel="stylesheet" type="text/css" href="../bootstrap-3.3.7/dist/css/bootstrap-theme.min.css.map">
	<script type="text/javascript" src="../bootstrap-3.3.7/dist/js/bootstrap.js"></script>
	<script type="text/javascript" src="../bootstrap-3.3.7/dist/js/bootstrap.min.js"></script>

	<script type="text/javascript" src="../bootstrap-3.3.7/js/affix.js"></script>
	<script type="text/javascript" src="../bootstrap-3.3.7/js/alert.js"></script>
	<script type="text/javascript" src="../bootstrap-3.3.7/js/button.js"></script>
	<script type="text/javascript" src="../bootstrap-3.3.7/js/carousel.js"></script>
	<script type="text/javascript" src="../bootstrap-3.3.7/js/collapse.js"></script>
	<script type="text/javascript" src="../bootstrap-3.3.7/js/dropdown.js"></script>
	<script type="text/javascript" src="../bootstrap-3.3.7/js/modal.js"></script>
	<script type="text/javascript" src="../bootstrap-3.3.7/js/popover.js"></script>
	<script type="text/javascript" src="../bootstrap-3.3.7/js/scrollspy.js"></script>
	<script type="text/javascript" src="../bootstrap-3.3.7/js/tab.js"></script>
	<script type="text/javascript" src="../bootstrap-3.3.7/js/tooltip.js"></script>
	<script type="text/javascript" src="../bootstrap-3.3.7/js/transition.js"></script>
	<style type="text/css">

	</style>
</head>
<body>

<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">Online Shop</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
    <ul class="nav navbar-nav">
        <li id="home"><a href="home.php">Home</a></li>
        <li id="catalog"><a href="catalog.php">Catalog</a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <?php if ($_SESSION['type'] != 'admin') {  
              echo '<li id="cart"><a href="cart.php"><span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span> Cart <span class="badge" id="cartbadge"></span></a></li>';
            }
      ?> 
      <li class="dropdown" id="log">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> <span id="sign">Sign in</span> <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <?php if ($_SESSION['type'] == 'admin') {
                    echo '<li id="basicinfo"><a href="../productList.php">Admin View</a></li>';
                  } else {
                    echo '<li id="orders"><a href="accountOrders.php">My Order</a></li><li id="basicinfo"><a href="accountBasicInfo.php">My Account</a></li>';
                  }
            ?> 
            
            <li role="separator" class="divider"></li>  
            <li><a href="logout.php">Log out</a></li>
          </ul>
        </li>
    </ul>
    <form class="navbar-form navbar-right">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Search">
        </div>
    </form>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>