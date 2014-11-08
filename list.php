<?php

	$listTitle = "My Listmas";

	$social = array();
	$social['title'] = "My Listmas";
	$social['description'] = "Create and share your holiday wishlist with Listmas.";
	$social['image'] = "http://www.mylistmas.com/icons/icon_256.png";
	$social['link'] = "http://www.mylistmas.com/";

	if(isset($_GET['l'])){
		define('BASEPATH', str_replace('\\', '/', $system_path));
		include('reactor/application/config/constants.php');
		include('reactor/application/config/database.php');
		include('reactor/application/helpers/idobfuscator_helper.php');

		//
		if($_SERVER["HTTP_HOST"] == "gibson.loc"){
			if( !is_numeric($_GET['l']) ) $_GET['l'] = IdObfuscator::decode($_GET['l']);
		}else{
			$_GET['l'] = IdObfuscator::decode($_GET['l']);
		}

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
		<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
		<link rel="icon" href="/favicon.ico" type="image/x-icon">
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
			<!--<div id="background">-->
				<div class="clouds scenery">
					<div class="clouds">
						<div class="clouds"></div>
					</div>
				</div>

				<div class="pgheader">
						<div class="sociallinks">
							<a href="https://twitter.com/home?status=Create%20and%20share%20your%20holiday%20wish%20list%20with%20Listmas:%20http://www.mylistmas.com" class="fa fa-twitter" target="_blank"></a>
							<a href="https://plus.google.com/share?url=http://www.mylistmas.com" class="fa fa-google-plus" target="_blank"></a>
							<a href="https://pinterest.com/pin/create/button/?url=http://www.mylistmas.com&media=http://www.mylistmas.com/icons/icon_512.png&description=Create%20and%20share%20your%20holiday%20wish%20list%20with%20Listmas." class="fa fa-pinterest" target="_blank"></a>
							<a href="https://www.facebook.com/dialog/feed?app_id=360989144063992&link=<?=$social['link']?>&picture=<?=$social['image']?>&name=<?=$social['title']?>&message=&description=<?=$social['description']?>&redirect_uri=https://facebook.com/" class="fa fa-facebook" target="_blank"></a>
						</div>
				</div>

			<!--</div>-->
      <div id="header" class="header">
				<img id="logo" src="icons/icon_256.png" height="100%">
      	<a class="showapp fa fa-mobile-phone" style="" target="_blank"> <span style="font-size:18px;">Get the App!</span></a>
      </div>
			<div id="home" class="panel" style="display:block;">
				<a class="info" href="/index.php"><span class="fa fa-info-circle"></span></a>
				<h1 class="name"><a href="/index.php"><img src="images/logo.png" height="75"/></a><br/><span class="dsk"><?=$listTitle?></span></h1>
				<div class="content">
					<?php if(isset($_GET['l'])): ?>
					<ul class="linearlist">
						<?php foreach( $listRS as $li): ?>
							<li onclick="ShowDetail(this)">
								<div>
									<?php if( $li['prodUrl'] != "" ): ?>
										<a href="<?=$li['prodUrl']?>" target="_blank" class="produrl button <?=( strpos($li['prodUrl'], "amazon") === false ) ? "info" : "buy" ?>" onclick="ga('send', 'event', 'list', 'click', '<?=( strpos($li['prodUrl'], "amazon") === false ) ? "info" : "buy" ?>', 0);">
											<span><?php if( strpos($li['prodUrl'], "amazon") === false ): ?>
											More Info
											<?php else: ?>
											Buy This
											<?php endif; ?>
											</span>
											<span class="fa fa-angle-right"></span>
										</a>
									<?php endif; ?>
									<div class="icon" style="background-image:url('<?=$li['prodPhoto']?>')"></div>
									<div class="prodname">
										<?=$li['prodName']?>
										<br/>
										<span class="description"><?=$li['prodDescription']?></span>
									</div>
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

		<div class="clearfix"></div>

		<div class="ground scenery">
			<?php for($idx = 0; $idx < 10; $idx++): ?>
			<img class="tree" src="images/bkg_tree.png" style="top:<?=mt_rand ( 180 , 300 )?>px; left:<?=((10*$idx)+mt_rand ( 0 , 9 ))?>%;"/>
			<?php endfor; ?>
		</div>

		<div id="footer">
        	<a href="#" onclick="window.open('/policy.php', '_system'); ga('send', 'event', 'web', 'click', 'policy', 0); return false;" class="policy">
				Privacy Policy
			</a>
        	<a href="#" onclick="window.open('http://www.greenzeta.com/home/listing/product', '_system'); ga('send', 'event', 'web', 'click', 'GreenZeta', 0); return false;" class="gz">
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

		  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

		  ga('create', 'UA-76054-30', 'auto');
		  ga('send', 'pageview');

		</script>
    </body>
</html>
