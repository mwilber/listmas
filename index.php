<?php

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
		
		$_GET['l'] = IdObfuscator::decode($_GET['l']);
		
		//echo $_GET['l'];
		
		//echo IdObfuscator::encode(221);
		
		$conn = mysql_connect($db['default']['hostname'], $db['default']['username'], $db['default']['password']) 
	  		or die("Unable to connect to MySQL");
			
		//select a database to work with
		$dbc = mysql_select_db($db['default']['database'],$conn) 
		  or die("Could not select examples");
		
		$sql = "SELECT * FROM tblProdlist JOIN tblShoplist ON tblProdlist.shoplistId=tblShoplist.shoplistId JOIN tblProd ON tblProdlist.prodId=tblProd.prodId WHERE tblProdlist.shoplistId=".$_GET['l'];
		//echo $sql;
		$listRS = mysql_query($sql);
//		$list = mysql_fetch_assoc($listRS);
		
				
//		if( $list['shoplistName'] == "" ){
//			$list['shoplistName']=$list['shoplistName'];
//		}else{
//			$social['title'] = $checkin['shoplistName'];
//		}
		
//		if( $checkin['checkinPhoto'] == "" ){
//			$checkin['checkinPhoto']=$social['image'];
//		}else{
//			$social['image'] = $checkin['checkinPhoto'];
//		}
		
		mysql_close($conn);
	}

?>
<h1>coming soon....</h1>
<?php if(isset($_GET['l'])): ?>
<ul>
	<?php while($li = mysql_fetch_array( $listRS )): ?>
		<li>
			<a href="<?=$li['prodUrl']?>">
			<img src="<?=$li['prodPhoto']?>" width="100"/>
			<?=$li['prodName']?>
			</a>
		</li>
	<?php endwhile; ?>
</ul>
<?php endif; ?>