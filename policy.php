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

        <div id="footer">
              <a href="#" onclick="window.open('http://www.greenzeta.com/home/listing/product', '_system'); _gaq.push(['_trackEvent', 'External', 'GreenZeta', '']); return false;" class="gz">
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

      (function() {
        var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
      })();

    </script>

    <div id="fb-root"></div>
    <script>(function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=309846011404";
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>
    </body>
</html>
