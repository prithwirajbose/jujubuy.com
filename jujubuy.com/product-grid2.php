<?php include_once("config.php"); ?>
<?php include_once("functions.php"); ?>
<?php include_once("db.php"); ?>

<?php
$conn = connectDb ();
$catslug = mysqli_real_escape_string ( $conn, $_REQUEST ['catslug'] );
$catlist = [ 
		0 
];
$catdata = mysqli_query ( $conn, "select * from product_category where url_slug='" . $catslug . "' limit 1" ) or die ( mysqli_error ( $conn ) );
$categoryName = "";
if (mysqli_num_rows ( $catdata ) > 0) {
	while ( $catrow = mysqli_fetch_assoc ( $catdata ) ) {
		$categoryName = $catrow ['category_name'];
		array_push ( $catlist, $catrow ['category_id'] );
		$nextarr = getChildrenCategoryIds ( $catrow ['category_id'], $conn );
		if (is_array ( $nextarr ) && sizeof ( $nextarr ) > 0) {
			$catlist = array_merge_recursive ( $catlist, $nextarr );
		}
	}
} else {
	http_response_code ( 404 );
	include ('httperror.php'); // provide your own HTML for the error page
	die ();
}

$catliststr = '';
$comma = '';
foreach ( $catlist as $cat ) {
	$catliststr .= $comma . $cat;
	$comma = ',';
}
$pagenum = ! empty ( $_REQUEST ['pagenum'] ) ? $_REQUEST ['pagenum'] : 1;
$pagesize = ! empty ( $_REQUEST ['pagesize'] ) ? $_REQUEST ['pagesize'] : (! empty ( $_SESSION ['defaults'] ['pagesize'] ) ? $_SESSION ['defaults'] ['pagesize'] : 10);
$_SESSION ['defaults'] ['pagesize'] = $pagesize;
$recordcount = 0;
?>
<!DOCTYPE html>
<html>
<head>
<title>Buy Online Electronics Components, IoT Modules, Robotics, Project
	Parts, Integrated Circuits, Microcontrollers and Semi-Conductors |
	JujuBuy.com</title>
<meta name="description"
	content="Buy Online Electronic Components, Parts, Modules, IoT Components, Robotics, Integrated Circuits, Microcontrollers, SemiConductors, Transistor, Passive Components, Resistor, Capacitor, Diode, Inductor" />
<meta name="keyword"
	content="electronic,components,parts,modules,iot,robotics,integrated circuits,ic,microcontroller,semiConductor,transistor,resistor,capacitor,diode,inductor,project material,enclosure,wire,relay,sensors" />
<?php include("includes/head.php"); ?>
</head>
<body>
	<!-- Begin Wrapper -->
	<div id="wrapper">
		<!-- Begin Header -->
		<div id="header">
<?php include("includes/header.php"); ?>
</div>
		<!-- End Header -->
		<!-- Begin Naviagtion -->
		<div id="navigation">
<?php include("includes/navmenu.php"); ?>
<?php include("includes/usermenu.php"); ?>
<div class="clear"></div>
		</div>
		<!-- End Naviagtion -->
		<!-- Begin Content -->
		<div id="content">




			<div class="gridcontainer latest-products">

				<div class="section-title-container small">
					<h2 class="section-title"><?php echo $categoryName; ?></h2>
					<div class="clear"></div>
				</div>

<?php

