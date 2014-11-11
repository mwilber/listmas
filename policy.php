<?php

  $social = array();
  $social['title'] = "Listmas";
  $social['description'] = "Make your holiday wishlist with Listmas.";
  $social['image'] = "http://www.mylistmas.com/images/icon_512.png";
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

        <meta name="viewport" content="width=device-width">
        <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
        <link rel="icon" href="/favicon.ico" type="image/x-icon">

        <link rel="stylesheet" href="css/normalize.min.css">
        <link rel="stylesheet" href="css/index.css">
        <link rel="stylesheet" type="text/css" media="all" href="css/responsiveboilerplate.css">
        <link href='http://fonts.googleapis.com/css?family=Life+Savers:700|Open+Sans:400,800,700' rel='stylesheet' type='text/css'>
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

        <div class="container">
          <div class="content">
            <div class="col2">&nbsp;</div>
            <div class="col8">
              <div id="logo">
                <img src="images/logo.png" width="50%" height="50%"/>
                <span>LISTMAS</span>
              </div>
              <h3 style="text-align:center;">Privacy Policy</h3>
              <p>
                Listmas stores only information you enter in your list. At no time will Listmas collect any personally identifiable information, unless you choose to enter that information as part of your list. Listmas does gather anonymous usage statistics for the purpose of tracking app use. These statistics do not contain any information about you or the contents of your list.
              </p>
              <p>
                <a href="index.php" style="color:#fff;">Return to the home page</a>
              </p>
            </div>
            <div class="col2">&nbsp;</div>
          </div>
        </div>

        <div class="clearfix"></div>

        <div class="ground scenery">
          <?php for($idx = 0; $idx < 10; $idx++): ?>
          <img class="tree" src="images/bkg_tree.png" style="top:<?=mt_rand ( 20 , 80 )?>px; left:<?=((10*$idx)+mt_rand ( 0 , 9 ))?>%;"/>
          <?php endfor; ?>
        </div>

        <div id="footer">
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