<!DOCTYPE html>
<html lang="en">
<head>
<title>UAS WEB SERVICE</title>
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- bootstrap-css -->
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
<!--// bootstrap-css -->
<!-- css -->
<link rel="stylesheet" href="css/style.css" type="text/css" media="all" />
<!--// css -->
<!-- font-awesome icons -->
<link href="css/font-awesome.css" rel="stylesheet"> 
<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/bootstrap.js"></script>
<script src="js/SmoothScroll.min.js"></script>
<script type="text/javascript">
	jQuery(document).ready(function($) {
		$(".scroll").click(function(event){		
			event.preventDefault();
			$('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
		});
	});
</script>
<link href='css/immersive-slider.css' rel='stylesheet' type='text/css'>
<!-- pricing -->
<link rel="stylesheet" href="css/jquery.flipster.css">
<!-- //pricing -->
</head>
<body>
	<!-- //header-top -->
	<!-- header -->
	<div class="header">
			<div class="container">
				<nav class="navbar navbar-default">
					<!-- Brand and toggle get grouped for better mobile display -->
					<div class="navbar-header">
					  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					  </button>
						<div class="w3layouts-logo">
							<h1><a href="index.php">WEB <span>Status Mahasiswa</span></a></h1>
						</div>
					</div>

					<!-- Collect the nav links, forms, and other content for toggling -->
					<div class="collapse navbar-collapse nav-wil" id="bs-example-navbar-collapse-1">
						<nav>
							<ul class="nav navbar-nav">
								<li class="active"><a href="index.php">Home</a></li>
								<li><a href="about.php" class="hvr-sweep-to-bottom">About</a></li>
								<li><a href="#" class="hvr-sweep-to-bottom">Admin</a></li>
							</ul>
						</nav>
					</div>
					<!-- /.navbar-collapse -->
				</nav>
			</div>
	</div>
	<!-- //header -->
	<hr/>
	<div class="header">
			<div class="container">
				<nav class="navbar navbar-default">
				
					<form class="form-inline" method="get" action="">
					&nbsp;<span>NPM</span>: &nbsp;<input class="form-control1" type="text" name="npm">&nbsp; <button type="submit" class="btn2 btn-primary">CARI</button>
					</form>
				</nav>
			</div>
        </div>
         <?php 
            if($_GET){
            $SERVER = "192.168.1.4";
                $s_npm= isset($_GET['npm']) ? $_GET['npm'] : '';
                $url  = "http://$SERVER/web2/ws/web_service.php?API=1234&npm={$s_npm}";
                $fields = array(
                    'npm' => $s_npm,
                );
                $data = http_build_query($fields);
                $context = stream_context_create(array(
                    'http' =>  array(
                        'method'  => 'GET',
                        'header'  => 'Content-type: application/x-www-form-urlencoded',
                        'content' => $data,
                    )
                ));
                $result = file_get_contents($url, false, $context);
                //decode json menjadi Array
                $vr = json_decode($result,true);
				// $vr masih berbentuk array
                echo "<table class='table table-striped'>";
                echo "<tr><th><h3><center>Status Mahasiswa Dengan NPM <b>".$s_npm."</b></h3></th></tr>";
				
                //kita foreach kan agar dapat menganbil nilai dari array [status]
                      foreach($vr as $dt){
                        echo "<tr><td><h1><center><b>".$dt['status']."</b></h1></td></tr>";
						
                }
                echo "</table>";
				
				//kondisi jika tanpa hasil
				if($result == "[]"){
					echo "<h1><b><center>TIDAK ADA DATA PADA NPM : ".$s_npm."</h1></b>";
				}else{
				}
				}
        ?>
</body>	
</html>