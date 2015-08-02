<?php

  $social = array();
  $social['title'] = "My Listmas";
  $social['description'] = "Create, Publish and Share your #wishlist with Listmas.";
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
        <meta name="twitter:app:name:ipad" content="Listmas">
        <meta name="twitter:app:id:ipad" content="935516617">
        <meta name="twitter:app:name:googleplay" content="Listmas">
        <meta name="twitter:app:id:googleplay" content="com.greenzeta.listmas">

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
            <a href="https://twitter.com/home?status=<?=urlencode($social['description'])?>:%20<?=urlencode($social['link'])?>" class="fa fa-twitter" target="_blank"></a>
            <a href="https://plus.google.com/share?url=<?=urlencode($social['link'])?>" class="fa fa-google-plus" target="_blank"></a>
            <a href="https://pinterest.com/pin/create/button/?url=<?=urlencode($social['link'])?>&media=http://www.mylistmas.com/icons/icon_512.png&description=<?=urlencode($social['description'])?>" class="fa fa-pinterest" target="_blank"></a>
            <a href="https://www.facebook.com/dialog/feed?app_id=360989144063992&link=<?=urlencode($social['link'])?>&picture=<?=urlencode($social['image'])?>&name=<?=urlencode($social['title'])?>&message=&description=<?=urlencode($social['description'])?>&redirect_uri=https://facebook.com/" class="fa fa-facebook" target="_blank"></a>
          </div>
        </div>

        <div id="head" class="container">
          <div class="content">
            <div class="col1">&nbsp;</div>
            <div class="col6 colcon">
              <div id="logo">
                <img src="images/logo.png" width="50%" height="50%"/>
                <span>LISTMAS</span>
              </div>
              <!--<h3>Coming soon to Apple iOS</h3>-->
              <div class="storelinks">
                <a id="" style="" href="https://play.google.com/store/apps/details?id=com.greenzeta.listmas" target="_blank" onclick="ga('send', 'event', 'web', 'click', 'googleplay', 0);"><img src="images/playstore.png" style=""/></a>
                <a id="" style="" href="https://itunes.apple.com/WebObjects/MZStore.woa/wa/viewSoftware?id=935516617&mt=8" target="_blank" onclick="ga('send', 'event', 'web', 'click', 'applestore', 0);"><img src="images/appstore.png" style=""/></a>
                <a id="" style="" href="http://www.amazon.com/GreenZeta-Listmas/dp/B00PE4ZJV2/?tag=listmas04-20" target="_blank" onclick="ga('send', 'event', 'web', 'click', 'amazonappstore', 0);"><img src="images/amazonstore.png" style=""/></a>
              </div>
              <div style="clear:both;"></div>
              <!--<p class="sample">
                <a href="http://www.mylistmas.com/l/V1FxbDL0CuCAbgdcdD4t4Q">View A Sample List</a>
            </p>-->
              <p>
                  <a href="#create">Create</a> your wishlist. <a href="#publish">Publish</a> it to mylistmas.com. <a href="#share">Share</a> your unique url with whomever you choose.
              </p>
              <p>
                  Listmas was made with privacy in mind. There is no login, no email address required, no personal information is collected. Lists are managed entirely in your smartphone or tablet. When you publish your list to mylistmas.com, only the information you have entered in your list is sent. You receive a unique url to use however you wish. Share your list with family and friends or post it on social networks for the world to see.
              </p>
              <p>
                  Scroll down to see all the features...
              </p>
            </div>
            <div class="col1 screenshot">&nbsp;</div>
            <div class="col3 colcon screenshot" style="text-align: center;">
              <img id="screenshot" src="images/screenshot.png"/>
            </div>
            <div class="col1 screenshot">&nbsp;</div>
          </div>
        </div>

        <div class="clearfix"></div>

        <div class="ground scenery">
          <?php for($idx = 0; $idx < 10; $idx++): ?>
          <img class="tree" src="images/bkg_tree.png" style="top:<?=mt_rand ( 20 , 80 )?>px; left:<?=((10*$idx)+mt_rand ( 0 , 9 ))?>%;"/>
          <?php endfor; ?>
        </div>

        <div id="create" name="create" class="container">
            <div class="content">
                <div class="col3"></div>
                <div class="col9">
                    <h1>Create</h1>
                </div>
            </div>
            <div class="content">
                <div class="col7">
                    <h2>Lists</h2>
                </div>
            </div>
            <div class="content">
                <div class="col7">
                    <img src="./images/list.png">
                </div>
                <div class="col3">
                    <h3>As many as you like.</h3>
                </div>
                <div class="col2"></div>
            </div>

            <div class="content">
                <div class="col7">
                    <h2>Photograph</h2>
                </div>
            </div>
            <div class="content">
                <div class="col7">
                    <img src="./images/photograph.jpg">
                </div>
                <div class="col3">
                    <h3>Exactly what you want.</h3>
                </div>
                <div class="col2"></div>
            </div>

            <div class="content">
                <div class="col7">
                    <h2>Scan</h2>
                </div>
            </div>
            <div class="content">
                <div class="col7">
                    <img src="./images/scan.jpg">
                </div>
                <div class="col3">
                    <h3>Build your list while you're out.</h3>
                </div>
                <div class="col2"></div>
            </div>

            <div class="content proh">
                <div class="col7">
                    <h2>Link</h2>
                </div>
            </div>
            <div class="content pro">
                <div class="col7">
                    <img src="./images/link.jpg">
                </div>
                <div class="col3">
                    <h3>Add any item from the web.</h3>
                </div>
                <div class="col2"></div>
            </div>

            <div class="content">
                <div class="col7">
                    <h2>Search</h2>
                </div>
            </div>
            <div class="content">
                <div class="col7">
                    <img src="./images/search.jpg">
                </div>
                <div class="col3">
                    <h3>Find products by name.</h3>
                </div>
                <div class="col2"></div>
            </div>

            <div class="content proh">
                <div class="col7">
                    <h2>Rank</h2>
                </div>
                <div class="col5 subhead">
                    <h2><a href="#fullversion">(Full Version Only)</a>&nbsp;</h2>
                </div>
            </div>
            <div class="content pro">
                <div class="col7">
                    <img src="./images/rank.png">
                </div>
                <div class="col3">
                    <h3>Put the stuff you really want on top.</h3>
                </div>
                <div class="col2"></div>
            </div>
        </div>


        <div id="publish" class="container">
            <div class="content">
                <div class="col3"></div>
                <div class="col9">
                    <h1>Publish</h1>
                </div>
            </div>
            <div class="content">
                <div class="col7">
                    <h2>Webpage</h2>
                </div>
            </div>
            <div class="content">
                <div class="col7">
                    <img src="./images/webpage.png">
                </div>
                <div class="col3">
                    <h3>Get a unique url on the web.</h3>
                </div>
                <div class="col2"></div>
            </div>

            <div class="content proh">
                <div class="col7">
                    <h2>Theme</h2>
                </div>
                <div class="col5 subhead">
                    <h2><a href="#fullversion">(Full Version Only)</a>&nbsp;</h2>
                </div>
            </div>
            <div class="content pro">
                <div class="col7">
                    <img src="./images/themes.jpg">
                </div>
                <div class="col3">
                    <h3>A variety of visual styles to choose from.</h3>
                </div>
                <div class="col2"></div>
            </div>

            <div class="content proh">
                <div class="col7">
                    <h2>Notification</h2>
                </div>
                <div class="col5 subhead">
                    <h2><a href="#fullversion">(Full Version Only)</a>&nbsp;</h2>
                </div>
            </div>
            <div class="content pro">
                <div class="col7">
                    <img src="./images/notification.jpg">
                </div>
                <div class="col3">
                    <h3>Viewers check off items on your list.</h3>
                </div>
                <div class="col2"></div>
            </div>

            <div class="content proh">
                <div class="col7">
                    <h2>Transfer</h2>
                </div>
                <div class="col5 subhead">
                    <h2><a href="#fullversion">(Full Version Only)</a>&nbsp;</h2>
                </div>
            </div>
            <div class="content pro">
                <div class="col7">
                    <img src="./images/transfer.png">
                </div>
                <div class="col3">
                    <h3>Keep your list when you change devices.</h3>
                </div>
                <div class="col2"></div>
            </div>
        </div>


        <div id="share" class="container">
            <div class="content">
                <div class="col3"></div>
                <div class="col9">
                    <h1>Share</h1>
                </div>
            </div>
            <div class="content">
                <div class="col7">
                    <h2>Email</h2>
                </div>
            </div>
            <div class="content">
                <div class="col7">
                    <img src="./images/email.png">
                </div>
                <div class="col3">
                    <h3>Privately email your list to family and friends.</h3>
                </div>
                <div class="col2"></div>
            </div>

            <div class="content">
                <div class="col7">
                    <h2>Social</h2>
                </div>
            </div>
            <div class="content">
                <div class="col7">
                    <img src="./images/social.jpg">
                </div>
                <div class="col3">
                    <h3>Share your list on public sites.</h3>
                </div>
                <div class="col2"></div>
            </div>

            <div class="content">
                <div class="col7">
                    <h2>URL</h2>
                </div>
            </div>
            <div class="content">
                <div class="col7">
                    <img src="./images/url.png">
                </div>
                <div class="col3">
                    <h3>Send your list url out any way you wish.</h3>
                </div>
                <div class="col2"></div>
            </div>
        </div>

        <div id="fullversion" name="fullversion" class="container">
            <div class="content">
                <div class="col12">
                    <h2>* Some features require a one-time in app purchase.</h2>
                </div>
            </div>
            <div class="content">
                <div class="col12">
                    <div class="storelinks">
                      <a id="" style="" href="https://play.google.com/store/apps/details?id=com.greenzeta.listmas" target="_blank" onclick="ga('send', 'event', 'web', 'click', 'googleplay', 0);"><img src="images/playstore.png" style=""/></a>
                      <a id="" style="" href="https://itunes.apple.com/WebObjects/MZStore.woa/wa/viewSoftware?id=935516617&mt=8" target="_blank" onclick="ga('send', 'event', 'web', 'click', 'applestore', 0);"><img src="images/appstore.png" style=""/></a>
                      <a id="" style="" href="http://www.amazon.com/GreenZeta-Listmas/dp/B00PE4ZJV2/?tag=listmas04-20" target="_blank" onclick="ga('send', 'event', 'web', 'click', 'amazonappstore', 0);"><img src="images/amazonstore.png" style=""/></a>
                    </div>
                </div>
            </div>

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
		  _gaq.push(['_setAccount', '<?php if($_SERVER["HTTP_HOST"] != "gibson.loc"): ?>UA-76054-30<?php endif; ?>']);
		  _gaq.push(['_trackPageview']);

		  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

		  ga('create', '<?php if($_SERVER["HTTP_HOST"] != "gibson.loc"): ?>UA-76054-30<?php endif; ?>', 'auto');
		  ga('send', 'pageview');

		</script>

    <div id="fb-root"></div>

    </body>
</html>
