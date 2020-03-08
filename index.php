
<?php
  echo "<div class='container center'>";
if(isset($_GET['domain'])){
	 echo "<div class='panel panel-default'>";
 echo "<div class='panel-heading'>Results</div>";
echo "<div class='panel-body'>";
  if(empty($_GET['domain'])){
printf("<pre>Please enter a domain.</pre>");
  }else
include 'check.php';
echo "</div>";
echo "</div>";
echo "</div>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta content="IE=edge" http-equiv="X-UA-Compatible">
	<meta content="width=device-width, initial-scale=1" name="viewport">
	<meta content="" name="description">
	<meta content="" name="author">
	<title>SSL Checker</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/signin.css" rel="stylesheet">
</head>
<body>
	<div class="container">
		<form action="" method="GET" class="form-signin">
			<h2 class="form-signin-heading">SSL Checker</h2><label class="sr-only" for="domain">Domain</label> <input autofocus="" class="form-control" id="domain" name="domain" placeholder="Domain" required="" type="text"> <button class="btn btn-lg btn-primary btn-block" type="submit">Check</button>
		</form>
	</div>
	<div align="center">
		<button class="btn btn-primary btn-lg" data-target="#myModal" data-toggle="modal" type="button">API Usage</button>
	</div>
	<div aria-labelledby="myModalLabel" class="modal fade" id="myModal" role="dialog" tabindex="-1">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel">API Usage</h4>
				</div>
				<div class="modal-body">
					<p>Feel free to use my open API for domain SSL lookups. 
					<br><b>Single lookup example:</b> <code>https://srv.app/ssl/check.php?domain=google.com</code><br>
					<br>
					If you'd like to lookup multiple domains, please add commas after the domains. 
					<br><b>Multiple lookup example:</b> <code>https://srv.app/ssl/check.php?domain=google.com,apple.com,microsoft.com</code><br>
					<br>
					<b>NOTE:</b> My website has a limit of 3 domains per lookups.</p>
				</div>
				<div class="modal-footer">
					<button class="btn btn-default" data-dismiss="modal" type="button">Close</button>
				</div>
			</div>
		</div>
	</div>
	<div class="footer navbar-fixed-bottom">
		<div align="center">
			<p class="copyright text-muted">Copyright &copy; Martin Sundseth <?php echo date("Y"); ?>. All Rights Reserved</p>
		</div>
	</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js">
	</script>
	<script src="js/bootstrap.min.js">
	</script>
</body>
</html>
