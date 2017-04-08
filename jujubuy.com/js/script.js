var getUrl = function() {
	return JUJUBUY.site + "/ajax.php?action=listComponents&q=" + $('input#searchQuery').val();
};

$(document).ready(function() {

	$("#searchQuery").autocomplete({
		source : function(request, response) {
			$.ajax({
				url : getUrl(),
				dataType : "json",
				success : function(data) {
					response(data.data);
				}
			});
		},
		minLength : 2,
		select : function(event, ui) {
			//  $('#searchQuery').val(ui.item.value);
		},
		open : function() {
			$(this).removeClass("ui-corner-all").addClass("ui-corner-top");
		},
		close : function() {
			$(this).removeClass("ui-corner-top").addClass("ui-corner-all");
		}
	});
	
	$.submenu('.submenu');
	$('.dropdown-content').bind('mouseover',function(e) {
		$(this).closest('.dropdown').find('.dropbtn a').addClass('active');
	});
	$('.dropdown-content').bind('mouseout',function(e) {
		$(this).closest('.dropdown').find('.dropbtn a').removeClass('active');
	});
});