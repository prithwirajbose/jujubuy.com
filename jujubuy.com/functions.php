<?php
if (! function_exists ( "getChildrenCategoryIds" )) {
	function getChildrenCategoryIds($catid, $conn) {
		$catlist = array ();
		$cdata = mysqli_query ( $conn, "select * from product_category where parent_category_id=" . $catid );
		if (mysqli_num_rows ( $cdata ) > 0) {
			while ( $crow = mysqli_fetch_assoc ( $cdata ) ) {
				array_push ( $catlist, $crow ['category_id'] );
				$nextarr = getChildrenCategoryIds ( $crow ['category_id'], $conn );
				if (is_array ( $nextarr ) && sizeof ( $nextarr ) > 0) {
					$catlist = array_merge_recursive ( $catlist, $nextarr );
				}
			}
		}
		return $catlist;
	}
}
function getChildrenCategories($catid, $conn) {
	$catlist = array ();
	$cdata = mysqli_query ( $conn, "select * from product_category where parent_category_id=" . $catid );
	if (mysqli_num_rows ( $cdata ) > 0) {
		while ( $crow = mysqli_fetch_assoc ( $cdata ) ) {
			array_push ( $catlist, $crow );
			$nextarr = getChildrenCategoryIds ( $crow ['category_id'], $conn );
			if (is_array ( $nextarr ) && sizeof ( $nextarr ) > 0) {
				$catlist = array_merge ( $catlist, $nextarr );
			}
		}
	}
	return $catlist;
}

function calculateCartTotalAmount($sessioncart) {
	if (! empty ( $sessioncart ) && ! empty ( $sessioncart ['orderitems'] )) {
		$totalamount = 0;
		foreach ( $sessioncart ['orderitems'] as $k => $v ) {
			$totalamount = doubleval ( doubleval ( $totalamount ) + doubleval ( doubleval ( $v ['qty'] ) * doubleval ( $v ['unit_price'] ) ) );
		}
		return convertCurrency ( $totalamount, 'INR', $sessioncart ['currency'] );
	} else {
		return doubleval ( "0" );
	}
}
function convertCurrency($amount, $fromcurrency, $tocurrency) {
	require_once 'config.php';
	$baseprice = doubleval ( $amount / $config ['currency_rate'] [$fromcurrency] );
	return doubleval ( $baseprice * $config ['currency_rate'] [$tocurrency] );
}
?>