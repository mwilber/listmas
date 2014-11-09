<?php

  $social = array();
  $social['title'] = "My Listmas";
  $social['description'] = "Create and share your holiday wishlist with Listmas.";
  $social['image'] = "http://www.mylistmas.com/icons/icon_256.png";
  $social['link'] = "http://www.mylistmas.com/";

?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
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
        <!--<meta name="twitter:card" content="summary">
        <meta name="twitter:site" content="@greenzeta">
        <meta name="twitter:title" content="<?=$social['title']?>">
        <meta name="twitter:description" content="<?=$social['description']?>">
        <meta name="twitter:creator" content="@greenzeta">
        <meta name="twitter:image:src" content="<?=$social['image']?>">
        <meta name="twitter:domain" content="mylistmas.com">-->

        <meta name="twitter:card" content="app">
        <meta name="twitter:description" content="<?=$social['description']?>">
        <meta name="twitter:app:country" content="US">
        <meta name="twitter:app:name:iphone" content="Listmas">
        <meta name="twitter:app:id:iphone" content="935516617">
        <meta name="twitter:app:url:iphone" content="https://itunes.apple.com/WebObjects/MZStore.woa/wa/viewSoftware?id=935516617&mt=8">
        <meta name="twitter:app:name:ipad" content="Listmas">
        <meta name="twitter:app:id:ipad" content="935516617">
        <meta name="twitter:app:url:ipad" content="https://itunes.apple.com/WebObjects/MZStore.woa/wa/viewSoftware?id=935516617&mt=8">
        <meta name="twitter:app:name:googleplay" content="Listmas">
        <meta name="twitter:app:id:googleplay" content="com.greenzeta.listmas">
        <meta name="twitter:app:url:googleplay" content="https://play.google.com/store/apps/details?id=com.greenzeta.listmas">

        <meta name="viewport" content="width=device-width">
        <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
        <link rel="icon" href="/favicon.ico" type="image/x-icon">
        <link rel="stylesheet" href="css/normalize.min.css">
        <link rel="stylesheet" href="css/index.css">
        <link rel="stylesheet" type="text/css" media="all" href="css/responsiveboilerplate.css">
        <link href='http://fonts.googleapis.com/css?family=Life+Savers:700|Open+Sans:400,800,700' rel='stylesheet' type='text/css'>
        <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    		<!-- HTML5 IE Enabling Script -->
    		<!--[if lt IE 9]>
    		<script src="js/vendor/html5shiv.min.js"></script>
    		<![endif]-->

        <script src="js/vendor/modernizr-2.6.2.min.js"></script>
    </head>
    <body>
        <!--[if lt IE 7]>
            <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
        <![endif]-->
        <!--<div id="background">-->
          <div class="clouds scenery">
            <div class="clouds">
              <div class="clouds"></div>
            </div>
          </div>

        <!--</div>-->

        <div class="header">
          <div class="sociallinks">
            <a href="https://twitter.com/home?status=Create%20and%20share%20your%20holiday%20wish%20list%20with%20Listmas:%20http://www.mylistmas.com" class="fa fa-twitter" target="_blank"></a>
            <a href="https://plus.google.com/share?url=http://www.mylistmas.com" class="fa fa-google-plus" target="_blank"></a>
            <a href="https://pinterest.com/pin/create/button/?url=http://www.mylistmas.com&media=http://www.mylistmas.com/icons/icon_512.png&description=Create%20and%20share%20your%20holiday%20wish%20list%20with%20Listmas." class="fa fa-pinterest" target="_blank"></a>
            <a href="https://www.facebook.com/dialog/feed?app_id=360989144063992&link=<?=$social['link']?>&picture=<?=$social['image']?>&name=<?=$social['title']?>&message=&description=<?=$social['description']?>&redirect_uri=https://facebook.com/" class="fa fa-facebook" target="_blank"></a>
          </div>
        </div>

        <div class="container">
          <div class="content">
            <div class="col1">&nbsp;</div>
            <div class="col6 colcon">
              <div id="logo">
                <img src="images/logo.png" width="50%" height="50%"/>
                <span>LISTMAS</span>
              </div>
              <p class="sample">
                <a href="http://www.mylistmas.com/l/V1FxbDL0CuCAbgdcdD4t4Q">View A Sample List</a>
              </p>
              <p>
                Listmas is a fun way to create holiday wish lists for yourself and loved ones. Add items to your list by taking a photograph, scanning a UPC barcode, or searching amazon.com. Items added via search or barcode are automatically linked to their amazon.com product page. When your list is ready, share it on the web with family and friends. Add more items and re-publish your list at any time.
              </p>
              <p>
                Listmas stores only information you enter in your list, it does not gather any personally identifiable information. Your lists are as private or public as you choose. Published lists receive a unique url which can be shared via email or social networks. Create a private list for a few family members, or have the world shower you with gifts. It’s up to you.
              </p>
              <!--<h3>Coming soon to Apple iOS</h3>-->
              <div class="storelinks">
                <a id="" style="" href="https://play.google.com/store/apps/details?id=com.greenzeta.listmas" target="_blank" onclick="ga('send', 'event', 'web', 'click', 'googleplay', 0);"><img src="images/playstore.png" style=""/></a>
                <a id="" style="" href="https://itunes.apple.com/WebObjects/MZStore.woa/wa/viewSoftware?id=935516617&mt=8" target="_blank" onclick="ga('send', 'event', 'web', 'click', 'applestore', 0);"><img src="images/appstore.png" style=""/></a>
                <a id="" style="" href="http://www.amazon.com/GreenZeta-Listmas/dp/B00PE4ZJV2/?tag=listmas04-20" target="_blank" onclick="ga('send', 'event', 'web', 'click', 'amazonappstore', 0);"><img src="images/amazonstore.png" style=""/></a>
              </div>
            </div>
            <div class="col1">&nbsp;</div>
            <div class="col3 colcon" style="text-align: center;">
              <img id="screenshot" src="images/screenshot.png"/>
            </div>
            <div class="col1">&nbsp;</div>
          </div>
        </div>

        <div class="clearfix"></div>

        <div class="ground scenery">
          <?php for($idx = 0; $idx < 10; $idx++): ?>
          <img class="tree" src="images/bkg_tree.png" style="top:<?=mt_rand ( 20 , 80 )?>px; left:<?=((10*$idx)+mt_rand ( 0 , 9 ))?>%;"/>
          <?php endfor; ?>
        </div>

        <div id="footer">
              <a href="policy.php" onclick="ga('send', 'event', 'web', 'click', 'policy', 0);" class="policy">
            Privacy Policy
          </a>
              <a href="#" onclick="window.open('http://www.greenzeta.com/home/listing/product', '_system'); ga('send', 'event', 'web', 'click', 'GreenZeta', 0); return false;" class="gz">
            <span class="badge">&zeta;</span>
            &nbsp;&nbsp;A GreenZeta Production
          </a>
        </div>

        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.9.1.min.js"><\/script>')</script>

        <script src="js/plugins.js"></script>
        <script src="js/main.js"></script>

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

    <div id="fb-root"></div>

    </body>
</html>
