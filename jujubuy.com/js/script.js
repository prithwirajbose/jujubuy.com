function voidfn() {

}

JUJUBUY.customUiFixes = function() {
	$('body').delegate('.ui-widget-overlay', 'click', function(el) {
		if ($('.dialog').is(':visible'))
			$('.dialog').dialog('close');
	});
};

JUJUBUY.showError = function(msg) {
	$('.dialog').dialog({
		'height' : 120,
		'width' : 400,
		'modal' : true,
		'title' : 'Error',
	});
	$('.dialog .bd').css('color', 'red').html(msg);
};

JUJUBUY.updateFullCart = function(e) {
	var pidstr = '';
	var qtystr = '';
	var comma = '';
	
	if($('.cartitem input.quantity').length<=0) {
		JUJUBUY.showError("Your cart is empty, nothing to update");
		return false;
	}
	
	$('.cartitem').each(function(indx, el) {
		var qty = 0;
		try {
			qty = parseInt($.trim($(this).find('input.quantity').val()), 10);
		} catch (e) {
			JUJUBUY.showError("Item Quantities must be numeric");
			return false;
		}
		pidstr += comma + $(this).attr('productPriceId');
		qtystr += comma + qty;
		comma = ',';
	});
	JUJUBUY.updateCart(e, 'update', pidstr, qtystr, true);
};

JUJUBUY.deleteSelectedCart = function(e) {
	var pidstr = '';
	var comma = '';
	if($('.cartitem input.itemcheck:checked').length<=0) {
		JUJUBUY.showError("Atleast one item must be selected");
		return false;
	}
	$('.cartitem input.itemcheck:checked').each(function(indx, el) {
		pidstr += comma + $(this).val();
		comma = ',';
	});
	JUJUBUY.updateCart(e, 'delete', pidstr, null, true);
};

JUJUBUY.updateCart = function(e, action, pid, qty, fromcart, animate) {
	var pidstr = '';
	var qtystr = '';
	if($('.noitem').length>0) {
		$('.noitem').hide();
	}
	var btn = $(e.target);
	if (!(action && action != null && (action == 'add' || action == 'update'
			|| action == 'delete' || action == 'empty'))) {
		return false;
	}
	if (pid && pid != null && pid != '') {
		pidstr = '&id=' + encodeURIComponent(pid);
	}
	if (qty && qty != null && qty != '') {
		qtystr = '&qty=' + encodeURIComponent(qty);
	}
	$
			.ajax({
				url : JUJUBUY.site + '/ajax.php?action=updateCart&task='
						+ action + pidstr + qtystr,
				method : 'GET',
				dataType : 'json',
				success : function(resp, xhr) {
					if (resp && resp.success === true && resp.data
							&& resp.data.orderitems) {
						var totalcount = 0;
						for ( var key in resp.data.orderitems) {
							if (resp.data.orderitems.hasOwnProperty(key)) {
								totalcount += resp.data.orderitems[key]['qty'];
							}
						}
						
						var griditm = $('.cartitem');
						if (fromcart && fromcart === true) {
							$(griditm)
									.each(
											function(indx, el) {
												if (!(resp.data.orderitems
														.hasOwnProperty($(
																this)
																.attr(
																		'productPriceId')) && resp.data.orderitems[$(
														this).attr(
														'productPriceId')]['qty'] > 0)) {
													$(this).addClass(
															'tobedeleted');
												}
											});
							$('.cartitem.tobedeleted').remove();
							if($('.noitem').length>0 && $('.cartitem').length<=0) {
								$('.noitem').show();
							}
							else {
								$('.noitem').hide();
							}
						}

						if (animate && animate === true) {
							var cart = $('#cartwidget img, #cartwidget .totalcount');
							var imgtodrag = $(btn).closest('.griditem')
									.find(".griditem-icon img").eq(0);
							if (imgtodrag) {
								var imgclone = imgtodrag.clone().offset({
									top : imgtodrag.offset().top,
									left : imgtodrag.offset().left
								}).css({
									'opacity' : '0.7',
									'position' : 'absolute',
									'height' : '150px',
									'width' : '150px',
									'z-index' : '100'
								}).appendTo($('body')).animate({
									'top' : cart.offset().top + 10,
									'left' : cart.offset().left + 10,
									'width' : 75,
									'height' : 75
								}, 1000, 'easeInOutExpo');

								
								 setTimeout(function () {
								  cart.effect("shake", { times: 2,
								  direction: 'left', distance: 10 }, 200); },
								 1500);
								 

								imgclone.animate({
									'width' : 0,
									'height' : 0
								}, function() {
									$(this).detach();
									$('#cartwidget .totalcount').html(
											totalcount);
								});
							}
						} else {
							$('#cartwidget .totalcount').html(totalcount);
						}
					} else {
						JUJUBUY.showError('Unable to update cart');
					}
				},
				error : function(xhr) {
					JUJUBUY.showError('An error has occured');
				}
			})
};

$(document).ready(function() {
	JUJUBUY.customUiFixes();
	var loadingDiv = $('.loadingDiv').hide();
	$(document).ajaxStart(function(xhr) {
		if(xhr && xhr.currentTarget && xhr.currentTarget.activeElement && $(xhr.currentTarget.activeElement).length>0 && $(xhr.currentTarget.activeElement).attr('id')=='searchQuery') {
			return;
		}
		$(loadingDiv).show();
		$(loadingDiv).find('img').eq(1).position({
			my:'center',
			at:'center',
			of:$('.loadingDiv')
		});
		$(loadingDiv).find('img').eq(0).position({
			my:'bottom',
			at:'top',
			of:$(loadingDiv).find('img').eq(1)
		});
	}).ajaxStop(function(xhr) {
		if(xhr && xhr.currentTarget && xhr.currentTarget.activeElement && $(xhr.currentTarget.activeElement).length>0 && $(xhr.currentTarget.activeElement).attr('id')=='searchQuery') {
			return;
		}
		$(loadingDiv).hide();
	});
	$("#searchQuery").autocomplete({
		source : function(request, response) {
			$.ajax({
				url : JUJUBUY.site + "/ajax.php?action=listComponents&q=" + $('input#searchQuery').val(),
				dataType : "json",
				success : function(data) {
					response(data.data);
				}
			});
		},
		minLength : 2,
		select : function(event, ui) {
			// $('#searchQuery').val(ui.item.value);
		},
		open : function() {
			$(this).removeClass("ui-corner-all").addClass("ui-corner-top");
		},
		close : function() {
			$(this).removeClass("ui-corner-top").addClass("ui-corner-all");
		}
	});

	$.submenu('.submenu');
	$('.dropdown-content').bind('mouseover', function(e) {
		$(this).closest('.dropdown').find('.dropbtn a').addClass('active');
	});
	$('.dropdown-content').bind('mouseout', function(e) {
		$(this).closest('.dropdown').find('.dropbtn a').removeClass('active');
	});
});