<?php
	require 'config.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="WebTSS, an open-source SHSH management program for the web.">

    <title>WebTSS - Manage SHSH Blobs online</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/<?php echo $aGlobalConfig['interface']['theme']; ?>.bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <style>
    body {
        padding-top: 70px;
        /* Required padding for .navbar-fixed-top. Remove if using .navbar-static-top. Change if height of navigation changes. */
    }
    </style>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <a class="navbar-brand" href="<?php echo $aGlobalConfig['interface']['appURL']; ?>">WebTSS</a>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <!-- Page Content -->
    <div class="container">

        <div class="row">
        	<center>
        		<h1>Welcome to WebTSS</h1>
        		<hr/>
        	</center>
        	<div class="container">
        	<?php
        		if(!empty($_REQUEST['e'])) {
        			echo '
						<div class="alert alert-danger">
						  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						  <strong>Error:</strong> '.strip_tags($_REQUEST['e']).'
						</div>';
				}
			?>
				<div class="panel panel-default">
				  <div class="panel-heading">About WebTSS</div>
				  <div class="panel-body">
					<ul>
						<li>
							WebTSS is an <a href="https://github.com/gotkrypto76/WebTSS">open-source</a> SHSH blob management program for the web.
						</li>
						<li>
							WebTSS is licensed under the MIT license. <3
						</li>
						<li>
							WebTSS is made possible by <a href="https://reddit.com/r/GotKrypto76">/u/GotKrypto76</a>.
						</li>
						<li>
							For your convenience, WebTSS supports both hex and digit/decimal forms of your ECID.
						</li>
						<li>
							The first time you submit your information for to WebTSS blobs will be downloaded immediately. After that, the server will search for blobs on a regular basis depending on what the host has set.
						</li>
					</ul>
				  </div>
				</div>
			</div>
            <div class="col-md-12 col-lg-6 text-center">
			  <div class="panel panel-default">
				  <div class="panel-heading">Add a device</div>
				  <div class="panel-body">
				  <form action="addDevice.php" method="POST" class="form-horizontal">
					<div class="form-group">
					  <label class="control-label col-sm-2" for="ecid">ECID:</label>
					  <div class="col-sm-10">
						<input type="text" class="form-control" id="ecid" name="ecid" placeholder="Enter your ECID">
					  </div>
					</div>
					<div class="form-group">
					  <label class="control-label col-sm-2" for="platform">Platform:</label>
					  <div class="col-sm-10">          
						<input type="text" class="form-control" id="platform" name="platform" placeholder="Enter your device platform (Ex.: iPhone9,2)">
					  </div>
					</div>
					<?php
					if($aGlobalConfig['recaptcha']['enabled']) {
						echo '
							<div class="form-group">
							  <center>
								  <div class="g-recaptcha" data-sitekey="'.$aGlobalConfig['recaptcha']['siteKey'].'"></div>
							  </center>
							</div>';
					}
					?>
					<div class="form-group">        
					  <div class="col-sm-offset-2 col-sm-10">
						<button type="submit" class="btn btn-primary">Go</button>
					  </div>
					</div>
				  </form>
				</div>
				</div>
            </div>
            <div class="col-md-12 col-lg-6 text-center">
			  <div class="panel panel-default">
				  <div class="panel-heading">Find my blob link</div>
				  <div class="panel-body">
				  <form action="findBlobs.php" method="POST" class="form-horizontal">
					<div class="form-group">
					  <label class="control-label col-sm-2" for="ecid">ECID:</label>
					  <div class="col-sm-10">
						<input type="text" class="form-control" id="ecid" name="ecid" placeholder="Enter your ECID">
					  </div>
					</div>
					<div class="form-group">        
					  <div class="col-sm-offset-2 col-sm-10">
						<button type="submit" class="btn btn-default">Find</button>
					  </div>
					</div>
				  </form>
				</div>
				</div>
            </div>
        </div>
        <div class="container">
        	<center>
        		<small><a href="https://github.com/gotkrypto76/WebTSS">WebTSS</a> is copyright (c) 2016-<?php echo date("Y"); ?> <a href="https://github.com/gotkrypto76">GotKrypto76</a></small>
        		<br/>
        		<small>WebTSS is licensed under the MIT license.</small>
        	</center>
        </div>
        <!-- /.row -->

    </div>
    <!-- /.container -->

    <!-- jQuery Version 1.11.1 -->
    <script src="js/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
	<?php
	if($aGlobalConfig['recaptcha']['enabled']) {
		echo"<script src='https://www.google.com/recaptcha/api.js'></script>";
	}
	?>
</body>

</html>