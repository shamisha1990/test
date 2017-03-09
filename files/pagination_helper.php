<?php

	function get_page_num(){

		$dbh = Database::getInstance();
		$stmt = $dbh->query("SELECT COUNT(*) as `count` FROM `messages`");
		$count = $stmt->fetch();
		return ceil( $count['count']/5 );
		
	}

	function pagination_links(){

		$count = get_page_num();
		$out = "";
		if( !empty($_GET['page']) && $_GET['page']>1 && $_GET['page']<=$count ){
			$current = (int) $_GET['page'];
		} else {
			$current = 1;
		}

		//-----------prev link ---------------------------//

		if( $current > 1 ){
			$prev = $current - 1;
			$out.='<a href="./?page='.$prev.'"><<</a> ';
		}

		//-----------------------------------------------//

		for ($i=1; $i <= $count; $i++) { 
			
			if( $i<4 || $i>$count-3 || $i==$current  ){
				if( $i != $current ){
					$out .= '<a href="./?page='.$i.'">'.$i.'</a>  ';
				} else {
					$out .= '<a class="text-success lead">'.$i.'</a>';
				}
			}

			if( $i==3 || $i==$count-3 ){
				$out.='...';
			}

		}


		//-----------next link ---------------------------//

		if( $current < $count ){
			$next = $current + 1;
			$out.='<a href="./?page='.$next.'">>></a> ';
		}

		//-----------------------------------------------//

		echo $out;
		
	}

?>