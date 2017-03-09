<?php

// require the Faker autoloader
require_once './Faker/src/autoload.php';
require_once './db.php';

class random_generate{

	private $dbh; 

	public function __construct(){
		
		$this->dbh = DataBase::getInstance();
	
	}

	public function generate(){
		
		$stmt = $this->dbh->prepare("INSERT INTO `messages`(`username`,`email`,`homepage`,`date_add`,`message`) VALUES(:username,:email,:homepage,:date_add,:message)");
		for ($i=0; $i<50; $i++) {
			$faker = \Faker\Factory::create('ru_RU');
			$stmt->execute( array(
				':username' => $faker->name,
				':email' => $faker->email,
				':homepage' => $faker->url,
				':date_add' => $faker->date('Y-m-d'),
				':message' => $faker->realtext(200)
			));
			gc_collect_cycles();
		}
			
	}
		
}

$random = new random_generate();
$random->generate();