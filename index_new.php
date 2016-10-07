<?php

  $social = array();
  $social['title'] = "My Listmas";
  $social['description'] = "Listmas was made with privacy in mind. No personal info is collected. Create, Publish and Share your #wishlist ";
  $social['image'] = "http://www.mylistmas.com/images/og_share.png";
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
        <link rel="stylesheet" href="css/jquery.fullPage.css">
        <link rel="stylesheet" href="css/index.css">
        <link rel="stylesheet" href="css/content.css">
        <link rel="stylesheet" href="css/create.css">
        <link rel="stylesheet" href="css/ground.css">
        <link rel="stylesheet" type="text/css" href="css/theme_summer.css" />
		<link rel="stylesheet" type="text/css" href="css/theme_birthday.css" />
		<link rel="stylesheet" type="text/css" href="css/theme_megalopolis.css" />
		<link rel="stylesheet" type="text/css" href="css/theme_space.css" />
		<link rel="stylesheet" type="text/css" href="css/theme_princess.css" />
		<link rel="stylesheet" type="text/css" href="css/theme_hohoho.css" />
        <link rel="stylesheet" type="text/css" media="all" href="css/responsiveboilerplate.css">
        <link href='//fonts.googleapis.com/css?family=Lato:400,300,700,900,100' rel='stylesheet' type='text/css'>
        <link href="//fonts.googleapis.com/css?family=Open+Sans:300,400,700,800" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Vollkorn:400,700" rel="stylesheet">
        <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
        
    		<!-- HTML5 IE Enabling Script -->
    		<!--[if lt IE 9]>
    		<script src="js/vendor/html5shiv.min.js"></script>
    		<![endif]-->

        <script src="js/vendor/modernizr-2.6.2-respond-1.1.0.min.js"></script>
		<!-- Facebook Pixel Code -->
		<script>
		!function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?
		n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;
		n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;
		t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,
		document,'script','//connect.facebook.net/en_US/fbevents.js');
		
		fbq('init', '446644782210734');
		fbq('track', "PageView");</script>
		<noscript><img height="1" width="1" style="display:none"
		src="https://www.facebook.com/tr?id=446644782210734&ev=PageView&noscript=1"
		/></noscript>
		<!-- End Facebook Pixel Code -->
    </head>
    <body>
        <!--[if lt IE 7]>
            <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
        <![endif]-->
        <!--<div id="background">-->
          <!--<div class="clouds scenery">
            <div class="clouds">
              <div class="clouds"></div>
            </div>
          </div>-->

        <!--</div>-->

        <div class="header">
            <div id="logo">
                <img src="images/logo.png"/>
                <span>LISTMAS</span>
            </div>
            <div class="sociallinks">
                <a href="https://twitter.com/home?status=<?=urlencode($social['description'])?>:%20<?=urlencode($social['link'])?>" class="fa fa-twitter" target="_blank"></a>
                <a href="https://plus.google.com/share?url=<?=urlencode($social['link'])?>" class="fa fa-google-plus" target="_blank"></a>
                <a href="https://pinterest.com/pin/create/button/?url=<?=urlencode($social['link'])?>&media=http://www.mylistmas.com/icons/icon_512.png&description=<?=urlencode($social['description'])?>" class="fa fa-pinterest" target="_blank"></a>
                <a href="https://www.facebook.com/dialog/feed?app_id=360989144063992&link=<?=urlencode($social['link'])?>&picture=<?=urlencode($social['image'])?>&name=<?=urlencode($social['title'])?>&message=&description=<?=urlencode($social['description'])?>&redirect_uri=https://facebook.com/" class="fa fa-facebook" target="_blank"></a>
            </div>
        </div>

        <div id="fullpage">

            <div id="head" name="info" class="container section info">
                <div class="content">
                    <div class="col1">&nbsp;</div>
                    <div class="col10 colcon">
                        <p class="copy-index">
                            <a href="#create">Create</a> your wishlist. 
                            <br/>
                            <a href="#publish">Publish</a> to mylistmas.com.
                            <br/>
                            <a href="#share">Share</a> your unique url.
                        </p>
                        <div class="storelinks">
                            <a id="" style="" href="https://play.google.com/store/apps/details?id=com.greenzeta.listmas" target="_blank" onclick="ga('send', 'event', 'web', 'click', 'googleplay', 0);"><img src="images/playstore.png" style=""/></a>
                            <a id="" style="" href="https://itunes.apple.com/WebObjects/MZStore.woa/wa/viewSoftware?id=935516617&mt=8" target="_blank" onclick="ga('send', 'event', 'web', 'click', 'applestore', 0);"><img src="images/appstore.png" style=""/></a>
                            <a id="" style="" href="http://www.amazon.com/GreenZeta-Listmas/dp/B00PE4ZJV2/?tag=listmas04-20" target="_blank" onclick="ga('send', 'event', 'web', 'click', 'amazonappstore', 0);"><img src="images/amazonstore.png" style=""/></a>
                        </div>
                    </div>
                    <!--<div class="col1">&nbsp;</div>
                    <div class="col4">
                        
                        <p>
                            Listmas was made with privacy in mind. There is no login, no email address required, no personal information is collected. Lists are managed entirely in your smartphone or tablet. When you publish your list to mylistmas.com, only the information you have entered in your list is sent. You receive a unique url to use however you wish. Share your list with family and friends or post it on social networks for the world to see.
                        </p>-->
                        <!--<p style="text-align:center; margin-bottom:40px;">
                            <a href="http://www.mylistmas.com/l/NEfnBif3nTDlHfl5H0Dc_Q" class="sample" target="_blank">Example List</a>
                        </p>
                    </div>-->
                    <div class="col1">&nbsp;</div>
                </div>
                <div class="ground scenery">
                    <div class="bkg one"></div>
                    <div class="bkg two"></div>
                    <div class="bkg three"></div>
                    <div class="bkg four"></div>
                    <div class="bkg five"></div>
                </div>
            </div>


            <div id="create" name="create" class="container section hohoho">
                <div class="content">
                    <div class="col1">&nbsp;</div>
                    <div class="col5">
                        <h2>Create</h2>
                        <p>
                            Listmas was made with anonymity in mind. There is no login, no personal information is collected. Lists are managed entirely in your smartphone or tablet. Choose a visual theme to personalize your list. <strong>Search</strong> online, <strong>Snap</strong> a photo, <strong>Scan</strong> a barcode, <strong>Link</strong> to a web page, or just type something in. Add some comments and rank your items. 
                        </p>
                    </div>
                    <div class="col1">&nbsp;</div>
                    <div class="col4">
                        <div class="create-frame">
                            <div id="create_00" class="create-shot"></div>
                            <div id="create_01" class="create-shot"></div>
                            <div id="create_02" class="create-shot"></div>
                            <div id="create_03" class="create-shot"></div>
                            <div id="create_04" class="create-shot"></div>
                            <div id="create_05" class="create-shot"></div>
                            <div id="create_06" class="create-shot"></div>
                        </div>
                    </div>
                    <div class="col1">&nbsp;</div>
                </div>
                <div class="ground scenery">
                    <div class="bkg one"></div>
                    <div class="bkg two"></div>
                    <div class="bkg three"></div>
                    <div class="bkg four"></div>
                    <div class="bkg five"></div>
                </div>
            </div>


            <div id="publish" name="publish" class="container section princess">
                <div class="content">
                    <div class="col1">&nbsp;</div>
                    <div class="col5 no-mobile">
                        <img src="images/publish_01.jpg" class="screenshot"/>
                    </div>
                    <div class="col5">
                        <h2>Publish</h2>
                        <p>
                             When you publish to mylistmas.com, only your list is sent. There is no persoanally identifable information added to your list. Receive a unique url to use however you wish.
                        </p>
                        <p style="text-align:center; margin-bottom:40px;">
                            <a href="http://www.mylistmas.com/l/NEfnBif3nTDlHfl5H0Dc_Q" class="sample" target="_blank">Example List</a>
                        </p>
                    </div>
                    <div class="col5 mobile">
                        <img src="images/publish_01.jpg" class="screenshot"/>
                    </div>
                    <div class="col1">&nbsp;</div>
                </div>
                <div class="ground scenery">
                    <div class="bkg one"></div>
                    <div class="bkg two"></div>
                    <div class="bkg three"></div>
                    <div class="bkg four"></div>
                    <div class="bkg five"></div>
                </div>
            </div>


            <div id="share" name="share" class="container section summer">
                <div class="content">
                    <div class="col2">&nbsp;</div>
                    <div class="col4 mooring">
                        <div class="floater">
                            <h2>Share</h2>
                            <p>
                                Lists are as public or private as you choose. Email your list to family and friends or post it on social networks for the world to see.
                            </p>
                        </div>
                    </div>
                    <div class="col6">
                        <img src="images/share_burst.png" class="screenshot"/>
                    </div>
                </div>
                <div class="ground scenery">
                    <div class="bkg one"></div>
                    <div class="bkg two"></div>
                    <div class="bkg three"></div>
                    <div class="bkg four"></div>
                    <div class="bkg five"></div>
                </div>
            </div>

            <div id="fullversion" name="download" class="container section space">
                <div class="content">
                    <div class="col12">
                        <div class="vizor">
                            <h2>Download</h2>
                            
                            <div class="storelinks">
                                <a id="" style="" href="https://play.google.com/store/apps/details?id=com.greenzeta.listmas" target="_blank" onclick="ga('send', 'event', 'web', 'click', 'googleplay', 0);"><img src="images/playstore.png" style=""/></a>
                                <a id="" style="" href="https://itunes.apple.com/WebObjects/MZStore.woa/wa/viewSoftware?id=935516617&mt=8" target="_blank" onclick="ga('send', 'event', 'web', 'click', 'applestore', 0);"><img src="images/appstore.png" style=""/></a>
                                <a id="" style="" href="http://www.amazon.com/GreenZeta-Listmas/dp/B00PE4ZJV2/?tag=listmas04-20" target="_blank" onclick="ga('send', 'event', 'web', 'click', 'amazonappstore', 0);"><img src="images/amazonstore.png" style=""/></a>
                            </div>
                            <p>* Additional themes require a one time in-app purchase.</p>
                        </div>
                    </div>
                </div>
                <div class="ground scenery">
                    <div class="bkg one"></div>
                    <div class="bkg two"></div>
                    <div class="bkg three"></div>
                    <div class="bkg four"></div>
                    <div class="bkg five"></div>
                </div>
            </div>

        </div>

        <div id="footer">
              <a href="policy.php" onclick="ga('send', 'event', 'web', 'click', 'policy', 0);" class="policy">
            Privacy Policy
          </a>
          <a id="gzlink" href="http://apps.greenzeta.com" target="_blank" style="display: block; position: fixed; bottom: 0px; right: 0px; margin: 0px; padding: 0px; height: auto; width: 40%; max-width: 300px; min-width: 200px;">
				<img alt="A GreenZeta Production" width="100%" src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz4NCjwhLS0gR2VuZXJhdG9yOiBBZG9iZSBJbGx1c3RyYXRvciAxNi4wLjAsIFNWRyBFeHBvcnQgUGx1Zy1JbiAuIFNWRyBWZXJzaW9uOiA2LjAwIEJ1aWxkIDApICAtLT4NCjwhRE9DVFlQRSBzdmcgUFVCTElDICItLy9XM0MvL0RURCBTVkcgMS4xLy9FTiIgImh0dHA6Ly93d3cudzMub3JnL0dyYXBoaWNzL1NWRy8xLjEvRFREL3N2ZzExLmR0ZCI+DQo8c3ZnIHZlcnNpb249IjEuMSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgeD0iMHB4IiB5PSIwcHgiIHdpZHRoPSIyMDBweCINCgkgaGVpZ2h0PSIzM3B4IiB2aWV3Qm94PSIwIDAgMjAwIDMzIiBlbmFibGUtYmFja2dyb3VuZD0ibmV3IDAgMCAyMDAgMzMiIHhtbDpzcGFjZT0icHJlc2VydmUiPg0KPGcgaWQ9IkxheWVyXzEiPg0KCTxyZWN0IG9wYWNpdHk9IjAuOCIgd2lkdGg9IjIwMCIgaGVpZ2h0PSIzMyIvPg0KCTxyZWN0IGZpbGw9IiM3Q0I3NTAiIHdpZHRoPSIzMyIgaGVpZ2h0PSIzMyIvPg0KPC9nPg0KPGcgaWQ9IkxheWVyXzQiPg0KCTxnPg0KCQk8cGF0aCBmaWxsPSIjRkZGRkZGIiBkPSJNMTUuMTg4LDcuNTkxYzAuODc1LTAuNjM4LDEuNjkzLTEuMTA1LDIuNDU0LTEuNDAxYzAuNzYxLTAuMjk2LDEuNTItMC40NDQsMi4yNzYtMC40NDQNCgkJCWMwLjYyOSwwLDEuMTAzLDAuMDg5LDEuNDIyLDAuMjY3YzAuMzE5LDAuMTc4LDAuNDc5LDAuNDQ0LDAuNDc5LDAuOGMwLDAuNTItMC4zNzIsMC45MzUtMS4xMTQsMS4yNDQNCgkJCWMtMC43NDMsMC4zMS0xLjc1MiwwLjQ2NS0zLjAyOCwwLjQ2NWMtMC40MTksMC0wLjgxMi0wLjAxMS0xLjE3Ni0wLjAzNGMtMC4zNjUtMC4wMjItMC43Mi0wLjA2Mi0xLjA2Ni0wLjExNg0KCQkJYy0wLjk1NywwLjg0OC0xLjcxNCwxLjk1My0yLjI3LDMuMzE1Yy0wLjU1NiwxLjM2My0wLjgzNCwyLjc5Ni0wLjgzNCw0LjNjMCwxLjU0LDAuMzUxLDIuNjUsMS4wNTMsMy4zMjkNCgkJCWMwLjcwMiwwLjY4LDEuODUsMS4wMTksMy40NDUsMS4wMTljMC4yNjQsMCwwLjY2NS0wLjAxOSwxLjIwMy0wLjA1NWMwLjUzOC0wLjAzNiwwLjk0My0wLjA1NSwxLjIxNy0wLjA1NQ0KCQkJYzEuMzg1LDAsMi40MDEsMC4yMzksMy4wNDksMC43MThjMC42NDcsMC40NzksMC45NzEsMS4yMjksMC45NzEsMi4yNDljMCwxLjM5NS0wLjU1OSwyLjQ3NS0xLjY3NSwzLjI0DQoJCQljLTEuMTE3LDAuNzY2LTIuNjk2LDEuMTQ4LTQuNzM3LDEuMTQ4Yy0wLjYxMSwwLTEuMDgtMC4wODctMS40MDgtMC4yNnMtMC40OTItMC40MTktMC40OTItMC43MzhjMC0wLjI5MiwwLjEwNy0wLjUxNSwwLjMyMS0wLjY3DQoJCQljMC4yMTQtMC4xNTUsMC41MjYtMC4yMzIsMC45MzctMC4yMzJjMC4yNzMsMCwwLjc1MiwwLjA5NCwxLjQzNiwwLjI4czEuMjcxLDAuMjgsMS43NjQsMC4yOGMwLjgyOSwwLDEuNTI2LTAuMjAzLDIuMDkyLTAuNjA4DQoJCQljMC41NjUtMC40MDUsMC44NDgtMC45MDQsMC44NDgtMS40OTdjMC0wLjUyLTAuMjI0LTAuODk2LTAuNjctMS4xMjhjLTAuNDQ3LTAuMjMyLTEuMTg1LTAuMzQ5LTIuMjE1LTAuMzQ5DQoJCQljLTAuMzY1LDAtMC44ODIsMC4wMTQtMS41NTIsMC4wNDFzLTEuMTUxLDAuMDQxLTEuNDQyLDAuMDQxYy0xLjg4NywwLTMuMjc0LTAuNDc5LTQuMTYzLTEuNDM2cy0xLjMzMy0yLjQ0Ny0xLjMzMy00LjQ3MQ0KCQkJYzAtMS42NjgsMC4yOTgtMy4yMTMsMC44OTYtNC42MzVjMC41OTctMS40MjIsMS40OTctMi43NDMsMi43LTMuOTY1Yy0xLjQ1OC0wLjMxLTIuNTY2LTAuNzI5LTMuMzIyLTEuMjU4DQoJCQljLTAuNzU3LTAuNTI4LTEuMTM1LTEuMTM1LTEuMTM1LTEuODE4YzAtMC43MjksMC4zNi0xLjI5NCwxLjA4LTEuNjk1YzAuNzItMC40MDEsMS43MzEtMC42MDIsMy4wMzUtMC42MDINCgkJCWMwLjI3MywwLDAuNDg3LDAuMDA5LDAuNjQzLDAuMDI3YzAuMTU1LDAuMDE5LDAuMzA1LDAuMDQ2LDAuNDUxLDAuMDgydjAuNjk3SDE0LjZjLTAuODEyLDAtMS40MTcsMC4xMzctMS44MTgsMC40MQ0KCQkJQzEyLjM4LDQuMzUxLDEyLjE4LDQuNzU2LDEyLjE4LDUuMjk0YzAsMC41NTYsMC4yNTUsMS4wMywwLjc2NiwxLjQyMkMxMy40NTYsNy4xMDgsMTQuMjAzLDcuMzk5LDE1LjE4OCw3LjU5MXoiLz4NCgk8L2c+DQoJPGc+DQoJCTxwYXRoIGZpbGw9IiNGRkZGRkYiIGQ9Ik00Ni40MjQsMTAuMDA3bDEuODgxLDEyLjY0OWgtMy4zNjFsLTAuMTc3LTIuMjczSDQzLjU5bC0wLjE5OCwyLjI3M2gtMy40bDEuNjc4LTEyLjY0OUg0Ni40MjR6DQoJCQkgTTQ0LjY4MSwxOC4xNDFjLTAuMTY3LTEuNDMzLTAuMzMzLTMuMjA0LTAuNTAxLTUuMzEzYy0wLjMzNSwyLjQyMi0wLjU0NSw0LjE5My0wLjYzMSw1LjMxM0g0NC42ODF6Ii8+DQoJCTxwYXRoIGZpbGw9IiNGRkZGRkYiIGQ9Ik01OS4yMywxNC42NjRoLTMuMjg5di0xLjE0OGMwLTAuNzI0LTAuMDMxLTEuMTc3LTAuMDk0LTEuMzU5Yy0wLjA2Mi0wLjE4Mi0wLjIxMS0wLjI3My0wLjQ0NS0wLjI3Mw0KCQkJYy0wLjIwMywwLTAuMzQxLDAuMDc4LTAuNDE0LDAuMjM0Yy0wLjA3MywwLjE1Ni0wLjEwOSwwLjU1OC0wLjEwOSwxLjIwM3Y2LjA3MWMwLDAuNTY3LDAuMDM2LDAuOTQxLDAuMTA5LDEuMTIxDQoJCQljMC4wNzMsMC4xOCwwLjIxOSwwLjI3LDAuNDM4LDAuMjdjMC4yMzksMCwwLjQwMi0wLjEwMiwwLjQ4OC0wLjMwNXMwLjEyOS0wLjYsMC4xMjktMS4xODh2LTEuNWgtMC42NjR2LTEuOTIyaDMuODUydjYuNzloLTIuMDY3DQoJCQlsLTAuMzA0LTAuOTA2Yy0wLjIyNCwwLjM5MS0wLjUwNywwLjY4NC0wLjg0OCwwLjg3OXMtMC43NDQsMC4yOTMtMS4yMDgsMC4yOTNjLTAuNTUzLDAtMS4wNy0wLjEzNS0xLjU1Mi0wLjQwMg0KCQkJYy0wLjQ4Mi0wLjI2OS0wLjg0OC0wLjYwMS0xLjA5OC0wLjk5NmMtMC4yNS0wLjM5Ni0wLjQwNy0wLjgxMi0wLjQ2OS0xLjI0NmMtMC4wNjItMC40MzYtMC4wOTQtMS4wODgtMC4wOTQtMS45NTd2LTMuNzU4DQoJCQljMC0xLjIwOCwwLjA2NS0yLjA4NiwwLjE5NS0yLjYzM2MwLjEzLTAuNTQ3LDAuNTA0LTEuMDQ4LDEuMTIxLTEuNTA0YzAuNjE3LTAuNDU2LDEuNDE1LTAuNjg0LDIuMzk1LTAuNjg0DQoJCQljMC45NjMsMCwxLjc2MywwLjE5OCwyLjM5OCwwLjU5NGMwLjYzNSwwLjM5NiwxLjA0OSwwLjg2NiwxLjI0MiwxLjQxYzAuMTkyLDAuNTQ0LDAuMjg5LDEuMzM1LDAuMjg5LDIuMzcxVjE0LjY2NHoiLz4NCgkJPHBhdGggZmlsbD0iI0ZGRkZGRiIgZD0iTTYzLjU2NiwxMi4yODlsLTAuMTI1LDEuMzYzYzAuNDU4LTAuOTc3LDEuMTIyLTEuNDkzLDEuOTkyLTEuNTUxdjMuNjQ4Yy0wLjU3OCwwLTEuMDAzLDAuMDc4LTEuMjczLDAuMjM0DQoJCQljLTAuMjcxLDAuMTU2LTAuNDM4LDAuMzc0LTAuNSwwLjY1MmMtMC4wNjIsMC4yNzktMC4wOTQsMC45Mi0wLjA5NCwxLjkyNnY0LjA5NEg2MC40MVYxMi4yODlINjMuNTY2eiIvPg0KCQk8cGF0aCBmaWxsPSIjRkZGRkZGIiBkPSJNNzMuMjg1LDE3LjY1NmgtNC4wODZ2Mi4yNDJjMCwwLjQ2OSwwLjAzNCwwLjc3MSwwLjEwMiwwLjkwNmMwLjA2NywwLjEzNSwwLjE5OCwwLjIwMywwLjM5MSwwLjIwMw0KCQkJYzAuMjM5LDAsMC4zOTktMC4wOSwwLjQ4LTAuMjdjMC4wODEtMC4xOCwwLjEyMS0wLjUyNywwLjEyMS0xLjA0M3YtMS4zNjdoMi45OTJ2MC43NjZjMCwwLjY0MS0wLjA0MSwxLjEzMy0wLjEyMSwxLjQ3Nw0KCQkJYy0wLjA4MSwwLjM0NC0wLjI3LDAuNzExLTAuNTY2LDEuMTAycy0wLjY3MywwLjY4NC0xLjEyOSwwLjg3OWMtMC40NTYsMC4xOTUtMS4wMjcsMC4yOTMtMS43MTUsMC4yOTMNCgkJCWMtMC42NjcsMC0xLjI1NS0wLjA5OC0xLjc2Ni0wLjI4OWMtMC41MTEtMC4xOTMtMC45MDgtMC40NTctMS4xOTEtMC43OTNjLTAuMjg0LTAuMzM2LTAuNDgtMC43MDYtMC41OS0xLjEwOQ0KCQkJYy0wLjEwOS0wLjQwNC0wLjE2NC0wLjk5MS0wLjE2NC0xLjc2MnYtMy4wMjRjMC0wLjkwNiwwLjEyMi0xLjYyMSwwLjM2Ny0yLjE0NWMwLjI0NS0wLjUyMywwLjY0Ni0wLjkyNCwxLjIwMy0xLjIwMw0KCQkJYzAuNTU3LTAuMjc4LDEuMTk4LTAuNDE4LDEuOTIyLTAuNDE4YzAuODg1LDAsMS42MTYsMC4xNjgsMi4xOTEsMC41MDRjMC41NzUsMC4zMzYsMC45NzksMC43ODEsMS4yMTEsMS4zMzYNCgkJCWMwLjIzMSwwLjU1NSwwLjM0OCwxLjMzNSwwLjM0OCwyLjM0VjE3LjY1NnogTTcwLjEyMSwxNS45NjhWMTUuMjFjMC0wLjUzNi0wLjAyOS0wLjg4My0wLjA4Ni0xLjAzOQ0KCQkJYy0wLjA1OC0wLjE1Ni0wLjE3NS0wLjIzNC0wLjM1Mi0wLjIzNGMtMC4yMTksMC0wLjM1NCwwLjA2Ni0wLjQwNiwwLjE5OWMtMC4wNTIsMC4xMzMtMC4wNzgsMC40OTEtMC4wNzgsMS4wNzR2MC43NThINzAuMTIxeiIvPg0KCQk8cGF0aCBmaWxsPSIjRkZGRkZGIiBkPSJNODEuNDY1LDE3LjY1NmgtNC4wODZ2Mi4yNDJjMCwwLjQ2OSwwLjAzNCwwLjc3MSwwLjEwMiwwLjkwNmMwLjA2NywwLjEzNSwwLjE5OCwwLjIwMywwLjM5MSwwLjIwMw0KCQkJYzAuMjM5LDAsMC4zOTktMC4wOSwwLjQ4LTAuMjdjMC4wODEtMC4xOCwwLjEyMS0wLjUyNywwLjEyMS0xLjA0M3YtMS4zNjdoMi45OTJ2MC43NjZjMCwwLjY0MS0wLjA0MSwxLjEzMy0wLjEyMSwxLjQ3Nw0KCQkJYy0wLjA4MSwwLjM0NC0wLjI3LDAuNzExLTAuNTY2LDEuMTAycy0wLjY3MywwLjY4NC0xLjEyOSwwLjg3OWMtMC40NTYsMC4xOTUtMS4wMjcsMC4yOTMtMS43MTUsMC4yOTMNCgkJCWMtMC42NjcsMC0xLjI1NS0wLjA5OC0xLjc2Ni0wLjI4OWMtMC41MTEtMC4xOTMtMC45MDgtMC40NTctMS4xOTEtMC43OTNjLTAuMjg0LTAuMzM2LTAuNDgtMC43MDYtMC41OS0xLjEwOQ0KCQkJYy0wLjEwOS0wLjQwNC0wLjE2NC0wLjk5MS0wLjE2NC0xLjc2MnYtMy4wMjRjMC0wLjkwNiwwLjEyMi0xLjYyMSwwLjM2Ny0yLjE0NWMwLjI0NS0wLjUyMywwLjY0Ni0wLjkyNCwxLjIwMy0xLjIwMw0KCQkJYzAuNTU3LTAuMjc4LDEuMTk4LTAuNDE4LDEuOTIyLTAuNDE4YzAuODg1LDAsMS42MTYsMC4xNjgsMi4xOTEsMC41MDRjMC41NzUsMC4zMzYsMC45NzksMC43ODEsMS4yMTEsMS4zMzYNCgkJCWMwLjIzMSwwLjU1NSwwLjM0OCwxLjMzNSwwLjM0OCwyLjM0VjE3LjY1NnogTTc4LjMwMSwxNS45NjhWMTUuMjFjMC0wLjUzNi0wLjAyOS0wLjg4My0wLjA4Ni0xLjAzOQ0KCQkJYy0wLjA1OC0wLjE1Ni0wLjE3NS0wLjIzNC0wLjM1Mi0wLjIzNGMtMC4yMTksMC0wLjM1NCwwLjA2Ni0wLjQwNiwwLjE5OWMtMC4wNTIsMC4xMzMtMC4wNzgsMC40OTEtMC4wNzgsMS4wNzR2MC43NThINzguMzAxeiIvPg0KCQk8cGF0aCBmaWxsPSIjRkZGRkZGIiBkPSJNODUuNzA3LDEyLjI4OWwtMC4wNTUsMC45NTVjMC4yMjktMC4zODEsMC41MDktMC42NjcsMC44NC0wLjg1N2MwLjMzMS0wLjE5LDAuNzEyLTAuMjg2LDEuMTQ1LTAuMjg2DQoJCQljMC41NDIsMCwwLjk4NCwwLjEyOCwxLjMyOCwwLjM4M2MwLjM0NCwwLjI1NSwwLjU2NSwwLjU3NywwLjY2NCwwLjk2NWMwLjA5OSwwLjM4OCwwLjE0OCwxLjAzNSwwLjE0OCwxLjk0MXY3LjI2NmgtMy4xNTZ2LTcuMTgNCgkJCWMwLTAuNzEzLTAuMDIzLTEuMTQ4LTAuMDctMS4zMDVzLTAuMTc3LTAuMjM0LTAuMzkxLTAuMjM0Yy0wLjIyNCwwLTAuMzY1LDAuMDktMC40MjIsMC4yN2MtMC4wNTgsMC4xOC0wLjA4NiwwLjY2LTAuMDg2LDEuNDQxDQoJCQl2Ny4wMDhoLTMuMTU2VjEyLjI4OUg4NS43MDd6Ii8+DQoJCTxwYXRoIGZpbGw9IiNGRkZGRkYiIGQ9Ik05Ni40NTcsMTAuMDA3djIuNTMxbC0yLjQ0OSw3LjU4NmgyLjQ0OXYyLjUzMWgtNi4wNjJWMjAuODJsMi41MzEtOC4yODJoLTIuMjM0di0yLjUzMUg5Ni40NTd6Ii8+DQoJCTxwYXRoIGZpbGw9IiNGRkZGRkYiIGQ9Ik0xMDQuMzYzLDE3LjY1NmgtNC4wODZ2Mi4yNDJjMCwwLjQ2OSwwLjAzNCwwLjc3MSwwLjEwMiwwLjkwNmMwLjA2NywwLjEzNSwwLjE5OCwwLjIwMywwLjM5MSwwLjIwMw0KCQkJYzAuMjM5LDAsMC4zOTktMC4wOSwwLjQ4LTAuMjdjMC4wOC0wLjE4LDAuMTIxLTAuNTI3LDAuMTIxLTEuMDQzdi0xLjM2N2gyLjk5MnYwLjc2NmMwLDAuNjQxLTAuMDQsMS4xMzMtMC4xMjEsMS40NzcNCgkJCXMtMC4yNywwLjcxMS0wLjU2NiwxLjEwMnMtMC42NzMsMC42ODQtMS4xMjksMC44NzlzLTEuMDI3LDAuMjkzLTEuNzE1LDAuMjkzYy0wLjY2NywwLTEuMjU1LTAuMDk4LTEuNzY2LTAuMjg5DQoJCQljLTAuNTExLTAuMTkzLTAuOTA4LTAuNDU3LTEuMTkxLTAuNzkzYy0wLjI4NC0wLjMzNi0wLjQ4LTAuNzA2LTAuNTktMS4xMDljLTAuMTA5LTAuNDA0LTAuMTY0LTAuOTkxLTAuMTY0LTEuNzYydi0zLjAyNA0KCQkJYzAtMC45MDYsMC4xMjItMS42MjEsMC4zNjctMi4xNDVjMC4yNDUtMC41MjMsMC42NDYtMC45MjQsMS4yMDMtMS4yMDNjMC41NTctMC4yNzgsMS4xOTgtMC40MTgsMS45MjItMC40MTgNCgkJCWMwLjg4NSwwLDEuNjE2LDAuMTY4LDIuMTkxLDAuNTA0czAuOTc5LDAuNzgxLDEuMjExLDEuMzM2czAuMzQ4LDEuMzM1LDAuMzQ4LDIuMzRWMTcuNjU2eiBNMTAxLjE5OSwxNS45NjhWMTUuMjENCgkJCWMwLTAuNTM2LTAuMDI5LTAuODgzLTAuMDg2LTEuMDM5Yy0wLjA1OC0wLjE1Ni0wLjE3NS0wLjIzNC0wLjM1Mi0wLjIzNGMtMC4yMTksMC0wLjM1NCwwLjA2Ni0wLjQwNiwwLjE5OQ0KCQkJYy0wLjA1MiwwLjEzMy0wLjA3OCwwLjQ5MS0wLjA3OCwxLjA3NHYwLjc1OEgxMDEuMTk5eiIvPg0KCQk8cGF0aCBmaWxsPSIjRkZGRkZGIiBkPSJNMTA4LjcyMywxMC45MDZ2MS42MzNoMC44NTJ2MS42NDFoLTAuODUydjUuNTQ3YzAsMC42ODIsMC4wMzUsMS4wNjIsMC4xMDUsMS4xNDFzMC4zNjMsMC4xMTcsMC44NzksMC4xMTcNCgkJCXYxLjY3MmgtMS4yNzNjLTAuNzE5LDAtMS4yMzEtMC4wMy0xLjUzOS0wLjA5Yy0wLjMwOC0wLjA2MS0wLjU3OC0wLjE5OC0wLjgxMi0wLjQxNGMtMC4yMzQtMC4yMTctMC4zOC0wLjQ2NC0wLjQzOC0wLjc0Mg0KCQkJYy0wLjA1OC0wLjI3OS0wLjA4Ni0wLjkzNC0wLjA4Ni0xLjk2NXYtNS4yNjZoLTAuNjh2LTEuNjQxaDAuNjh2LTEuNjMzSDEwOC43MjN6Ii8+DQoJCTxwYXRoIGZpbGw9IiNGRkZGRkYiIGQ9Ik0xMTMuMDksMTYuMzA0aC0yLjk2MXYtMC42OTVjMC0wLjgwMiwwLjA5My0xLjQyLDAuMjc3LTEuODU1YzAuMTg1LTAuNDM1LDAuNTU2LTAuODE5LDEuMTEzLTEuMTUyDQoJCQljMC41NTgtMC4zMzMsMS4yODEtMC41LDIuMTcyLTAuNWMxLjA2NywwLDEuODcyLDAuMTg5LDIuNDE0LDAuNTY2YzAuNTQyLDAuMzc4LDAuODY3LDAuODQxLDAuOTc3LDEuMzkxDQoJCQljMC4xMDksMC41NSwwLjE2NCwxLjY4MSwwLjE2NCwzLjM5NXY1LjIwM2gtMy4wN3YtMC45MjRjLTAuMTkyLDAuMzctMC40NDEsMC42NDgtMC43NDYsMC44MzNzLTAuNjY4LDAuMjc4LTEuMDksMC4yNzgNCgkJCWMtMC41NTIsMC0xLjA1OS0wLjE1Ni0xLjUyLTAuNDY1Yy0wLjQ2MS0wLjMxMS0wLjY5MS0wLjk4OC0wLjY5MS0yLjAzNXYtMC44NTJjMC0wLjc3NiwwLjEyMi0xLjMwNSwwLjM2Ny0xLjU4Ng0KCQkJczAuODUyLTAuNjA5LDEuODItMC45ODVjMS4wMzYtMC40MDYsMS41OTEtMC42OCwxLjY2NC0wLjgyczAuMTA5LTAuNDI3LDAuMTA5LTAuODU5YzAtMC41NDItMC4wNC0wLjg5NS0wLjEyMS0xLjA1OQ0KCQkJcy0wLjIxNS0wLjI0Ni0wLjQwMi0wLjI0NmMtMC4yMTQsMC0wLjM0NywwLjA2OS0wLjM5OCwwLjIwN2MtMC4wNTIsMC4xMzgtMC4wNzgsMC40OTYtMC4wNzgsMS4wNzRWMTYuMzA0eiBNMTE0LjA5LDE3LjcyNw0KCQkJYy0wLjUwNSwwLjM2OS0wLjc5OCwwLjY4LTAuODc5LDAuOTNzLTAuMTIxLDAuNjA5LTAuMTIxLDEuMDc4YzAsMC41MzYsMC4wMzUsMC44ODMsMC4xMDUsMS4wMzlzMC4yMSwwLjIzNCwwLjQxOCwwLjIzNA0KCQkJYzAuMTk4LDAsMC4zMjctMC4wNjIsMC4zODctMC4xODRjMC4wNi0wLjEyMywwLjA5LTAuNDQ0LDAuMDktMC45NjVWMTcuNzI3eiIvPg0KCQk8cGF0aCBmaWxsPSIjRkZGRkZGIiBkPSJNMTIxLjI0NiwxMC4wMDdoMy4zMTJjMC44OTYsMCwxLjU4NSwwLjA3LDIuMDY2LDAuMjExczAuODQ0LDAuMzQ0LDEuMDg2LDAuNjA5czAuNDA2LDAuNTg3LDAuNDkyLDAuOTY1DQoJCQljMC4wODYsMC4zNzgsMC4xMjksMC45NjIsMC4xMjksMS43NTR2MS4xMDJjMCwwLjgwOC0wLjA4MywxLjM5Ni0wLjI1LDEuNzY2Yy0wLjE2NywwLjM3LTAuNDczLDAuNjU0LTAuOTE4LDAuODUyDQoJCQljLTAuNDQ1LDAuMTk3LTEuMDI3LDAuMjk3LTEuNzQ2LDAuMjk3aC0wLjg4M3Y1LjA5NGgtMy4yODlWMTAuMDA3eiBNMTI0LjUzNSwxMi4xNzF2My4yMTljMC4wOTQsMC4wMDUsMC4xNzUsMC4wMDgsMC4yNDIsMC4wMDgNCgkJCWMwLjMwMiwwLDAuNTEyLTAuMDc0LDAuNjI5LTAuMjIzczAuMTc2LTAuNDU3LDAuMTc2LTAuOTI2VjEzLjIxYzAtMC40MzItMC4wNjctMC43MTMtMC4yMDMtMC44NDQNCgkJCUMxMjUuMjQzLDEyLjIzNywxMjQuOTYyLDEyLjE3MSwxMjQuNTM1LDEyLjE3MXoiLz4NCgkJPHBhdGggZmlsbD0iI0ZGRkZGRiIgZD0iTTEzMi4zNCwxMi4yODlsLTAuMTI1LDEuMzYzYzAuNDU4LTAuOTc3LDEuMTIyLTEuNDkzLDEuOTkyLTEuNTUxdjMuNjQ4Yy0wLjU3OCwwLTEuMDAzLDAuMDc4LTEuMjczLDAuMjM0DQoJCQlzLTAuNDM4LDAuMzc0LTAuNSwwLjY1MmMtMC4wNjIsMC4yNzktMC4wOTQsMC45Mi0wLjA5NCwxLjkyNnY0LjA5NGgtMy4xNTZWMTIuMjg5SDEzMi4zNHoiLz4NCgkJPHBhdGggZmlsbD0iI0ZGRkZGRiIgZD0iTTE0Mi4wNTEsMTUuOTI5djIuNTRjMCwwLjkzMi0wLjA0NywxLjYxNS0wLjE0MSwyLjA1MWMtMC4wOTQsMC40MzUtMC4yOTQsMC44NDEtMC42MDIsMS4yMTkNCgkJCWMtMC4zMDgsMC4zNzctMC43MDIsMC42NTYtMS4xODQsMC44MzZzLTEuMDM1LDAuMjctMS42NiwwLjI3Yy0wLjY5OCwwLTEuMjg5LTAuMDc4LTEuNzczLTAuMjMNCgkJCWMtMC40ODQtMC4xNTQtMC44Ni0wLjM4Ni0xLjEyOS0wLjY5NWMtMC4yNjktMC4zMTEtMC40Ni0wLjY4Ni0wLjU3NC0xLjEyNWMtMC4xMTQtMC40NC0wLjE3Mi0xLjEwMS0wLjE3Mi0xLjk4di0yLjY1Nw0KCQkJYzAtMC45NjMsMC4xMDQtMS43MTYsMC4zMTItMi4yNThjMC4yMDgtMC41NDIsMC41ODMtMC45NzcsMS4xMjUtMS4zMDVzMS4yMzQtMC40OTIsMi4wNzgtMC40OTJjMC43MDgsMCwxLjMxNiwwLjEwNSwxLjgyNCwwLjMxNg0KCQkJczAuODk5LDAuNDg2LDEuMTc2LDAuODI0YzAuMjc2LDAuMzM5LDAuNDY1LDAuNjg4LDAuNTY2LDEuMDQ3UzE0Mi4wNTEsMTUuMTk1LDE0Mi4wNTEsMTUuOTI5eiBNMTM4Ljg5NSwxNS4xNDgNCgkJCWMwLTAuNTMxLTAuMDI4LTAuODY2LTAuMDg2LTEuMDA0Yy0wLjA1OC0wLjEzOC0wLjE4LTAuMjA3LTAuMzY3LTAuMjA3cy0wLjMxMiwwLjA2OS0wLjM3NSwwLjIwNw0KCQkJYy0wLjA2MiwwLjEzOC0wLjA5NCwwLjQ3My0wLjA5NCwxLjAwNHY0LjY4YzAsMC40ODksMC4wMzEsMC44MDksMC4wOTQsMC45NTdzMC4xODUsMC4yMjMsMC4zNjcsMC4yMjMNCgkJCWMwLjE4OCwwLDAuMzEyLTAuMDY4LDAuMzcxLTAuMjAzYzAuMDYtMC4xMzYsMC4wOS0wLjQyOCwwLjA5LTAuODc1VjE1LjE0OHoiLz4NCgkJPHBhdGggZmlsbD0iI0ZGRkZGRiIgZD0iTTE1MC4yNywxMC4wMDd2MTIuNjQ5aC0zLjE1NnYtMC43NTJjLTAuMzAyLDAuMzEyLTAuNjIsMC41NDctMC45NTMsMC43MDRzLTAuNjgzLDAuMjM1LTEuMDQ3LDAuMjM1DQoJCQljLTAuNDg5LDAtMC45MTQtMC4xMjktMS4yNzMtMC4zODdzLTAuNTktMC41NTctMC42OTEtMC44OTVjLTAuMTAyLTAuMzM5LTAuMTUyLTAuODkxLTAuMTUyLTEuNjU2di00Ljg1Mg0KCQkJYzAtMC43OTcsMC4wNTEtMS4zNjIsMC4xNTItMS42OTVjMC4xMDItMC4zMzMsMC4zMzUtMC42MjYsMC42OTktMC44NzljMC4zNjQtMC4yNTIsMC44LTAuMzc5LDEuMzA1LTAuMzc5DQoJCQljMC4zOTEsMCwwLjc0OSwwLjA3LDEuMDc0LDAuMjExczAuNjIxLDAuMzUzLDAuODg3LDAuNjM0di0yLjkzOUgxNTAuMjd6IE0xNDcuMTEzLDE0Ljg5OGMwLTAuMzgtMC4wMzItMC42MzUtMC4wOTgtMC43NjYNCgkJCWMtMC4wNjUtMC4xMy0wLjE5NC0wLjE5NS0wLjM4Ny0wLjE5NWMtMC4xODgsMC0wLjMxMywwLjA1OS0wLjM3OSwwLjE3NnMtMC4wOTgsMC4zNzktMC4wOTgsMC43ODV2NS4wNzkNCgkJCWMwLDAuNDIyLDAuMDMxLDAuNjk5LDAuMDk0LDAuODMyczAuMTgzLDAuMTk5LDAuMzU5LDAuMTk5YzAuMjAzLDAsMC4zMzktMC4wNzQsMC40MDYtMC4yMjNzMC4xMDItMC41MTIsMC4xMDItMS4wOVYxNC44OTh6Ii8+DQoJCTxwYXRoIGZpbGw9IiNGRkZGRkYiIGQ9Ik0xNTguNjI5LDEyLjI4OXYxMC4zNjhoLTMuMjExbDAuMDU1LTAuODYxYy0wLjIxOSwwLjM1LTAuNDg4LDAuNjExLTAuODA5LDAuNzg2cy0wLjY4OCwwLjI2My0xLjEwNSwwLjI2Mw0KCQkJYy0wLjQ3NCwwLTAuODY3LTAuMDg0LTEuMTgtMC4yNWMtMC4zMTItMC4xNjctMC41NDMtMC4zODktMC42OTEtMC42NjRjLTAuMTQ4LTAuMjc2LTAuMjQxLTAuNTY0LTAuMjc3LTAuODYzDQoJCQljLTAuMDM2LTAuMy0wLjA1NS0wLjg5NS0wLjA1NS0xLjc4NXYtNi45OTNoMy4xNTZ2Ny4wNTVjMCwwLjgwNywwLjAyNCwxLjI4NiwwLjA3NCwxLjQzOGMwLjA1LDAuMTUsMC4xODQsMC4yMjcsMC40MDIsMC4yMjcNCgkJCWMwLjIzNCwwLDAuMzc0LTAuMDc4LDAuNDE4LTAuMjM0czAuMDY2LTAuNjU5LDAuMDY2LTEuNTA4di02Ljk3N0gxNTguNjI5eiIvPg0KCQk8cGF0aCBmaWxsPSIjRkZGRkZGIiBkPSJNMTY2LjczOCwxNi4yMDNoLTIuOTc3di0xLjE5NWMwLTAuNDE3LTAuMDM0LTAuNjk5LTAuMTAyLTAuODQ4cy0wLjE5Mi0wLjIyMy0wLjM3NS0wLjIyMw0KCQkJcy0wLjMwNSwwLjA2NS0wLjM2NywwLjE5NWMtMC4wNjIsMC4xMy0wLjA5NCwwLjQyMi0wLjA5NCwwLjg3NXY0Ljg5MWMwLDAuMzY5LDAuMDQ3LDAuNjQ2LDAuMTQxLDAuODMyDQoJCQljMC4wOTQsMC4xODUsMC4yMzEsMC4yNzcsMC40MTQsMC4yNzdjMC4yMTQsMCwwLjM1OC0wLjA5NywwLjQzNC0wLjI4OWMwLjA3NS0wLjE5MywwLjExMy0wLjU1OCwwLjExMy0xLjA5NHYtMS4yMzRoMi44MTINCgkJCWMtMC4wMDUsMC44MjgtMC4wMzUsMS40NDktMC4wOSwxLjg2M3MtMC4yMjksMC44MzgtMC41MjMsMS4yNzNjLTAuMjk0LDAuNDM1LTAuNjc5LDAuNzYzLTEuMTUyLDAuOTg0DQoJCQljLTAuNDc0LDAuMjIxLTEuMDYsMC4zMzItMS43NTgsMC4zMzJjLTAuODkxLDAtMS41OTctMC4xNTItMi4xMTctMC40NTdzLTAuODktMC43MzItMS4xMDUtMS4yODENCgkJCWMtMC4yMTYtMC41NS0wLjMyNC0xLjMzLTAuMzI0LTIuMzRWMTUuODJjMC0wLjg4LDAuMDg5LTEuNTQ0LDAuMjY2LTEuOTkyYzAuMTc3LTAuNDQ4LDAuNTU1LTAuODQ4LDEuMTMzLTEuMTk5DQoJCQlzMS4yODEtMC41MjcsMi4xMDktMC41MjdjMC44MjMsMCwxLjUyNiwwLjE3NSwyLjEwOSwwLjUyM2MwLjU4MywwLjM0OSwwLjk3MiwwLjc4OSwxLjE2NCwxLjMyUzE2Ni43MzgsMTUuMjI5LDE2Ni43MzgsMTYuMjAzeiIvPg0KCQk8cGF0aCBmaWxsPSIjRkZGRkZGIiBkPSJNMTcxLjAwNCwxMC45MDZ2MS42MzNoMC44NTJ2MS42NDFoLTAuODUydjUuNTQ3YzAsMC42ODIsMC4wMzUsMS4wNjIsMC4xMDUsMS4xNDFzMC4zNjMsMC4xMTcsMC44NzksMC4xMTcNCgkJCXYxLjY3MmgtMS4yNzNjLTAuNzE5LDAtMS4yMzEtMC4wMy0xLjUzOS0wLjA5Yy0wLjMwOC0wLjA2MS0wLjU3OC0wLjE5OC0wLjgxMi0wLjQxNGMtMC4yMzQtMC4yMTctMC4zOC0wLjQ2NC0wLjQzOC0wLjc0Mg0KCQkJYy0wLjA1OC0wLjI3OS0wLjA4Ni0wLjkzNC0wLjA4Ni0xLjk2NXYtNS4yNjZoLTAuNjh2LTEuNjQxaDAuNjh2LTEuNjMzSDE3MS4wMDR6Ii8+DQoJCTxwYXRoIGZpbGw9IiNGRkZGRkYiIGQ9Ik0xNzUuODAxLDEwLjAwN3YxLjY0OGgtMy4yNXYtMS42NDhIMTc1LjgwMXogTTE3NS44MDEsMTIuMjg5djEwLjM2OGgtMy4yNVYxMi4yODlIMTc1LjgwMXoiLz4NCgkJPHBhdGggZmlsbD0iI0ZGRkZGRiIgZD0iTTE4NC4wNzQsMTUuOTI5djIuNTRjMCwwLjkzMi0wLjA0NywxLjYxNS0wLjE0MSwyLjA1MWMtMC4wOTQsMC40MzUtMC4yOTQsMC44NDEtMC42MDIsMS4yMTkNCgkJCWMtMC4zMDgsMC4zNzctMC43MDIsMC42NTYtMS4xODQsMC44MzZzLTEuMDM1LDAuMjctMS42NiwwLjI3Yy0wLjY5OCwwLTEuMjg5LTAuMDc4LTEuNzczLTAuMjMNCgkJCWMtMC40ODQtMC4xNTQtMC44Ni0wLjM4Ni0xLjEyOS0wLjY5NWMtMC4yNjktMC4zMTEtMC40Ni0wLjY4Ni0wLjU3NC0xLjEyNWMtMC4xMTQtMC40NC0wLjE3Mi0xLjEwMS0wLjE3Mi0xLjk4di0yLjY1Nw0KCQkJYzAtMC45NjMsMC4xMDQtMS43MTYsMC4zMTItMi4yNThjMC4yMDgtMC41NDIsMC41ODMtMC45NzcsMS4xMjUtMS4zMDVzMS4yMzQtMC40OTIsMi4wNzgtMC40OTJjMC43MDgsMCwxLjMxNiwwLjEwNSwxLjgyNCwwLjMxNg0KCQkJczAuODk5LDAuNDg2LDEuMTc2LDAuODI0YzAuMjc2LDAuMzM5LDAuNDY1LDAuNjg4LDAuNTY2LDEuMDQ3UzE4NC4wNzQsMTUuMTk1LDE4NC4wNzQsMTUuOTI5eiBNMTgwLjkxOCwxNS4xNDgNCgkJCWMwLTAuNTMxLTAuMDI4LTAuODY2LTAuMDg2LTEuMDA0Yy0wLjA1OC0wLjEzOC0wLjE4LTAuMjA3LTAuMzY3LTAuMjA3cy0wLjMxMiwwLjA2OS0wLjM3NSwwLjIwNw0KCQkJYy0wLjA2MiwwLjEzOC0wLjA5NCwwLjQ3My0wLjA5NCwxLjAwNHY0LjY4YzAsMC40ODksMC4wMzEsMC44MDksMC4wOTQsMC45NTdzMC4xODUsMC4yMjMsMC4zNjcsMC4yMjMNCgkJCWMwLjE4OCwwLDAuMzEyLTAuMDY4LDAuMzcxLTAuMjAzYzAuMDYtMC4xMzYsMC4wOS0wLjQyOCwwLjA5LTAuODc1VjE1LjE0OHoiLz4NCgkJPHBhdGggZmlsbD0iI0ZGRkZGRiIgZD0iTTE4OC4zMjQsMTIuMjg5bC0wLjA1NSwwLjk1NWMwLjIyOS0wLjM4MSwwLjUwOS0wLjY2NywwLjg0LTAuODU3czAuNzEyLTAuMjg2LDEuMTQ1LTAuMjg2DQoJCQljMC41NDIsMCwwLjk4NCwwLjEyOCwxLjMyOCwwLjM4M2MwLjM0NCwwLjI1NSwwLjU2NSwwLjU3NywwLjY2NCwwLjk2NWMwLjA5OSwwLjM4OCwwLjE0OCwxLjAzNSwwLjE0OCwxLjk0MXY3LjI2NmgtMy4xNTZ2LTcuMTgNCgkJCWMwLTAuNzEzLTAuMDIzLTEuMTQ4LTAuMDctMS4zMDVzLTAuMTc3LTAuMjM0LTAuMzkxLTAuMjM0Yy0wLjIyNCwwLTAuMzY0LDAuMDktMC40MjIsMC4yN3MtMC4wODYsMC42Ni0wLjA4NiwxLjQ0MXY3LjAwOGgtMy4xNTYNCgkJCVYxMi4yODlIMTg4LjMyNHoiLz4NCgk8L2c+DQo8L2c+DQo8L3N2Zz4NCg==" onerror="this.onerror=null; this.src='data:image/png;base64,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'">
			</a>
        </div>

        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.9.1.min.js"><\/script>')</script>

        <script src="js/vendor/jquery.fullPage.min.js"></script>
        <script src="js/main.js"></script>
		
		<script type="text/javascript" src="//connect.facebook.net/en_US/all.js"></script>
		<script type="text/javascript">
			window.fbAsyncInit = function() {
			FB.init({
			appId      : '360989144063992',
			});
			var docheight = $("body").height();
			// Override detected height
			docheight = 3200;
			FB.Canvas.setSize({ width: 810, height: docheight });
			}
		</script> 

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
