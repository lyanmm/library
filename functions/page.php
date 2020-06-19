<?php
function page($total_records,$page_size,$page_current,$url,$keyword,$userId,$userName){
	$total_pages = ceil($total_records/$page_size);
	$page_previous = ($page_current<=1?1:$page_current-1);
	$page_next = ($page_current >= $total_pages) ? $total_pages : ($page_current+1);
	$page_next = ($page_next==0)?1:$page_next;
	$page_start = ($page_current-5>0)?($page_current-5):0;
	$page_end = ($page_start+10<$total_pages)?$page_start+10:$total_pages;
	$page_start = $page_end-10;
	if($page_start<0) $page_start = 0;
	if(empty($keyword)){
		$navigator = "
                    <li>
                    <a href=$url?page_current=$page_previous&userId=$userId&userName=$userName  aria-label=\"Previous\">
                    <span aria-hidden=\"true\">&laquo;</span>
                    </a>
                    </li>";
		for($i=$page_start;$i<$page_end;$i++){
			$j = $i+1;
			$navigator.="
                    <li><a href='$url?page_current=$j&userId=$userId&userName=$userName '>$j </a></li>";
		}
		$navigator.="<li>
                     <a href=$url?page_current=$page_next&userId=$userId&userName=$userName  aria-label=\"Next\">
                     <span aria-hidden=\"true\">&raquo;</span>
                     </a>
                     </li>";
	}else{
		$keyword = $_GET["keyword"];
		$navigator = "
		            <li>
                    <a href=$url?keyword=$keyword&page_current=$page_previous&userId=$userId&userName=$userName >
                    <span aria-hidden=\"true\">&laquo;</span>
                    </a>
                    </li>";
		for($i=$page_start;$i<$page_end;$i++){
			$j = $i+1;
			$navigator.="<li><a href='$url?keyword=$keyword&page_current=$j&userId=$userId&userName=$userName '>$j </a></li>";
		}
		$navigator.="
		            <li>
                    <a href=$url?keyword=$keyword&page_current=$page_next&userId=$userId&userName=$userName >
                    <span aria-hidden=\"true\">&raquo;</span>
                    </a>";
	}
	echo $navigator;
}
?>