$data = mysqli_query ( $conn, "select p.*,pc.image_file as category_image,pp.*, pi.file_name as product_image from product_category pc, product p
		left join product_price pp on pp.product_id=p.product_id and pp.default_flag=1 left join product_image pi on pi.product_id=p.product_id and pi.default_flag=1  
		where pc.category_id in (" . $catliststr . ") and pc.category_id=p.category_id limit " . (($pagenum - 1) * $pagesize) . "," . $pagesize ) or die ( mysqli_error ( $conn ) );
$datacount = mysqli_query ( $conn, "select p.product_id from product_category pc, product p 
		where pc.category_id in (" . $catliststr . ") and pc.category_id=p.category_id" ) or die ( mysqli_error ( $conn ) );
if (mysqli_num_rows ( $data ) > 0) {
	$recordcount = mysqli_num_rows ( $datacount );
	while ( $row = mysqli_fetch_assoc ( $data ) ) {
		?>
<div class="griditem" productPriceId="<?php echo $row['price_id']; ?>">
					<div class="griditem-icon">
						<img
							src="<?php echo $config['site']; ?>/images/<?php echo (!empty($row['product_image']) ? $row['product_image'] : (!empty($row['category_image']) ? $row['category_image'] : "noimage.png")); ?>" />
					</div>
					<div class="griditem-text">
						<h3 class="griditem-title"><?php echo $row['product_name']; ?></h3>
						<div class="griditem-desc">
							<div class="griditem-price">&#8377; <?php echo $row['unit_price']; ?> 
<span class="note">per <?php echo $row['unit_name']; ?></span> <span
									class="note boldtext <?php echo $row['units_available']>0 ? "greentext" : "redtext"; ?>">
<?php echo $row['units_available']>0 ? "&#10003; IN STOCK" : "OUT OF STOCK"; ?></span>
								<span class="note">&#10003; 7 Day Shipping</span>
							</div>
							<div class="griditem-spec">
<?php echo substr(strip_tags($row['long_description']),0,100)."..."; ?>
</div>
						</div>
					</div>
					<div class="griditem-tools">
						<a
							href="<?php echo $config['site']; ?>/product/<?php echo $row['url_slug']; ?>_<?php echo $row['product_id']; ?>"
							class="gridbtn" id="griditem-btndetails"> <img
							src="<?php echo $config['site']; ?>/images/details-electronics-blue.png"
							style="border: none; width: 150px; height: auto;" />
						</a> <br /> <a rel="nofollow" href="javascript:voidfn()"
							onclick="javascript:JUJUBUY.updateCart(window.event, 'add',<?php echo $row['price_id']; ?>,1, false, true);"
							class="gridbtn" id="griditem-btnbuynow"> <img
							src="<?php echo $config['site']; ?>/images/buy-now-electronics-orange.png"
							style="border: none; width: 150px; height: auto;" /></a>
					</div>
					<div class="clear"></div>
				</div>
<?php
	}
} else
	print '<div style="color:red; font-size:16px; margin:50px 30px;">No product is listed in this category yet.</div>';
?>
</div>

			<div>
<?php
if ($recordcount > 0) {
	print 'Pages : ';
	$totalpages = ($recordcount / $pagesize);
	for($i = 0; $i < $totalpages; $i ++) {
		if (($i + 1) == $pagenum) {
			print '<b>Page ' . ($i + 1) . '</b> | ';
		} else {
			print '<a href="' . $config ['site'] . '/category/' . $catslug . '?pagenum=' . ($i + 1) . '&pagesize=' . $pagesize . '">Page ' . ($i + 1) . '</a> | ';
		}
	}
	?>
	Show <select id="paginator_pagesize" name="pagenum"
					onchange="javascript:window.location='<?php echo $config['site'].'/category/'.$catslug.'?pagenum=1&pagesize=';?>'+this.value;">
					<option value="5"
						<?php if($pagesize==5) print ' selected="selected"'; ?>>5</option>
					<option value="10"
						<?php if($pagesize==10) print ' selected="selected"'; ?>>10</option>
					<option value="25"
						<?php if($pagesize==25) print ' selected="selected"'; ?>>25</option>
					<option value="50"
						<?php if($pagesize==50) print ' selected="selected"'; ?>>50</option>
					<option value="100"
						<?php if($pagesize==100) print ' selected="selected"'; ?>>100</option>
				</select> records per page

<?php
}
?>

</div>
		</div>
		<!-- End Content -->
		<div id="footer">
<?php include("includes/footer.php"); ?>
<div class="clear"></div>
		</div>
	</div>
	<!-- End Wrapper -->
</body>
</html>
<?php
closeDb ( $conn );
?>