<?php
if (! isset ( $_SESSION )) {
	session_start ();
}
require_once 'db.php';
require_once 'functions.php';
header ( "Content-type", "application/json" );
if (! empty ( $_REQUEST ['action'] )) {
	$resp = array ();
	$actionFunc = $_REQUEST ['action'];
	try {
		$obj = $actionFunc ();
		$resp ['success'] = true;
		$resp ['data'] = $obj;
	} catch ( Exception $e ) {
		$resp ['success'] = false;
		$resp ['error'] = $e->getMessage ();
	}
	echo json_encode ( $resp );
} else {
	$resp = array ();
	$resp ['success'] = false;
	$resp ['error'] = "Missing required parameter";
	echo json_encode ( $resp );
}
function listComponents() {
	$arr = array ();
	$conn = connectDb ();
	$q = "'%" . mysqli_real_escape_string ( $conn, strtolower ( $_REQUEST ['q'] ) ) . "%'";
	$data = mysqli_query ( $conn, "select p.product_name from product p, product_category pc where p.category_id=pc.category_id and p.enabled_flag=1 and 
			(lower(p.product_name) like " . $q . " or lower(p.short_description) like " . $q . " or lower(p.long_description) like " . $q . " or lower(pc.category_name) like " . $q . ") order by p.product_score desc, p.product_name asc limit 0,10" ) or die ( mysqli_error ( $conn ) );
	if (mysqli_num_rows ( $data ) > 0) {
		while ( $row = mysqli_fetch_assoc ( $data ) ) {
			array_push ( $arr, $row ['product_name'] );
		}
	}
	return $arr;
}
function updateCart() {
	if (empty ( $_SESSION ['cart'] ) || empty ( $_SESSION ['cart'] ['id'] )) {
		$_SESSION ['cart'] = array (
				'id' => md5 ( time () ),
				'totalamount' => 0,
				'currency' => 'INR',
				'orderitems' => array () 
		);
	}
	if (! (! empty ( $_REQUEST ['task'] ) && ($_REQUEST ['task'] == 'add' || $_REQUEST ['task'] == 'update' || $_REQUEST ['task'] == 'delete' || $_REQUEST ['task'] == 'empty'))) {
		throw new Exception ( "Cart Task missing or not supported" );
	}
	
	$conn = connectDb ();
	$task = $_REQUEST ['task'];
	$priceid = ! empty ( $_REQUEST ['id'] ) ? $_REQUEST ['id'] : 0;
	if (strpos ( $priceid, "," ) !== false) {
		$priceid = explode ( ",", $priceid );
	} else {
		$priceid = array (
				$priceid 
		);
	}
	$qty = ! empty ( $_REQUEST ['qty'] ) ? $_REQUEST ['qty'] : 0;
	if (strpos ( $qty, "," ) !== false) {
		$qty = explode ( ",", $qty );
	} else {
		$qty = array (
				$qty 
		);
	}
	
	if (($task == 'add' || $task == 'update')) {
		if (sizeof ( $priceid ) != sizeof ( $qty )) {
			throw new Exception ( "Quantity information is not matching with product details" );
		}
		for($i = 0; $i < sizeof ( $priceid ); $i ++) {
			$pdata = mysqli_query ( $conn, "select * from product p, product_price pp where pp.price_id='" . mysqli_real_escape_string ( $conn, $priceid [$i] ) . "'
				and pp.product_id=p.product_id limit 1" ) or die ( mysqli_error ( $conn ) );
			$orderitems = $_SESSION ['cart'] ['orderitems'];
			if (mysqli_num_rows ( $pdata ) == 1) {
				while ( $prow = mysqli_fetch_assoc ( $pdata ) ) {
					$orderitem = array ();
					if (array_key_exists ( $prow ['price_id'], $orderitems ) && ! empty ( $orderitems [$prow ['price_id']] )) {
						$orderitem = $orderitems [$prow ['price_id']];
						if ($task == 'update') {
							$orderitem ['qty'] = doubleval ( $qty [$i] );
						} else {
							$orderitem ['qty'] = doubleval ( doubleval ( $orderitem ['qty'] ) + doubleval ( $qty [$i] ) );
						}
					} else {
						$orderitem = array (
								'product_details' => $prow,
								'unit_price' => $prow ['unit_price'],
								'qty' => doubleval ( $qty [$i] ) 
						);
					}
					if ($orderitem ['qty'] > 0)
						$orderitems [$prow ['price_id']] = $orderitem;
					else
						unset ( $orderitems [$prow ['price_id']] );
				}
				$_SESSION ['cart'] ['orderitems'] = $orderitems;
			} else {
				throw new Exception ( "Invalid Product Details" );
			}
			
			mysqli_free_result ( $pdata );
			unset ( $pdata );
		}
	} elseif ($task == 'delete') {
		for($i = 0; $i < sizeof ( $priceid ); $i ++) {
			$_SESSION ['cart'] ['orderitems'] [$priceid [$i]] = null;
			unset ( $_SESSION ['cart'] ['orderitems'] [$priceid [$i]] );
		}
	} elseif ($task == 'empty') {
		$_SESSION ['cart'] = null;
		$_SESSION ['cart'] = array (
				'id' => md5 ( time () ),
				'totalamount' => 0,
				'currency' => 'INR',
				'orderitems' => array () 
		);
	} else {
		throw new Exception ( "Invalid or missing parameters" );
	}
	$_SESSION ['cart'] ['totalamount'] = doubleval ( calculateCartTotalAmount ( $_SESSION ['cart'] ) );
	return $_SESSION ['cart'];
}
?>