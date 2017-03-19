/** Written by Prithwiraj Bose **/
$.submenu = function(el) {
	var rootObj = $(el).find('a.master');
	$(rootObj).attr('href','#');
	$(el).find('.slave').hide();
	$(rootObj).bind('mouseover', function(e) {
		$(el).find('.slave').hide();
		$(rootObj).attr('href','#').closest('li').removeClass('active');
		$(this).closest('li').addClass('active');
		$(el).find('.slave[master='+$(this).attr('name')+']').show();
	});
	
};