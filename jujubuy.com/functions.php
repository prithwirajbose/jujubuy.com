<?php 
if(!function_exists("getChildrenCategoryIds")) {
function getChildrenCategoryIds($catid,$conn) {
	$catlist = array();
	$cdata = mysqli_query($conn, "select * from product_category where parent_category_id=".$catid);
	if(mysqli_num_rows($cdata)>0) {
		while($crow = mysqli_fetch_assoc($cdata)) {
			array_push($catlist, $crow['category_id']);
			$nextarr = getChildrenCategoryIds($crow['category_id'],$conn);
			if(is_array($nextarr) && sizeof($nextarr)>0) {
				$catlist = array_merge_recursive($catlist, $nextarr);
			}
		}
	}
	return $catlist;
}
}
?>