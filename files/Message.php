<?php

include_once("pagination_helper.php");

class Message{

	private $dbh;

	public function __construct(){

		$this->dbh = DataBase::getInstance();

	}


	public function getList(){
		$count = get_page_num();
		if( !empty($_GET['page']) && $_GET['page']>1 && $_GET['page']<=$count ){
			$page = (int) $_GET['page'];
		} else {
			$page = 1;
		}
		$page = ($page - 1) * 5 ;
		$sth = $this->dbh->query("SELECT * FROM `messages` LIMIT ".$page.", 5");
		$result = $sth->fetchAll(PDO::FETCH_CLASS);
		return $result;

	}

	
	public function OrderBy(){

	}

	
	public function addMessage(){

		$date = date("Y-m-d");
		$stmt = $this->dbh->prepare("INSERT INTO `messages`(`username`,`email`,`homepage`,`date_add`,`message`) VALUES(:username,:email,:homepage,:date_add,:message)");
		$stmt->execute( array( 
						':username' => $_POST['username'],
						':email' => $_POST['email'],
						':homepage' => $_POST['homepage'],
						':date_add' => $date,
						':message' => $_POST['message']
						 ) );
		

	}


}