<div id="logo"><a href="<?php echo $config['site']; ?>"><img src="<?php echo $config['site']; ?>/images/logo.png" border="0" style="height:60px; width:auto;" /></a></div>

<div id="search"><form name="searchForm" method="get">
<input type="text" name="q" id="searchQuery" class="searchfocus js-typeahead" onfocus="javascript:if($(this).val()=='') $(this).removeClass('searchfocus');" 
onblur="javascript:if($(this).val()=='') $(this).addClass('searchfocus');" autocomplete="off" /><input type="submit" name="submit" id="searchSubmit" value="Search" />
</form></div>

<div id="cartwidget"><a href="<?php echo $config['site']; ?>/cart" title="Shopping Cart">
<img src="<?php echo $config['site']; ?>/images/shopping-cart-icon.png" border="0" height="40px;" width="50px" />
<div class="totalcount"><?php 
try {
	$totalitems = 0;
	foreach($_SESSION['cart']['orderitems'] as $k=>$v) {
		$totalitems += $v['qty'];
	}
	print $totalitems;
}
	catch(Exception $e) {
		print 0;
	}
?></div></a></div>

<div class="clear"></div>