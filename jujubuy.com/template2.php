<?php include("config.php"); ?>
<?php include("functions.php"); ?>
<!DOCTYPE html>
<html>
<head>
<title>Buy Online Electronics Components, IoT Modules, Robotics, Project Parts, Integrated Circuits, Microcontrollers and Semi-Conductors | JujuBuy.com</title>
<meta name="description" content="Buy Online Electronic Components, Parts, Modules, IoT Components, Robotics, Integrated Circuits, Microcontrollers, SemiConductors, Transistor, Passive Components, Resistor, Capacitor, Diode, Inductor" />
<meta name="keyword" content="electronic,components,parts,modules,iot,robotics,integrated circuits,ic,microcontroller,semiConductor,transistor,resistor,capacitor,diode,inductor,project material,enclosure,wire,relay,sensors" />
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
<h2 class="section-title small">Latest Products</h2>
<?php for($xxx=0;$xxx<8;$xxx++) { ?>
<div class="griditem">
<div class="griditem-icon"><img src="<?php echo $config['site']; ?>/images/<?php echo ($xxx % rand(2,3)==0) ? "ic.png" : "noimage.png"; ?>" /></div>
<div class="griditem-text">
<h3 class="griditem-title">CD<?php echo rand(4000,4099); ?> Integrated Circuit</h3>
<div class="griditem-desc">
<div class="griditem-price">&#8377; <?php echo rand(20,9999); ?>.00</div>
<div class="griditem-spec"><?php 
$arr = ["lorem", "ipsum", "dolor", "sit", "amet"];
echo "S";
$c = rand(20,100);
for($i=0;$i<$c; $i++) {
	
echo $arr[rand(0,4)] . " ";
}
?>
</div>
</div>
</div>
<div class="griditem-tools">
<a href="<?php echo $config['site']; ?>/cart/?id=123" class="gridbtn" id="griditem-btnbuynow"><img src="<?php echo $config['site']; ?>/images/details-electronics-blue.png" style="border:none; width:150px; height:auto;" /></a>
<br />
<a href="<?php echo $config['site']; ?>" class="gridbtn" id="griditem-btnbuynow"><img src="<?php echo $config['site']; ?>/images/buy-now-electronics-orange.png" style="border:none; width:150px; height:auto;" /></a>
</div>
<div class="clear"></div>
</div>
<?php }
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
