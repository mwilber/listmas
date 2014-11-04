<?php

	$listTitle = "My Listmas";

	$social = array();
	$social['title'] = "My Listmas";
	$social['description'] = "";
	$social['image'] = "http://www.mylistmas.com/img/fb_icon.png";
	$social['link'] = "http://www.mylistmas.com/";

	if(isset($_GET['l'])){
		define('BASEPATH', str_replace('\\', '/', $system_path));
		include('reactor/application/config/constants.php');
		include('reactor/application/config/database.php');
		include('reactor/application/helpers/idobfuscator_helper.php');

		if( !is_numeric($_GET['l']) ) $_GET['l'] = IdObfuscator::decode($_GET['l']);

		try {
		    $dbh = new PDO("mysql:host=".$db['default']['hostname'].";dbname=".$db['default']['database'], $db['default']['username'], $db['default']['password']);
		    /*** echo a message saying we have connected ***/
		    //echo 'Connected to database';
		    }
		catch(PDOException $e)
		    {
		    echo $e->getMessage();
		    }

		$stmt = $dbh->prepare("SELECT shoplistName FROM tblShoplist WHERE shoplistId=".$_GET['l']);
		$stmt->execute();
		if( $stmt->rowCount() <= 0 ){
			//
			$rootpg = (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . "/";
			if( $_SERVER['HTTP_HOST'] == "gibson.loc" ){
				$rootpg .= "listmas/";
			}
			header("Location: ".$rootpg);
			//print_r($rootpg);
			die();
		}else{
			$titleRS = $stmt->fetch();
			//print_r($titleRS['shoplistName']);
			$social['title'] = "My Listmas - ".$titleRS['shoplistName'];
			$listTitle = $titleRS['shoplistName'];

			$sql = "SELECT * FROM tblProdlist JOIN tblShoplist ON tblProdlist.shoplistId=tblShoplist.shoplistId JOIN tblProd ON tblProdlist.prodId=tblProd.prodId WHERE tblProdlist.shoplistId=".$_GET['l'];
			$listRS = $dbh->query($sql);

			$dbh = null;
		}
	}

?>
<!DOCTYPE html>
<html>
    <head>
	    <meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

		<title><?=$social['title']?></title>
		<meta name="description" content="<?=$social['description']?>">
		<meta name="author" content="Matthew Wilber">
		<meta property="og:title" content="<?=$social['title']?>" />
		<meta property="og:type" content="website" />
		<meta property="og:url" content="<?=$social['link']?>" />
		<meta property="og:image" content="<?=$social['image']?>" />
		<meta property="og:site_name" content="<?=$social['title']?>" />
		<meta property="fb:admins" content="631337813" />
		<meta property="og:description" content="<?=$social['description']?>" />


		<!-- Twitter Summary Card -->
		<meta name="twitter:card" content="summary">
		<meta name="twitter:site" content="@greenzeta">
		<meta name="twitter:title" content="<?=$social['title']?>">
		<meta name="twitter:description" content="<?=$social['description']?>">
		<meta name="twitter:creator" content="@tpiapp">
		<meta name="twitter:image:src" content="<?=$social['image']?>">
		<meta name="twitter:domain" content="mylistmas.com">

    <meta name="viewport" content="user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1, target-densitydpi=device-dpi" />
		<link href='fonts/opensans_regular_macroman/stylesheet.css' rel='stylesheet' type='text/css'>
		<link href='fonts/opensans_bold_macroman' rel='stylesheet' type='text/css'>
		<link type="text/css" href="css/jquery.jscrollpane.css" rel="stylesheet" media="all" />
        <link rel="stylesheet" href="css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="css/list.css" />
        <link rel="stylesheet" type="text/css" href="css/color.css" />
        <title>My Listmas : $titleRS['shoplistName']</title>

        <script type="text/javascript">
		var social = [];
			social['title'] = "<?=$social['title']?>";
			social['description'] = "<?=$social['description']?>";
			social['image'] = "<?=$social['image']?>";
			social['link'] = "<?=$social['link']?>";

		</script>
    </head>
    <body>
        <div id="header" class="header">
					<img id="logo" src="icons/icon_256.png" height="100%">
        	<a class="showapp fa fa-mobile-phone" style="" target="_blank"> <span style="font-size:18px;">Get the App!</span></a>
        	<!--<a class="showtweeter fa fa-twitter" href="#" onclick="window.open('http://www.twitter.com/tpiapp', '_system'); _gaq.push(['_trackEvent', 'External', 'Twitter', '']); return false;" style="right:200px;"> </a>
					<a class="showuserlocation fa fa-location-arrow" target="_blank"> </a>
					<a class="showinfo fa fa-info-circle" target="_blank"> </a>-->
        </div>


			<div id="home" class="panel" style="display:block;">
				<a class="info" href="/index.php"><span class="fa fa-info-circle"></span></a>
				<h1 class="name"><a href="/index.php"><img src="images/logo.png" height="75"/></a><br/><span class="dsk"><?=$listTitle?></span></h1>
				<!--<div class="header">
					<img id="homeview" src="img/homebanner.jpg"/>
					<a class="showapp fa fa-mobile-phone" style="right:75px; width: 200px;" target="_blank"> <span style="font-size:18px;">Get the App!</span></a>
					<a class="showuserprofile fa fa-user" target="_blank"> </a>
					<a class="showinfo fa fa-info-circle" target="_blank"> </a>
				</div>-->
				<div class="content">
					<?php if(isset($_GET['l'])): ?>
					<ul class="linearlist">
						<?php foreach( $listRS as $li): ?>
							<li onclick="ShowDetail(this)">
								<div>
									<div class="icon" style="background-image:url('<?=$li['prodPhoto']?>')"></div>
									<div class="prodname">
										<?=$li['prodName']?>
										<br/>
										<span class="description"><?=$li['prodDescription']?></span>
									</div>
									<?php if( $li['prodUrl'] != "" ): ?>
										<a href="<?=$li['prodUrl']?>" target="_blank" class="produrl button <?=( strpos($li['prodUrl'], "amazon") === false ) ? "info" : "buy" ?>">
											<span><?php if( strpos($li['prodUrl'], "amazon") === false ): ?>
											More Info
											<?php else: ?>
											Buy This
											<?php endif; ?>
											</span>
											<span class="fa fa-angle-right"></span>
										</a>
									<?php endif; ?>
								</div>
								<!--<a href="#" class="detail-btn fa fa-angle-down"></a>-->
							</li>
						<?php endforeach; ?>
					</ul>
					<?php endif; ?>
					<div class="clearfix"></div>
				</div>
			</div>

			<?php foreach( $listRS as $li): ?>

    <?php endforeach; ?>

		<div id="footer">
        	<a href="#" onclick="window.open('/policy.php', '_system'); _gaq.push(['_trackEvent', 'External', 'Privacy Policy', '']); return false;" class="policy">
				Privacy Policy
			</a>
        	<a href="#" onclick="window.open('http://www.greenzeta.com/home/listing/product', '_system'); _gaq.push(['_trackEvent', 'External', 'GreenZeta', '']); return false;" class="gz">
				<span class="badge">&zeta;</span>
				&nbsp;&nbsp;A GreenZeta Production
			</a>
        </div>

        <script type="text/javascript" src="js/jquery-1.10.1.min.js"></script>
        <script type="text/javascript" src="js/jquery.mousewheel.js"></script>
        <script type="text/javascript" src="js/jquery.jscrollpane.min.js"></script>
        <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?libraries=places&sensor=true"></script>
        <script type="text/javascript" src="js/socialshare.js"></script>
		<script type="text/javascript" src="js/util.js"></script>
        <script type="text/javascript" src="js/index.js"></script>

        <script type="text/javascript">

		  var _gaq = _gaq || [];
		  _gaq.push(['_setAccount', 'UA-76054-30']);
		  _gaq.push(['_trackPageview']);

		  (function() {
		    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
		    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
		    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
		  })();

		</script>
    </body>
</html>
