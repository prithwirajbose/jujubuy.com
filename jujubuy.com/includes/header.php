<div id="logo"><a href="<?php echo $config['site']; ?>"><img src="<?php echo $config['site']; ?>/images/logo.png" border="0" style="height:60px; width:auto;" /></a></div>
<div id="search"><form name="searchForm" method="get">
<input type="text" name="q" id="searchQuery" class="searchfocus js-typeahead" onfocus="javascript:if($(this).val()=='') $(this).removeClass('searchfocus');" 
onblur="javascript:if($(this).val()=='') $(this).addClass('searchfocus');" autocomplete="off" /><input type="submit" name="submit" id="searchSubmit" value="Search" />
</form></div>
<div class="clear"></div>