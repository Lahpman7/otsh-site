<!DOCTYPE html>
<?php
    session_start();
	require_once("./app/init.php");
	$googleClient = new Google_Client;
	$auth = new GoogleAuth($googleClient);
?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="assets/img/osLogo.ico">

    <title>OtterShare</title>

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/font-awesome.min.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <!-- Static navbarr -->
    <div class="navbar navbar-default navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="./index.php">Home</a>
          <?php if(isset($_SESSION['displayName'])){echo '<a class="navbar-brand" href="./pages/matcher.php">Match</a>';}?>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>
	<div id="headerwrap">
	    <div id = "zoom" class="container">
			<div class="row">
				<div class="col-lg-6 col-lg-offset-3">
					<h4>Welcome to</h4>
					<h1>Otter Share</h1>
					<h4>A new solution for driving to and parking at CSUMB</h4>
				</div>
			</div>
	    </div> <!-- /container -->
	</div>
	<div id="social" style="background:#585656">
		<div class="container">
			<div class="row centered">
			    <div class="col-md-4"></div>
				<div class="col-md-4" style="color:#ebe8e8">
				<?php if(!isset($_SESSION['emails'])): ?>
				<a href = "./pages/googleAuth.php">Sign in with Google!</a>
				<?php else: ?>
				<img src = "<?php echo $_SESSION['profile_image_url']; ?>">
				<?php $name = explode(' ',$_SESSION['displayName']);
				echo "<br> Hey <b>". $name[0] . "</b> would you like to <a href ='./pages/logout.php'>Sign out ?</a>";?>

				<?php endif; ?>
				</div>
			</div>
		</div>
	</div>

	<div id="footerwrap">
		<div class="container">
			<div class="row centered">
				<div class="col-lg-4">
					<p><b>Pionered by Mason Lopez.</b></p>
				</div>

				<div class="col-lg-4">
					<img src = "assets/img/osLogo.png">

				</div>
				<div class="col-lg-4">
					<p>Bugs? E-mail: maslopez@csumb.edu</p>
				</div>
			</div>
		</div>
	</div>

    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
  </body>
</html>
