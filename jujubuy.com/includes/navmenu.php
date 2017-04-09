<?php  $conn = connectDb();
?>
<div id="navmenu">
<div class="dropdown">
  <div class="dropbtn"><a href="#">Products</a></div>
  <div class="dropdown-content" style="width:800px; height:400px;">
    <div class="submenu">
    <div class="submenu-left">
    <ul>
    <li><a class="master" name="ic">Integrated Circuits</a></li>
    <li><a class="master" name="semiconductor">Semi-Conductors</a></li>
    <li><a class="master" name="passivecomponent">Passive Components</a></li>
    </ul>
    </div>
    <div class="submenu-right">
    <div class="slave" id="submenu-ic-slave" master="ic">
    <ul style="list-style: none;">
		<?php 
		$cats = getChildrenCategories(1,$conn);
		foreach($cats as $cat) {
			?>
		  	<li><a href="<?php echo $config['site']; ?>/category/<?php echo $cat['url_slug']; ?>" <?php 
		  	$rnd = rand(1,100); if($rnd%2==0) { print 'class="small"'; } elseif($rnd%3==0) { print 'class="medium"'; }
		  	?>><?php echo $cat['category_name']; ?></a></li>
		  <?php
		  }
		  unset($cats);
		  ?>
	</ul>
	</div>
    <div class="slave" id="submenu-semiconductor-slave" master="semiconductor">
	<ul style="list-style: none;">
		<?php 
		$cats = getChildrenCategories(3,$conn);
		foreach($cats as $cat) {
			?>
		  	<li><a href="<?php echo $config['site']; ?>/category/<?php echo $cat['url_slug']; ?>" <?php 
		  	$rnd = rand(1,100); if($rnd%2==0) { print 'class="small"'; } elseif($rnd%3==0) { print 'class="medium"'; }
		  	?>><?php echo $cat['category_name']; ?></a></li>
		  <?php
		  }
		  unset($cats);
		  ?>
	</ul>
	</div>
    <div class="slave" id="submenu-passivecomponent-slave" master="passivecomponent">
	<ul style="list-style: none;">
		<?php 
		$cats = getChildrenCategories(2,$conn);
		foreach($cats as $cat) {
			?>
		  	<li><a href="<?php echo $config['site']; ?>/category/<?php echo $cat['url_slug']; ?>" <?php 
		  	$rnd = rand(1,100); if($rnd%2==0) { print 'class="small"'; } elseif($rnd%3==0) { print 'class="medium"'; }
		  	?>><?php echo $cat['category_name']; ?></a></li>
		  <?php
		  }
		  unset($cats);
		  ?>
	</ul>
	</div>
    </div>
    <div class="clear"></div>
    </div>
  </div>
</div>

<div class="dropdown">
  <div class="dropbtn"><a href="<?php echo $config['site']; ?>/category/ic-semi-conductors">ICs &amp; Semi-Conductors</a></div>
  <div class="dropdown-content">
  <?php
 
  $cats = getChildrenCategories(1,$conn);
  foreach($cats as $cat) {
  ?>
  	<p><a href="<?php echo $config['site']; ?>/category/<?php echo $cat['url_slug']; ?>"><?php echo $cat['category_name']; ?></a></p>
  <?php
  }
  unset($cats);
  $cats = getChildrenCategories(3,$conn);
  foreach($cats as $cat) {
  	?>
    	<p><a href="<?php echo $config['site']; ?>/category/<?php echo $cat['url_slug']; ?>"><?php echo $cat['category_name']; ?></a></p>
    <?php
    }
  unset($cats);
  ?>
  </div>
</div>

<div class="dropdown">
  <div class="dropbtn"><a href="<?php echo $config['site']; ?>/category/passive">Passive Components</a></div>
  <div class="dropdown-content">
   <?php 
   $cats = getChildrenCategories(2,$conn);
   foreach($cats as $cat) {
   	?>
     	<p><a href="<?php echo $config['site']; ?>/category/<?php echo $cat['url_slug']; ?>"><?php echo $cat['category_name']; ?></a></p>
     <?php
     }
     unset($cats);
   ?>
  </div>
</div>

<div class="dropdown">
  <div class="dropbtn"><a href="<?php echo $config['site']; ?>/category/interfacing-components">Interfacing Components</a></div>
  <div class="dropdown-content">
     <?php 
   $cats = getChildrenCategories(20,$conn);
   foreach($cats as $cat) {
   	?>
     	<p><a href="<?php echo $config['site']; ?>/category/<?php echo $cat['url_slug']; ?>"><?php echo $cat['category_name']; ?></a></p>
     <?php
     }
     unset($cats);
   ?>
   
  </div>
</div>

<div class="dropdown">
  <div class="dropbtn"><a href="<?php echo $config['site']; ?>/category/miscelleneous">Miscelleneous</a></div>
  <div class="dropdown-content">
     <?php 
   $cats = getChildrenCategories(21,$conn);
   foreach($cats as $cat) {
   	?>
     	<p><a href="<?php echo $config['site']; ?>/category/<?php echo $cat['url_slug']; ?>"><?php echo $cat['category_name']; ?></a></p>
     <?php
     }
     unset($cats);
   ?>

  </div>
</div>

</div>