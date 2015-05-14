<?php

	$listTitle = "My Listmas";
	$listUrl = "";
	$listEnhanced = 0;

	$social = array();
	$social['title'] = "Check Out My List";
	$social['description'] = "Make your #wishlist with Listmas";
	$social['image'] = "http://www.mylistmas.com/icons/icon_256.png";
	$social['link'] = "http://www.mylistmas.com".$_SERVER[REQUEST_URI];

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
		    $dbh = new PDO("mysql:host=".$db['default']['hostname'].";dbname=".$db['default']['database'].";charset=utf8", $db['default']['username'], $db['default']['password'],array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
		    /*** echo a message saying we have connected ***/
		    //echo 'Connected to database';
		    }
		catch(PDOException $e)
		    {
		    echo $e->getMessage();
		    }

		$stmt = $dbh->prepare("SELECT shoplistName,shopListCode,shopListEnhanced FROM tblShoplist WHERE shoplistId=".$_GET['l']);
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
			//print_r($titleRS);
			$pgTitle = "My Listmas :".$titleRS['shoplistName'];
			$listTitle = $titleRS['shoplistName'];
			$listUrl = $titleRS['shopListCode'];
			$listEnhanced = $titleRS['shopListEnhanced'];

			//echo "|".$listEnhanced."|";

			$sql = "SELECT * FROM tblProdlist JOIN tblShoplist ON tblProdlist.shoplistId=tblShoplist.shoplistId JOIN tblProd ON tblProdlist.prodId=tblProd.prodId LEFT JOIN tblNotify ON tblNotify.prodId=tblProdList.prodId WHERE tblProdlist.shoplistId=".$_GET['l'];
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

		<title><?=$pgTitle?></title>
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
		<meta name="twitter:title" content="My Listmas">
		<meta name="twitter:description" content="<?=$social['description']?>">
		<meta name="twitter:creator" content="@greenzeta">
		<meta name="twitter:image:src" content="<?=$social['image']?>">
		<meta name="twitter:domain" content="mylistmas.com">

		<!--<meta name="twitter:card" content="app">
		<meta name="twitter:description" content="<?=$social['description']?>">
		<meta name="twitter:app:country" content="US">
		<meta name="twitter:app:name:iphone" content="Listmas">
		<meta name="twitter:app:id:iphone" content="">
		<meta name="twitter:app:url:iphone" content="">
		<meta name="twitter:app:name:ipad" content="Cannonball">
		<meta name="twitter:app:id:ipad" content="">
		<meta name="twitter:app:url:ipad" content="">
		<meta name="twitter:app:name:googleplay" content="Listmas">
		<meta name="twitter:app:id:googleplay" content="com.greenzeta.listmas">
		<meta name="twitter:app:url:googleplay" content="https://play.google.com/store/apps/details?id=com.greenzeta.listmas">-->

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

			function NotifyBought(pUrl, pPid, pApid){
				$.post('../reactor/jsonapi/notify/bought/1',{
					shoplistUrl: pUrl,
					prodId: pPid,
					prodAppId: pApid
				},function(response){
					alert('notification sent');
				});
			}

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
						<a href="https://twitter.com/home?status=<?=urlencode($social['title'])?>:%20<?=urlencode($social['link'])?>%20<?=urlencode($social['description'])?>" class="fa fa-twitter" target="_blank"></a>
						<a href="https://plus.google.com/share?url=<?=urlencode($social['link'])?>" class="fa fa-google-plus" target="_blank"></a>
						<a href="https://pinterest.com/pin/create/button/?url=<?=urlencode($social['link'])?>&media=http://www.mylistmas.com/icons/icon_512.png&description=<?=urlencode($social['title'])?><?=urlencode('! ')?><?=urlencode($social['description'])?><?=urlencode('.')?>" class="fa fa-pinterest" target="_blank"></a>
						<a href="https://www.facebook.com/dialog/feed?app_id=360989144063992&link=<?=urlencode($social['link'])?>&picture=<?=urlencode($social['image'])?>&name=<?=urlencode($social['title'])?>&message=&description=<?=urlencode($social['description'])?>&redirect_uri=https://facebook.com/" class="fa fa-facebook" target="_blank"></a>
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
						<?php foreach( $listRS as $li): $snot = false; $sbuy = false; $sweb = false; $sbou = false; ?>
							<li>
								<div>
									<div class="rtblock">
										<?php if( $listEnhanced == 1 && $li['notifyType'] == 1 && $li['notifyRead'] == 0 ): $snot = true; ?>
										<a href="<?=$li['prodUrl']?>" target="_blank" class="produrl button gotit" onclick="ga('send', 'event', 'list', 'click', 'buy', 0);">
											Someone Got This
											<span class="fa fa-exclamation-triangle"></span>
										</a>
									<?php elseif( strpos($li['prodUrl'], "amazon") > 1 ): $sbuy = true; ?>
										<a href="<?=$li['prodUrl']?>" target="_blank" class="produrl button buy" onclick="ga('send', 'event', 'list', 'click', 'buy', 0);">
											Buy This
											<span class="fa fa-money"></span>
										</a>
									<?php elseif( $li['prodUrl'] != "" ): $sweb = true;?>
										<a href="<?=$li['prodUrl']?>" target="_blank" class="produrl button info" onclick="ga('send', 'event', 'list', 'click', 'info', 0);">
											Web Page
											<span class="fa fa-link"></span>
										</a>
									<?php elseif($listEnhanced == 1): $sbou = true;?>
										<a href="#" class="prodbought button" onclick="NotifyBought('<?=$listUrl?>',<?=$li['prodId']?>,<?=$li['prodAppId']?>); ga('send', 'event', 'notify', 'click', 'bought', 0); return false;">
											Bought It
											<span class="fa fa-thumbs-o-up"></span>
										</a>
										<?php endif; ?>
										<a href="#" class="prodbought button options" onclick="ShowDetail($(this).parent().parent().find('.detail-btn')); return false;">
											Options
											<span class="fa fa-bars"></span>
										</a>
										<div class="hiddenopts">
											<?php if( $li['prodUrl'] != "" ): ?>
												<?php if(!$sweb): ?>
												<a href="<?=$li['prodUrl']?>" target="_blank" class="produrl button info" onclick="ga('send', 'event', 'list', 'click', 'info', 0);">
													Web Page
													<span class="fa fa-link"></span>
												</a>
												<?php endif; ?>
												<?php if( strpos($li['prodUrl'], "amazon") > 1 && !$sbuy ): ?>
												<a href="<?=$li['prodUrl']?>" target="_blank" class="produrl button buy" onclick="ga('send', 'event', 'list', 'click', 'buy', 0);">
													Buy This
													<span class="fa fa-money"></span>
												</a>
												<?php endif; ?>
												<?php if($listEnhanced == 1 && !$sbou): ?>
												<a href="#" class="prodbought button" onclick="NotifyBought('<?=$listUrl?>',<?=$li['prodId']?>,<?=$li['prodAppId']?>); ga('send', 'event', 'notify', 'click', 'bought', 0); return false;">
													Bought It
													<span class="fa fa-thumbs-o-up"></span>
												</a>
												<?php endif; ?>
											<?php endif; ?>


										<div class="prodqr">
											<img src="https://chart.googleapis.com/chart?chs=200x200&cht=qr&chl=qr/<?=$li['prodId']?>&choe=UTF-8"/>
											<a href="/qr.php">Scan this QR code with the Listmas app to add this item to your own list. Click here for more information.</a>
										</div>
										</div>
									</div>
									<div class="ltblock" onclick="ShowDetail(this)">
										<div class="icon" style="background-image:url('<?=$li['prodPhoto']?>')"></div>
										<div class="prodname">
											<div>
											<?=$li['prodName']?>
											<br/>
											<span class="description"><?=$li['prodDescription']?></span>
											</div>
										</div>
									</div>
									<div class="detail-btn fa fa-angle-down" onclick="ShowDetail(this)"></div>
								</div>
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
			<img class="tree" src="images/bkg_tree.png" style="top:<?=mt_rand ( 160 , 250 )?>px; left:<?=((10*$idx)+mt_rand ( 0 , 9 ))?>%;"/>
			<?php endfor; ?>
			<img class="cabin" src="images/bkg_cabin.png" style="top:<?=mt_rand ( 45 , 55 )?>px; left:<?=((45)+mt_rand ( 0 , 9 ))?>%;"/>
			<img class="cabin" src="images/bkg_snowman.png" style="top:<?=mt_rand ( 355 , 375 )?>px; left:<?=mt_rand ( 5 , 45 )?>%;"/>
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
		  _gaq.push(['_setAccount', '<?php if($_SERVER["HTTP_HOST"] != "gibson.loc"): ?>UA-76054-30<?php endif; ?>']);
		  _gaq.push(['_trackPageview']);

		  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

		  ga('create', '<?php if($_SERVER["HTTP_HOST"] != "gibson.loc"): ?>UA-76054-30<?php endif; ?>', 'auto');
		  ga('send', 'pageview');

		</script>
    </body>
</html>
