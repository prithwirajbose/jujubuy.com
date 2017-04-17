<?php include_once("config.php"); ?>
<?php include_once("functions.php"); ?>
<?php include_once("db.php"); ?>

<?php
if (! isset ( $_SESSION )) {
	session_start ();
}
if (empty ( $_SESSION ['cart'] ) || empty ( $_SESSION ['cart'] ['id'] )) {
	$_SESSION ['cart'] = array (
			'id' => md5 ( time () ),
			'totalamount' => 0,
			'currency' => 'INR',
			'orderitems' => array () 
	);
}
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


			<div class="gridcontainer cart">

				<div class="section-title-container small">
				<h2 class="section-title">Shopping Cart</h2>
				<div class="toolbox">
					<input type="button" name="updatecart" id="updatecart" class="updatebutton ui-button" value="Update Cart" style="width:140px;" 
						 onclick="javascript:JUJUBUY.updateFullCart(window.event);" />
				</div>
				<div class="toolbox">
					<input type="button" name="updatecart" id="updatecart" class="updatebutton ui-button" value="Empty Cart" style="width:140px;" 
						 onclick="javascript:JUJUBUY.updateCart(window.event,'empty',null,null,true);" />
				</div>
				<div class="toolbox">
					<input type="button" name="updatecart" id="updatecart" class="updatebutton ui-button" value="Delete Selected" style="width:140px;" 
						 onclick="javascript:JUJUBUY.deleteSelectedCart(window.event);" />
				</div>
				<div class="clear"></div>
				</div>
<?php
$cart = $_SESSION ['cart'];
if(sizeof($cart ['orderitems'])>0) {
foreach ( $cart ['orderitems'] as $k => $v ) {
$row = $v['product_details'];
		?>
<div class="griditem cartitem" productPriceId="<?php echo $row['price_id']; ?>">
					<div class="griditem-icon" style="min-width:60px; width:60px; height:30px;">
						<input type="checkbox" id="check_<?php echo $k; ?>" name="itemcheck" value="<?php echo $k; ?>" 
						style="width:30px; height:30px; cursor:pointer;" class="itemcheck" />
						</div>
					<div class="griditem-text">
						<h3 class="griditem-title"><?php echo $row['product_name']; ?></h3>
						<div class="griditem-desc">
							<div class="griditem-price">&#8377; <?php echo $row['unit_price']; ?> 
<span class="note">per <?php echo $row['unit_name']; ?></span> 
							</div>
							<div class="griditem-spec">
								Quantity : <input type="text" name="quantity_<?php echo $k; ?>" id="quantity_<?php echo $k; ?>"
									class="quantity" value="<?php echo $v['qty']; ?>" maxlength="4" style="width:55px; text-align:center; font-weight:bold;" />
									
									<input type="button" name="update_<?php echo $k; ?>" id="update_<?php echo $k; ?>" class="updatebutton ui-button" value="Update" style="width:120px;" 
						 onclick="javascript:JUJUBUY.updateFullCart(window.event);" />
							</div>
						</div>
					</div>
					<div class="griditem-tools">
						<input type="button" name="delete_<?php echo $k; ?>" id="delete_<?php echo $k; ?>" class="deletebutton ui-button" value="Delete Item" style="width:120px;"
						 onclick="javascript:JUJUBUY.updateCart(window.event,'delete',<?php echo $k; ?>,null,true);" /><br />
						
					</div>
					<div class="clear"></div>
				</div>
<?php
}
print '<div style="color:red; font-size:16px; margin:50px 30px; display:none;" class="noitem">Your cart is empty</div>';
}
else
	print '<div style="color:red; font-size:16px; margin:50px 30px;">Your cart is empty</div>';
?>
</div>

			<div></div>
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