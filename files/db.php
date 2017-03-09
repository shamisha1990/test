<?php


class DataBase{

	static $dbh;

	private function __construct(){

		$host = 'localhost';
		$dbname = 'test';
		$user = 'root';
		$password = '';
		self::$dbh = new PDO("mysql:host=".$host.";dbname=".$dbname.';charset=utf8;', $user, $password);

	}

	protected function __clone(){
		//Ограничиваем кланирование объекта
	}

	static public function getInstance(){

		if( is_null(self::$dbh) ){

			new self();

		}
		return self::$dbh;

	}



}