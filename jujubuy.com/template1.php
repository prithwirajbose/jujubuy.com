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

<div class="widgetcontainer latest-products">
<h2 class="section-title small">Latest Products</h2>
<?php for($xxx=0;$xxx<8;$xxx++) { ?>
<div class="widget"><a href="#"><div class="widget-icon"><img src="images/<?php echo ($xxx % rand(2,3)==0) ? "ic.png" : "noimage.png"; ?>" /></div>
<div class="widget-text">
<h3 class="widget-title">CD<?php echo rand(4000,4099); ?> Integrated Circuit</h3>
</div>
<div class="widget-footer">
<div class="widget-footer-left">&#8377; <?php echo rand(20,9999); ?>.00</div>
<div class="widget-footer-right">Buy Now</div>
<div class="clear"></div>
</div>
</a></div>
<?php }
?>
<div class="clear"></div>
</div>

<div class="widgetcontainer popular-products">
<h2 class="section-title small">Most Popular Products</h2>
<?php for($xxx=0;$xxx<16;$xxx++) { ?>
<div class="widget"><a href="#"><div class="widget-icon"><img src="images/<?php echo ($xxx % rand(2,3)==0) ? "ic.png" : "noimage.png"; ?>" /></div>
<div class="widget-text">
<h3 class="widget-title">CD<?php echo rand(4000,4099); ?> Integrated Circuit</h3>
</div>
<div class="widget-footer">
<div class="widget-footer-left">&#8377; <?php echo rand(20,9999); ?>.00</div>
<div class="widget-footer-right">Buy Now</div>
<div class="clear"></div>
</div>
</a></div>
<?php }
?>
<div class="clear"></div>
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
